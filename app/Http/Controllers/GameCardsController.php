<?php

namespace App\Http\Controllers;

use App\Models\game_cards;
use App\Models\sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class GameCardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game_cards = game_cards::all();
        return response()->json($game_cards, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'collection_id' => 'required',
            'user_id' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['message' => 'Incomplete data'], 422);
        }
        $sale = sales::create([
                'quantity' => $request->quantity,
                'price' => $request->price,
            ]);
        if(! $sale){
            return response()->json([
                'message' => 'No se pudo realizar el proceso correctamente'
            ], 500);
        }
        else{
            $game_cards = game_cards::create([
                'name' => $request->name,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'sale_id' => $sale->id,
            ]);
            if(! $game_cards){
                $sale->delete();
                return response()->json([
                    'message' => 'No se pudo realizar el proceso correctamente'
                ], 500);
            }
            else{
                DB::table('collection_game_card')->insert(
                    [
                        'collection_id' => $request->collection_id, 
                        'game_card_id' => $game_cards->id,
                    ]
                );
                return response()->json([
                    'message' => 'Se ha creado la carta correctamente'
                ], 201);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\game_cards  $game_cards
     * @return \Illuminate\Http\Response
     */
    public function show($name)
    {   
        $response = [];
        $game_cards = game_cards::where('name', 'LIKE', '%{$name}%')->paginate(10);
        if(! $game_cards){
            return response()->json([
                'message' => 'No se encontraron registros'
            ], 404);
        }
        foreach ($game_cards as $game_card ) {
            
           $sale = sales::where('id', $game_card->sale_id)->get();
           $user = user::where('id', $game_card->user_id)->get();

           $aux =  [
                'name_card' => $game_card->name,
                'quantity' => $sale->quantity,
                'price' => $sale->price,
                'name_user' => $user->name,

            ];
            $response[] = $aux; 
        }
        if(! $response){
            return response()->json([
                    $response
                ], 200);    
        }
        return response()->json([
                'message' => 'No se encontraron registros'
            ], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\game_cards  $game_cards
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, game_cards $game_cards)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\game_cards  $game_cards
     * @return \Illuminate\Http\Response
     */
    public function destroy(game_cards $game_cards)
    {
        //
    }
}
