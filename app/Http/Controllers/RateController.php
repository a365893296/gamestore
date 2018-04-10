<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class RateController extends Controller
{
    //
    public function getRate(Request $request)
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * 评分
     */
    public function setRate(Request $request)
    {
        $user_id = $request->post('user_id');
        $game_id = $request->post('game_id');
        $rate = $request->post('rate');

        DB::beginTransaction();
        try {
            if ($user_id && $game_id && $rate) {
                $data = Rate::updateOrCreate([
                    'user_id' => $user_id,
                    'game_id' => $game_id,
                ], ['rate' => $rate]);
                if (!$data) {
                    throw new Exception('评分失败!');
                }

                $count = Rate::where(['game_id' => $game_id])->count();
                $game = Game::where('id', $game_id)->first();
                $game['rate'] = ($game['rate'] * $count + $rate) / ($count + 1);
                if (!$game->save()) {
                    throw new Exception('评分失败!');
                }
            }
        } catch (Exception $exception) {
            DB::rollback();
            return response()->json([
                'message' => $exception->getMessage(),
                'status' => 'error',
                'status_code' => '200',
            ]);
        }

        DB::commit();
        return response()->json([
            'message' => '评分成功！',
            'status' => 'success',
            'status_code' => '200',
        ]);


    }

}
