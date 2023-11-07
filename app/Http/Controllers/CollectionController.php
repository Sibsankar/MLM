<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use Auth;
use File;

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
        // dd($request->all());
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'aadhar' => $request->aadhar,
            'segment' => $request->segment,
            'amount' => $request->amount,
            'txn_id' => $request->txn_id,
            'payment_details' => $request->payment_details,
            'user_id' => Auth::user()->id
        ];

        if(!empty($request->payment_image)) {
            if (!file_exists(public_path().'images')) {            
                if(File::makeDirectory(public_path().'images',0777,true)){   

                }
            }
            $imageName = time().'.'.$request->payment_image->extension();

            // Public Folder
            $request->payment_image->move(public_path('images'), $imageName);
            $data['payment_image'] = $imageName;
        }
        Collection::create($data);
        
        return redirect()->route('collection_create')->with('successmessage','Added successfully');
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
