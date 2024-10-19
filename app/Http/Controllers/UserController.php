<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function index()
    {
        try{
            $users = User::all();
            return response()->json(['message'=>'User data retrieved successfully.','data'=> $users], 200);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);    
        }
    }
}
