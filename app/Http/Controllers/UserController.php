<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\UserPurchase;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function getUserInfo(Request $request)
    {
        try {
            if (Auth::check()) {
                return response()->json([
                    'status' => 'success',
                    'status_code' => '200',
                    'user' => $request->user(),
                ]);
            }
        } catch (Exception $exception) {
            return response()->json([
                'status' => 'failed',
                'user' => null,
            ]);
        }
    }

    public function getMyGameList(Request $request)
    {
        $user_id = $request->post('user_id');
        $column = array('games.id', 'name', 'image', 'price', 'rate');
        $games = Game::select($column)
            ->join('purchase_history', 'games.id','=','purchase_history.game_id')
            ->where(['user_id'=> $user_id])
            ->orderBy('id', 'desc')
            ->get();
        return response()->json([
            'games' => $games,
        ]);
    }


}
