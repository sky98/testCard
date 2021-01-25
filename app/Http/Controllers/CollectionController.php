<?php

namespace App\Http\Controllers;

use App\Models\collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CollectionController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'symbol' => 'required',
            'edition_date' => 'required'
        ]);
        if($validator->fails()){
            return response()->json(['message' => 'Incomplete data'], 422);
        }
        $collection = collection::create([
                'name' => $request->name,
                'symbol' => $request->symbol,
                'edition_date' => $request->edition_date,
            ]);
        if(! $collection){
            return response()->json([
                'message' => 'No se pudo realizar el proceso correctamente'
            ], 500);
        }
        return response()->json([
                    'message' => 'Se ha creado la coleccion correctamente'
                ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, collection $collection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(collection $collection)
    {
        //
    }
}
