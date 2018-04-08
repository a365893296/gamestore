<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    /**
     * home 页走马灯游戏
     */
    public function getCarouselGames()
    {
        $games = Game::orderBy('id', 'desc')->take(3)->get();
        $data = array();
        for ($i = 0; $i < count($games); $i++) {
            $data[$i] = array(
                'id' => $games[$i]['id'],
                'name' => $games[$i]['name'],
                'image' => $games[$i]['background_image'],
            );
        }
        return response()->json([
            'games' => $data,
        ]);
    }

    /**
     * home页 游戏
     */
    public function getCardsGames()
    {
        $games = Game::orderBy('id', 'desc')->take(6)->get();
        $data = array();
        for ($i = 0; $i < count($games); $i++) {
            $data[$i] = array(
                'id' => $games[$i]['id'],
                'name' => $games[$i]['name'],
                'image' => $games[$i]['image'],
                'price' => $games[$i]['price'],
            );
        }
        return response()->json([
            'games' => $data,
        ]);
    }

    public function game(Request $request)
    {

        $game = Game::find($request->post('id'));
        $game['category'] = $game->category;
//        $game['image'] = $game->image ;
//        $game['images'] = $game->images ;
//        $category = $game->category ;
        return response()->json([
            'game' => $game,
//            'category' => $category,
//            'image' => $game->image ,
//            'images' => $game->images
        ]);
    }

    /**
     * userCenter 用户已购买的游戏
     */
    public function getGameList(Request $request)
    {
        $user_id = $request->post('id') ;
        $games = Game::orderBy('id', 'desc')->take(6)->get();
        $data = array();
        for ($i = 0; $i < count($games); $i++) {
            $data[$i] = array(
                'id' => $games[$i]['id'],
                'name' => $games[$i]['name'],
                'image' => $games[$i]['image'],
                'price' => $games[$i]['price'],
            );
        }
        return response()->json([
            'games' => $data,
        ]);
    }
}

