<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 *  @Author: Julius Fasema
 *  Controller: InterestController
 *  Description: this controller handles functions for performing operation on interests
 *  Date: 2020-06-12
 */
class InterestController extends Controller
{
    
    // creates interests
    public function createInterests(Request $request){

        $input = $request->only([
            'interest_name',            
        ]);
        
        // validate user inputs
        $validate_data = [
            'interest_name' => 'required|string|min:3',
        ];

        $validator = Validator::make($input, $validate_data);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
            return;
        }

        // insert record
        Interest::create([
            'interest_name' =>  $input['interest_name'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Succesfully created'
        ], 200);
        return;

    }

    //fetch interests
    public function fetchInterests() {

        $data = Interest::select('id','interest_name')->get();

        return response()->json([
            'success' => true,
            'interestdata' => $data
        ],200);
        return;
    }
}
