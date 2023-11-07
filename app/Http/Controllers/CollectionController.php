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
        $rules = [
            'name' => 'required',
            'phone' => 'required',           
            'address' => 'required',
            'aadhar' => 'required',
            'segment' => 'required',
            'amount' => 'required',
            'txn_id' => 'required',
            'payment_details' => 'required',
            'payment_image' => 'image|mimes:png,jpg,jpeg|max:2048',
        ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $validator = \Validator::make( $request->all(), $rules, $customMessages );

        if ( $validator->fails() ) {
            return \Redirect::back()->withErrors($validator->errors());
        }


        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'aadhar' => $request->aadhar,
            'segment' => $request->segment,
            'amount' => $request->amount,
            'txnid' => $request->txn_id,
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
        
        return redirect()->route('collection_list')->with('successmessage','Added successfully');
    }

    public function edit($id){
        $collection = Collection::find($id);
        
        return view('collection.edit')->with(['collection' => $collection]);
    }

    public function update(Request $request, $id){
        $collection = Collection::find($id);
        $rules = [
            'name' => 'required',
            'phone' => 'required',           
            'address' => 'required',
            'aadhar' => 'required',
            'segment' => 'required',
            'amount' => 'required',
            'txn_id' => 'required',
            'payment_details' => 'required',
            'payment_image' => 'image|mimes:png,jpg,jpeg|max:2048',
        ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $validator = \Validator::make( $request->all(), $rules, $customMessages );

        if ( $validator->fails() ) {
            return \Redirect::back()->withErrors($validator->errors());
        }

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'aadhar' => $request->aadhar,
            'segment' => $request->segment,
            'amount' => $request->amount,
            'txnid' => $request->txn_id,
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
        $collection->update($data);


        return redirect()->route('collection_edit', ['id' => $id])->with('successmessage','Updated successfully');
    }

    public function delete($id){
        $collection = Collection::find($id)->delete();
        
        return redirect()->route('collection_list')->with('successmessage','Deleted successfully');
    }
}
