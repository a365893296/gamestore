<?php

namespace App;

use App\Models\Rate;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public static function getRecommend($user_id)
    {
        $user = User::find($user_id);

        //用户的评分数据
        $user_rate = Rate::select('user_id', 'game_id', 'name', 'rate')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('users.id', $user_id)
            ->get();

        //随机获取5位用户
        $users = User::select(['id', 'name'])
            ->where('id', '<>', $user_id)
            ->orderBy(\DB::raw('RAND()'))
            ->take(5)
            ->get();
        //整理数据
        for ($i = 0; $i < count($users); $i++) {
            $users_data[$i] = $users[$i]['id'];
            $users_name[$i] = $users[$i]['name'];
        }
        $users = Rate::select('user_id', 'game_id', 'rate')
            ->whereIn('user_id', $users_data)
            ->get();

//        $neighbor = collect($users)->groupBy('user_id') ->toArray();
//        return $neighbor ;

        $neighbor = array();
        for ($i = 0; $i < count($users); $i++) {
            for ($j = 0; $j < count($users_data); $j++) {
                $neighbor[$j]['user_id'] = $users_data[$j];
                if ($users[$i]['user_id'] == $users_data[$j]) {
                    $neighbor[$j][] = $users[$i];
                }
            }
        }

        $cos = array();
        $cos[0] = 0;
        $fm1 = 0;

        //开始计算cos
        //计算分母1，分母1是第一个公式里面 “*”号左边的内容，分母二是右边的内容
        for ($i = 0; $i < count($user_rate); $i++) {
            // 用户的n个评分数据的平方和
            $fm1 += $user_rate[$i]['rate'] * $user_rate[$i]['rate'];
        }
        $fm1 = sqrt($fm1);
//        $message = '';

        for ($i = 0; $i < count($neighbor); $i++) {
            $fz = 0;
            $fm2 = 0;
//            $message .= " $users_data[$i] Cos(" . $user['name'] . "," . $users_name[$i] . ")=";

            if (count($neighbor[$i]) == 0) continue;
            for ($j = 0; $j < count($neighbor[$i]) - 1; $j++) {
                for ($k = 0; $k < count($user_rate); $k++) {
                    //计算分子
                    if ($user_rate[$k]['rate'] != null
                        && $neighbor[$i][$j]['rate'] != null
                        && $user_rate[$k]['game_id'] == $neighbor[$i][$j]['game_id']
                    ) {
                        $fz += $user_rate[$k]['rate'] * $neighbor[$i][$j]['rate'];
                    }
                }
                //计算分母2
                if ($neighbor[$i][$j]['rate'] != null) {
                    $fm2 += $neighbor[$i][$j]['rate'] * $neighbor[$i][$j]['rate'];
                }

            }
            $fm2 = sqrt($fm2);
            $cos[$i] = array(
                'user_id' => $users_data[$i],
                'name' => $users_name[$i],
                'value' => 0,
            );

            if ($fm1 != null && $fm2 != null) {
                $cos[$i]['value'] = $fz / $fm1 / $fm2;
            }
//            $message .= $cos[$i]['value'] . "<br/>             ";
//            $messages[$i] = $message;
//            $message = '';
        }
        //$collection 是邻居与用户的cos
        $collection = collect($cos)->sortByDesc('value')->values()->all();

        $neighbors = array();
        for ($i = 0; $i < count($collection); $i++) {
            if ($collection[$i]['value'] > 0.65) {
                $neighbors[$i] = $collection[$i];
            }
        }
        //符合条件的邻居
        $neighbors_id = collect($neighbors)->pluck('user_id')->all();
        $games_id = Rate::select('game_id')->whereIn('user_id', $neighbors_id)->get();
        //邻居有而用户没有的游戏
        $games_id = collect($games_id)->unique()->pluck('game_id')
            ->diff(collect($user_rate)->pluck('game_id'))->values();

        //邻居对游戏的评分
        $neighbors_rates = Rate::select('user_id', 'game_id', 'rate')
            ->whereIn('user_id', $neighbors_id)
            ->whereIn('game_id', $games_id)
            ->get();
        $neighbors_rates = collect($neighbors_rates)->groupBy('user_id');

        $predict = array();
        for ($i = 0; $i < count($games_id); $i++) {
            $pfz = 0;
            $pfm = 0;
            for ($j = 0; $j < count($neighbors_id); $j++) {
                if (!empty($neighbors_rates[$neighbors_id[$j]])) {
                    $game_rates = $neighbors_rates[$neighbors_id[$j]];
                    for ($k = 0; $k < count($game_rates); $k++) {
                        if ($game_rates[$k]['game_id'] == $games_id[$i]) {
                            //计算分子
                            $pfz += $neighbors[$j]['value'] * $game_rates[$k]['rate'];
                            //计算分母
                            $pfm += $neighbors[$j]['value'];
                        }
                    }

//                    $value =  $pfz / sqrt($pfm) ;
                    $value = sqrt($pfm) == 0 ? 0 : $pfz / sqrt($pfm);
                    $predict[] = array(
                        'user_id' => $neighbors_id[$j],
                        'game_id' => $games_id[$i],
                        'value' => $value
                    );
                }
            }
        }
        //返回大于3的游戏
        $predict = collect($predict)->filter(function ($item) {
            return $item['value'] > 3;
        })->values();
        return $predict;

    }
}
