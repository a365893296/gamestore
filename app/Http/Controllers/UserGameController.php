<?php

namespace App\Http\Controllers;

use App\Models\Rate;
use App\Models\UserPurchase;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UserGameController extends Controller
{
    //
    /**
     *  购买游戏
     */
    public function purchase(Request $request)
    {
        $game = $request->post('game');
        $user = $request->post('user');

        if (DB::table('purchase_history')->where(['game_id' => $game['id'], 'user_id' => $user['id']])->first()) {
            return response()->json([
                'message' => '已购买过此游戏',
                'status' => 'failed',
                'status_code' => '200'
            ]);
        }

        if ($user['balance'] < $game['price']) {
            return response()->json([
                'message' => '账号余额不足，请充值',
                'status' => 'failed',
                'status_code' => '200'
            ]);
        }

        DB::beginTransaction();
        try {
            $user['balance'] -= $game['price'];
            if (!User::where('id', $user['id'])->update(['balance' => $user['balance']])) {
                throw new Exception('账户扣款失败!');
            }
            $records = array(
                'user_id' => $user['id'],
                'game_id' => $game['id'],
                'cost' => $game['price']
            );
            $rs = UserPurchase::create($records);
            if (!$rs) {
                throw new Exception('购买失败！');
            }
        } catch (Exception $exception) {
            DB::rollBack();
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => 'failed',
                'status_code' => '403',
            ]);
        }
        DB::commit();

        return response()->json([
            'message' => '购买成功!',
            'status' => 'success',
            'status_code' => '200',
        ]);
    }

    public function getPurchased(Request $request)
    {
        $user_id = $request->post('user_id');
        $game_id = $request->post('game_id');

        $game = UserPurchase::getPurchased($user_id, $game_id);
        $rate = Rate::getRate($user_id, $game_id);
//        $isPurchased = true ;
//        if($rate){
//            $isPurchased = flase;
//        }

        return response()->json([
            'isPurchased' => $game && !$rate,
            'status' => 'success',
            'status_code' => 200
        ]);
    }

    public function getRecommend(Request $request)
    {
        $user_id = $request->post('user_id') ;
        $users = User::getNeighbor($user_id) ;
        return response()->json([
            'data' => $users,
            'status' => 'success',
            'status_code' => 200
        ]);
    }
}
