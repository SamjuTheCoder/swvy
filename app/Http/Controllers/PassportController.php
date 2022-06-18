<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Passport\TokenRepository;
use Laravel\Passport\RefreshTokenRepository;
use App\Mail\Welcome;
use App\Models\BusinessCard;
use App\Models\UserInterest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

/**
 * Author: Julius Fasema
 * Controller: PassportController
 * Description: This controller contains functions for registration, login, logout and email confirmation
 * Date: 06-06-2022
 */

class PassportController extends FunctionController
{
    public function register(Request $request)
    {
        // collect users input
        $input = $request->only([
            'firstname',
            //'middlename',
            'lastname', 
            'phone',
            'email', 
            'password', 
            'is_terms_conditions',
            // 'title_designation',
            // 'company_name',
            // 'gender', 
            // 'country',
            // 'state',
            // 'city',
            // 'dob',
            // 'notify_dob',
            // 'photo_url',
        ]);
        
    
        // validate user inputs
        $validate_data = [
            'firstname' => 'required|string|min:3',
            'lastname' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'is_terms_conditions' => 'required|numeric',
        ];

        $validator = Validator::make($input, $validate_data);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => "Error",
        //         'errors' => $validator->errors()
        //     ]);
        //     return;
        // }
        
        // check if terms and condition is checked
        if($input['is_terms_conditions'] == null) {
            return response()->json([
                'success' => false,
                'message' => 'Please select terms and conditions',
            ]);
            return;
        }

        //insert record and return user id
        $user = User::create([
            'firstname' => $input['firstname'],
            //'middlename' => $input['middlename'],
            'lastname' => $input['lastname'],
            'phone' => $input['phone'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'is_terms_conditions' => $input['is_terms_conditions'],
            'connection_code' => $this->generateCode(6).$this->OrderID() + 1,
            'user_type' => 2,
            //'title_designation' => $input['title_designation'],
            // 'company_name' => $input['company_name'],
            // 'gender' => $input['gender'],
            // 'country' => $input['country'],
            // 'state' => $input['state'],
            // 'city' => $input['city'],
            // 'dob' => $input['dob'],
            // 'notify_dob' => $input['notify_dob'],
            // 'photo_url' => $input['photo_url'],
        ]);

        // create first business card
        BusinessCard::create([
            'userid' => $user->id,
            'firstname' => $input['firstname'],
            //'middlename' => $input['middlename'],
            'lastname' => $input['lastname'],
            'phone_number' => $input['phone'],
            'email' => $input['email'],
            //'title_designation' => $input['title_designation'],
        ]);

               
        $fullname = $input['firstname'].' '. $input['lastname'];

        Mail::to($input['email'])->send(new Welcome($input['email'], $fullname)); // send welcome email to user

        return response()->json([
            'success' => true,
            'message' => 'Succesfully registered. Please check your inbox to verify your email',
            'userid' =>  $user->id
        ], 200);
        return;
    }

    // generate connection code
    public function generateCode($length) {
        $characters = '1234567890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    // this funcion creates first business card or skip
    public function createBusinessCardOrSkip(Request $request) {

        $input = $request->only([
            'userid',
            'title_designation',
            'company_name',
            'gender', 
            'country',
            'state',
            'city',
            'year',
            'month',
            'day',
            'dob',
            'notify_dob',
            //'photo_url',
        ]);

         // validate user inputs
         $validate_data = [
            'title_designation' => 'required|string|min:3',
            'company_name' => 'required|string|min:3',
            'gender' => 'required|string',
            'password' => 'required|min:6',
         ];
        
        //insert record and return user id
        $user = User::where('id',$input['userid'])->update([

            'title_designation' => $input['title_designation'],
            'company_name' => $input['company_name'],
            'gender' => $input['gender'],
            'country' => $input['country'],
            'state' => $input['state'],
            'city' => $input['city'],
            'dob' => $input['year'] .'-'.$input['month'].'-'.$input['day'],
            'notify_dob' => $input['notify_dob'],
            //'photo_url' => $input['photo_url'],
        ]);

        // create first business card
        BusinessCard::where('userid',$input['userid'])->update([
        
            'title_designation' => $input['title_designation'],
            'company_name' => $input['company_name'],
            // 'gender' => $input['gender'],
            // 'country' => $input['country'],
            // 'state' => $input['state'],
            // 'city' => $input['city'],
            // 'dob' => $input['year'] .'-'.$input['month'].'-'.$input['day'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Successfully created',
        ], 200);
        return;

    }

    // verify email 
    public function verifyEmail($email){

        $isVerify = User::where('email','=',$email)->exists();
        
        if($isVerify == true){

            User::where('email','=',$email)->update(['email_verify_status' => 1, 'email_verified_at' => date('Y-m-d H:i:s')]);
            return response()->json([
                'success' => true,
                'message' => 'Email verified!',
            ]);
            return;

        }else {

            return response()->json([
                'success' => false,
                'message' => 'Email does not exists in our database!',
            ]);
            return;
        }

    } 

    /**
     *  edit and update user profile
     *  @return success
     */
    public function editProfile(Request $request) {

        $userdata = [];

        $input = $request->only([
            'userid',
        ]);

        if(User::where('id', $input['userid'])->exists()){

            $userdata = User::where('users.id',$input['userid'])
            ->select('users.id','firstname','middlename','lastname','phone','title_designation','gender','company_name','country','state','city','dob','notify_dob','fb','wap','tw','lnkd','photo_url')
            ->first();

            $userinterest = UserInterest::where('user_interests.userid',$input['userid'])
            ->select('interests')
            ->get();
            
            return response()->json([
                'success' => true,
                'data' => [
                    'userdata'=>$userdata,
                    "userinterest"=>$userinterest
                ]
            ]);
            return;
        }else {
            return response()->json([
                'success' => false,
                'message' => 'Error',
            ]);
            return;
        }

    }
    public function updateProfile(Request $request) {

        $input = $request->only([
            'userid',
            'firstname',
            'middlename',
            'lastname', 
            'phone',
            'title_designation',
            'gender', 
            'company_name',
            'country',
            'state',
            'city',
            'dob',
            'notify_dob',
            'fb',
            'wap',
            'tw',
            'lnkd',
            'photo_url',
            'interests',
        ]);

         //update record and return user id
         $update = User::where('id', $input['userid'])->update([
            'firstname' => $input['firstname'],
            'middlename' => $input['middlename'],
            'lastname' => $input['lastname'],
            'phone' => $input['phone'],
            'company_name' => $input['company_name'],
            'title_designation' => $input['title_designation'],
            'gender' => $input['gender'],
            'country' => $input['country'],
            'state' => $input['state'],
            'city' => $input['city'],
            'dob' => $input['dob'],
            'notify_dob' => $input['notify_dob'],
            'fb' => $input['fb'],
            'wap' => $input['wap'],
            'tw' => $input['tw'],
            'lnkd' => $input['lnkd'],
            'photo_url' => $input['photo_url'],
        ]);
        
        // check if interest is selected
        if( $input['interests']!=null ){

            foreach ($input['interests'] as $key => $value) {
                //insert record into interests
                UserInterest::create([
                    'userid' => $input['userid'],
                    'interests' => $value,
                ]);
         
            }  

        }
        

        if($request->hasfile('photo_url'))
        {
            File::makeDirectory('userPhotos', 0755, true, true);
            
              $photo = $request->file('photo_url');
              
              $rules = ['photo_url' => 'mimes:jpg,jpeg'];
              $x = $request->only('photo_url');
              Validator::make($x, $rules);
              
              foreach($photo as $key => $photoFile){
                  $name = time() . '' . $key . '.' .$photoFile->getClientOriginalExtension();
                  $location = 'images/';
                  $photoFile->move($location, $name);
                }
        }

            if($update){
                return response()->json([
                    'success' => true,
                    'message' => 'Profile updated successfully',
                ]);
                return;
            }
            else{
                return response()->json([
                    'success' => false,
                    'message' => 'Something went wrong',
                ]);
                return;
            }
    }
 
    /**
     * Login user.
     *
     * @return json
     */
    public function login(Request $request)
    {
        $input = $request->only(['email', 'password']);

        $validate_data = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $validator = Validator::make($input, $validate_data);
        
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Please see errors parameter for all errors.',
                'errors' => $validator->errors()
            ]);
        }

        // authentication attempt
        if (auth()->attempt($input)) {
            $token = auth()->user()->createToken('passport_token')->accessToken;
            
            return response()->json([
                'success' => true,
                'message' => 'User login succesfully',
                "userid" => Auth::user()->id,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User authentication failed.'
            ]);
        }
    }

    /**
     * Access method to authenticate.
     *
     * @return json
     */
    public function userDetail()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data fetched successfully.',
            'data' => auth()->user()
        ], 200);
    }

    /**
     * Logout user.
     *
     * @return json
     */
    public function logout()
    {
        $access_token = auth()->user()->token();

        // logout from only current device
        $tokenRepository = app(TokenRepository::class);
        $tokenRepository->revokeAccessToken($access_token->id);

        // use this method to logout from all devices
        // $refreshTokenRepository = app(RefreshTokenRepository::class);
        // $refreshTokenRepository->revokeRefreshTokensByAccessTokenId($$access_token->id);

        return response()->json([
            'success' => true,
            'message' => 'User logout successfully.'
        ], 200);
    }
}
