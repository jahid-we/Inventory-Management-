<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{

    function CustomerPage():View{
        return view('pages.dashboard.customer-page');
    }

    function CustomerCreate(Request $request){
       try{
         $user_id=$request->header('id');
         Customer::create([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile'),
            'address'=>$request->input('address'),
            'user_id'=>$user_id
        ]);
        return response()->json([
            'status'=> 'success',
            'message'=> 'Info Created Successfully'
        ],201);
       }catch(Exception $e){
        return response()->json([
            'status'=> 'Failed',
            'message'=> 'Info Creation Failed'
        ],400);
       }

    }


    function CustomerList(Request $request){
        $user_id=$request->header('id');
        return Customer::where("user_id",$user_id)->get();
    }


    function CustomerDelete(Request $request){
        try{
        $customer_id=$request->input("id");
        $user_id=$request->header("id");

        Customer::where("id",$customer_id)
                ->where("user_id",$user_id)
                ->delete();
                return response()->json([
                    'status'=> 'success',
                    'message'=> 'Info Deleted Successfully'
                ],200);
        }catch(Exception $e){
            return response()->json([
                'status'=> 'Failed',
                'message'=> 'Info Deletion Failed'
            ],400);
        }
    }


    function CustomerByID(Request $request){

        $customer_id=$request->input("id");
        $user_id=$request->header("id");
        return Customer::where("id",$customer_id)
                ->where("user_id",$user_id)
                ->first();
    }


     function CustomerUpdate(Request $request){
        try{
             $customer_id=$request->input("id");
             $user_id=$request->header("id");
             Customer::where("id",$customer_id)
                ->where("user_id",$user_id)
                ->update([
                    'name'=>$request->input('name'),
                    'email'=>$request->input('email'),
                    'mobile'=>$request->input('mobile'),
                    'address'=>$request->input('address'),
                ]);
                return response()->json([
                    'status'=> 'success',
                    'message'=> 'Info Updated Successfully'
                ],200);
        }catch(Exception $e){
            return response()->json([
                'status'=> 'Failed',
                'message'=> 'Info Updating Failed'
            ],400);
        }


    }



}
