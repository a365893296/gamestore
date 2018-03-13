<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //
    public function getCarouselGames()
    {
        $games = Game::orderBy('id', 'desc')->take(3)->get();
        $data = array() ;
        for($i = 0 ; $i<count($games); $i++){
            $data[$i] = array(
                'id'=>$games[$i]['id'] ,
                'name'=>$games[$i]['name'] ,
                'image'=> $games[$i]['background_image'] ,
                );
        }
        return response()->json([
            'games' => $data,
        ]);
    }

    public function getCardsGames()
    {
        $games = Game::orderBy('id', 'desc')->take(6)->get();
        $data = array() ;
        for($i = 0 ; $i<count($games); $i++){
            $data[$i] = array(
                'id'=>$games[$i]['id'] ,
                'name'=>$games[$i]['name'] ,
                'image'=> $games[$i]['image'] ,
                'price'=> $games[$i]['price'] ,
            );
        }
        return response()->json([
            'games' => $data,
        ]);
    }

    public function game(Request $request){

        $game =Game::find($request->post('id'));
        $game['category'] = $game->category ;
//        $game['image'] = $game->image ;
//        $game['images'] = $game->images ;
//        $category = $game->category ;
        return response()->json([
            'game'=>$game,
//            'category' => $category,
//            'image' => $game->image ,
//            'images' => $game->images
         ]);
    }
}

