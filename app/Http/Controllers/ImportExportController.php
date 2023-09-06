<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportUsers;
use App\Imports\ImportUsers;
use Maatwebsite\Excel\Facades\Excel;

class ImportExportController extends Controller
{
    public function importExport() {
       return view('import');
    }

    public function export() {
        return Excel::download(new ExportUsers, 'users.xlsx');
    }

    public function import(Request $request) {
        $rules = [
            'file' => 'required|mimes:xls,xlsx,csv',
        ];
    
        $customMessages = [
            'required' => 'The :attribute field is required.'
        ];

        $validator = \Validator::make( $request->all(), $rules, $customMessages );

        if ( $validator->fails() ) {
            return \Redirect::back()->withErrors($validator->errors());
        }
        try {
            $userCount = Excel::import(new ImportUsers, request()->file('file'));
        } catch (\Exception $e){
            return $e;
        }
            
        return redirect()->route('importUsers')->with('successmessage', 'Users imported successfully.');
    }
}
