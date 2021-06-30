<?php

namespace App\Http\Controllers;

use App\Models\Foods;
use Illuminate\Http\Request;

class FoodsController extends Controller
{
    public function index()
    {
        return Foods::all();
    }

    public function store(Request $request)
    {
        try{
            $post               = new Foods();
            $post->name         = $request->name;
            $post->food_status  = $request->status;
            $post->price        = $request->price;
            
            if($post->save()){
                return response()->json(
                    [
                        'status'    =>  'success',
                        'message'   =>  'Foood created successfully'
                    ]);
            }
        }catch(\Exception $e){
            return response()->json(
                [
                    'status'    =>  'error',
                    'message'   =>  $e->getMessage()
                ]);
        }
    }

    public function update(Request $request, $id)
    {
        try{
            $post               = Foods::findOrFail($id);
            $post->name         = $request->name;
            $post->food_status  = $request->status;
            $post->price        = $request->price;
            
            if($post->save()){
                return response()->json(
                    [
                        'status'    =>  'success',
                        'message'   =>  'Food updated successfully'
                    ]);
            }
        }catch(\Exception $e){
            return response()->json(
                [
                    'status'    =>  'error',
                    'message'   =>  $e->getMessage()
                ]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try{
            $post           = Foods::findOrFail($id);
            
            if($post->delete()){
                return response()->json(
                    [
                        'status'    =>  'success',
                        'message'   =>  'Food deleted successfully'
                    ]);
            }
        }catch(\Exception $e){
            return response()->json(
                [
                    'status'    =>  'error',
                    'message'   =>  $e->getMessage()
                ]);
        }
    }
}
