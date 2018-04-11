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


    public static function getNeighbor($user_id)
    {
        $user = User::find($user_id);

        //用户的评分数据
        $user_rate = Rate::select('user_id', 'game_id', 'name', 'rate')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('users.id', $user_id)
            ->get();

        //随机获取十位用户
        $users = User::select(['id', 'name'])
            ->where('id', '<>', $user_id)
            ->orderBy(\DB::raw('RAND()'))
            ->take(5)
            ->get();

        for ($i = 0; $i < count($users); $i++) {
            $users_data[$i] = $users[$i]['id'];
            $users_name[$i] = $users[$i]['name'];
        }
        $users = Rate::select('user_id', 'game_id', 'rate')
            ->whereIn('user_id', $users_data)
            ->get();

        $neighbor = array();
        for ($i = 0; $i < count($users); $i++) {
            for ($j = 0; $j < count($users_data); $j++) {
                $neighbor[$j]['user_id'] = $users_data[$j];
                if ($users[$i]['user_id'] == $users_data[$j]) {
                    $neighbor[$j][] = $users[$i];
                }
            }
        }
//        return  $neighbor;

//
//        $users = Rate::select('users.id', 'user_id', 'game_id', 'name', 'rate')
//            ->join('users', 'user_id', '=', 'users.id')
//            ->orderBy(\DB::raw('RAND()'))
//            ->take(10)
//            ->get();

//        return $users;
//        //
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
//        return $fm1;

        $message = '';

        for ($i = 0; $i < count($neighbor); $i++) {
            $fz = 0;
            $fm2 = 0;
            $message .= " Cos(" . $user['name'] . "," . $users_name[$i] . ")=";

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
            $cos[$i] = 0;

            if ($fm1 != null && $fm2 != null) {
                $cos[$i] = $fz / $fm1 / $fm2;
            }
            $message .= $cos[$i] . "<br/>             ";
            $messages[$i] = $message;
            $message = '';
        }
        return [ 'messages' => $messages];

        for ($i = 0; $i < 5; $i++) {
            $fz = 0;
            $fm2 = 0;


            for ($j = 1; $j < 9; $j++) {
                //计算分子
                if ($array[5][$j] != null && $array[$i][$j] != null) {
                    $fz += $array[5][$j] * $array[$i][$j];
                }
                //计算分母2
                if ($array[$i][$j] != null) {
                    $fm2 += $array[$i][$j] * $array[$i][$j];
                }
            }
            $fm2 = sqrt($fm2);
            $cos[$i] = $fz / $fm1 / $fm2;
            echo $cos[$i] . "<br/>";
        }
//
//        return $cos;
    }
}
