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
                'image'=>env('APP_URL').'uploads/'. $games[$i]['background_image'] ,
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
                'image'=> env('APP_URL').'uploads/'.$games[$i]['image'] ,
                'price'=> $games[$i]['price'] ,
            );
        }
        return response()->json([
            'games' => $data,
        ]);
    }
}

