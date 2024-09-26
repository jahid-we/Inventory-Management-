<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function CategoryPage(){
        return view('pages.dashboard.category-page');
    }

    function CategoryList(Request $request){
        $user_id=$request->header('id');
        return Category::where('user_id',$user_id)->get();

    }

    function CategoryCreate(Request $request){
        try{
            $user_id=$request->header('id');
             Category::create([
            'name'=>$request->input('name'),
            'user_id'=>$user_id
        ]);
        return response()->json([
        'status'=> 'success',
        'message'=> 'Category Created Successfully'
        ],201);

        }catch (Exception $e){
            return response()->json([
                'status'=> 'Failed',
                'message'=> 'Category Creation Failed'
            ],400);
        }

    }

    function CategoryDelete(Request $request){
        try{
         $category_id=$request->input('id');
         $user_id=$request->header('id');
         Category::where('id',$category_id)->where('user_id',$user_id)->delete();
         return response()->json([
            'status'=> 'success',
            'message'=> 'Category Deleted Successfully'
            ],200);
        }catch (Exception $e){
            return response()->json([
                'status'=> 'Failed',
                'message'=> 'Category Deletion Failed'
            ],400);
        }

    }


    function CategoryUpdate(Request $request){
        try{
            $category_id=$request->input('id');
            $user_id=$request->header('id');
            Category::where('id',$category_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
            ]);
            return response()->json([
                'status'=> 'success',
                'message'=> 'Category Updated Successfully'
            ],200);
        }catch(Exception $e){
            return response()->json([
                'status'=> 'Failed',
                'message'=> 'Category Updating Failed'
            ],400);
        };

    }
    function CategoryByID(Request $request){
    $category_id=$request->input('id');
    $user_id=$request->header('id');
    return Category::where('id',$category_id)->where('user_id',$user_id)->first();
    }
}

