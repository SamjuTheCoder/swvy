<?php

namespace App\Http\Controllers;

use App\Models\BusinessCard;
use App\Models\CardPhotoGallery;
use App\Models\CardProductService;
use App\Models\CardSocial;
use App\Models\CardVideo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

/**
 * Author: Julius Fasema
 * Controller: BusinessCardController
 * Description: This controller contains functions for busiess card
 * Date: 06-06-2022
 */

class BusinessCardController extends Controller
{
    public function create(Request $request)
    {
        // collect users input
        $input = $request->only([
            'userid',
            'firstname',
            'middlename',
            'lastname', 
            'phone_number',
            'email',
            'business_address',
            'title_designation',
            'company_name',
            'description',
            'background_color',
            'card_width',
            'card_height',
            'text_color',
            'text_size',
            'photo_url',
            'card_social',
            'card_photo_gallery',
            'card_product_service',
            'card_video',
            
        ]);
        
        // validate user inputs
        $validate_data = [
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'email' => 'required|email',
            'phone_number' => 'required',
            'title_designation' => 'required|string',
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
        /*
        return response()->json([
            'success' => true,
            'message' => 'Please see errors parameter for all errors.',
            'card_photo_gallery' => $input['card_photo_gallery']
        ]);
        return;
        */
        
        //insert record and return card id
        $card = BusinessCard::create([
            'userid' => $input['userid'],
            'firstname' => $input['firstname'],
            'middlename' => $input['middlename'],
            'lastname' => $input['lastname'],
            'phone_number' => $input['phone_number'],
            'email' => $input['email'],
            'business_address' => $input['business_address'],
            'title_designation' => $input['title_designation'],
            'company_name' => $input['company_name'],
            'description' => $input['description'],
            'background_color' => $input['background_color'],
            'card_width' => $input['card_width'],
            'card_height' => $input['card_height'],
            'text_color' => $input['text_color'],
            'text_size' => $input['text_size'],
            'photo_url' => $input['photo_url'],
        ]);

       // check if card_socials is selected
       if( $input['card_social']!=null ){

        foreach ($input['card_social'] as $key => $value) {
            //insert record into card_socials
            CardSocial::create([
                'cardid' => $card->id,
                'userid' => $input['userid'],
                'social_media' => $value,
            ]);
     
        }  

    }

    // check if card_photo_gallery is selected
    if( $input['card_photo_gallery']!=null ){

        foreach ($input['card_photo_gallery'] as $key => $value) {

            //print_r($value['photo_title']);
            //insert record into card_socials
            CardPhotoGallery::create([
                'cardid' => $card->id,
                'userid' => $input['userid'],
                'photo_title' => $value['photo_title'],
                'photo_url'=> $value['photo_url'],
            ]);
     
        }  

    }

     // check if card_product_service is selected
    if( $input['card_product_service']!=null ){

        foreach ($input['card_product_service'] as $key => $value) {
            //insert record into card_socials
            CardProductService::create([
                'cardid' => $card->id,
                'userid' => $input['userid'],
                'product_services' => $value['product_services'],
            ]);
     
        }  

    }

     // check if card_video is selected
     if( $input['card_video']!=null ){

        foreach ($input['card_video'] as $key => $value) {
            //insert record into card_socials
            CardVideo::create([
                'cardid' => $card->id,
                'userid' => $input['userid'],
                'video_title' => $value['video_title'],
                'video_url' => $value['video_url'],
            ]);
     
        }  

    }

        return response()->json([
            'success' => true,
            'message' => 'Succesfully created'
        ], 200);
        return;
    }

     // list all business card
     public function listBusinessCards(){

        $list =  BusinessCard::all();
        $listsocial =  CardSocial::all();
        $listphoto =  CardPhotoGallery::all();
        $listproduct =  CardProductService::all();
        $listvideo =  CardVideo::all();
 
        return response()->json([
             'success' => true,
             'card_list' => [
                 'card_details' => $list,
                 'social_details' => $listsocial,
                 'photo_details' => $listphoto,
                 'product_details' => $listproduct,
                 'video_details' => $listvideo,
             ]
         ], 200);
         return;
     }
 
     // list all business card that belongs to a user
     public function listMyBusinessCards(){
         $detail_list = [];
         $list =  BusinessCard::where('business_cards.userid',Auth::user()->id)
         ->get();
         
        //  foreach ($list as $key => $value) {
        //     $listsocial =  CardSocial::where('cardid',$value->id)->get();
        //     $listphoto =  CardPhotoGallery::where('cardid',$value->id)->get();
        //     $listproduct =  CardProductService::where('cardid',$value->id)->get();
        //     $listvideo =  CardVideo::where('cardid',$value->id)->get();
        //  }
        
        // array_push($detail_list, ['card_list' => $list,'social_media'=>$listsocial,'photo'=>$listphoto, 'product'=>$listproduct, 'video'=>$listvideo]);

         return response()->json([
              'success' => true,
              'card_list' => $list
          ], 200);
          return;
      }
 
}
