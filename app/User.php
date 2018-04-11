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
        $array = Rate::select('users.id', 'user_id', 'game_id', 'name', 'rate')
            ->join('users', 'user_id', '=', 'users.id')
            ->where('users.id', $user_id)
            ->get();


        //随机获取十位用户
        $users = User::select(['id', 'name'])
            ->where('id', '<>', $user_id)
            ->orderBy(\DB::raw('RAND()'))
            ->take(5)
            ->get();

        for ($i = 0 ; $i<count($users) ; $i++){
            $users_data[$i] = $users[$i]['id'];
            $users_name[$i] = $users[$i]['name'] ;
        }
        $users = Rate::select('id','user_id','game_id','rate')
            ->whereIn('user_id', $users_data)
            ->get();
        $neighbor = array() ;
        for($i = 0 ;$i< count($users) ; $i++){
            for ($j = 0 ; $j< count($users_data) ; $j++){
                if($users[$i]['user_id'] == $users_data[$j]){
                    $neighbor[$j]['user_id'] = $users[$i]['user_id'];
                    $neighbor[$j][] = $users[$i] ;
                }

            }
        }
        
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
        for ($i = 0; $i < count($array); $i++) {
            // 用户的n个评分数据的平方和
            $fm1 += $array[$i]['rate'] * $array[$i]['rate'];
        }
        $fm1 = sqrt($fm1);
//        return $fm1;

        $message = '';

        for ($i = 0; $i < count($users); $i++) {
            $fz = 0;
            $fm2 = 0;
            $message .= " Cos(" . $user['name'] . "," . $users[$i]['name'] . ")=";

            for ($j = 0; $j < count($array); $j++) {
                //计算分子
                if ($array[$j]['rate'] != null
                    && $users[$i]['rate'] != null
                    &&$array[$j]['game_id'] == $users[$i]['game_id']) {
                    $fz += $array[$j]['rate'] * $users[$i]['rate'];
                }
                //计算分母2
                if ($users[$i]['rate'] != null) {
                    $fm2 += $users[$i]['rate'] * $users[$i]['rate'];
                }

            }
            $fm2 = sqrt($fm2);

            $cos[$i] = $fz / $fm1 / $fm2;
            $message .= $cos[$i] . "<br/>             ";
            $messages[$i] = $message;
            $message='';
        }
        return [ 'users'=>$users , 'messages'=>$messages];

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
