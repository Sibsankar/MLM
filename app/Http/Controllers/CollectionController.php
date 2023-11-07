<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller
{
    public function list(){
        $collections = Collection::all();

        return view('collection.list')->with(['collections' => $collections]);
    }

    public function create(){
        return view('collection.create');
    }

    public function add(Request $request){
        $collection = Collection::find($request->id);



        return view('collection.create')->with(['collection' => $collection]);
    }

    public function edit($id){
        $collection = Collection::find($request->id);
        


        return view('collection.create')->with(['collection' => $collection]);
    }

    public function update(Request $request, $id){
        $collection = Collection::find($request->id);
        


        return view('collection.create')->with(['collection' => $collection]);
    }

    public function delete($id){
        $collection = Collection::find($request->id);
        


        return view('collection.create')->with(['collection' => $collection]);
    }
}
