<?php

namespace App\Http\Controllers;

use App\Models\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 *  @Author: Julius Fasema
 *  Controller: ProductServiceController
 *  Description: this controller handles functions for performing operation on product and services
 *  Date: 2020-06-12
 */
class ProductServiceController extends Controller
{
     // creates product_service_name
     public function createProductService(Request $request){

        $input = $request->only([
            'product_service_name',            
        ]);
        
        // validate user inputs
        $validate_data = [
            'product_service_name' => 'required|string|min:3',
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
        ProductService::create([
            'product_service_name' =>  $input['product_service_name'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Succesfully created'
        ], 200);
        return;

    }

//fetch product_service_name
public function fetchProductService() {

    $data = ProductService::select('id','product_service_name')->get();
    return response()->json([
        'success' => true,
        'product_service_data' => $data
    ],200);
    return;
}
}
