<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * @aUthoe: Julius Fasema
 * Controller: FunctionController
 * Description: This is the base functions controler that contains all the functions use in the application
 * Date: 06-06-2022
 */
class FunctionController extends Controller
{
    // count users an assign orderid
    public function OrderID() {

        $count = User::where('user_type',2)->count();
    
        return $count;
    }
}
