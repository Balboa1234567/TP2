<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use Appp\Models\Comment;


class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $article = Article::all();
        $article->load('comments');
        if($article){
            return response()->json([
                'Status'=>true,
                'article'=> $article ]);
        }
        else{
              return response()->json([
                'Status'=>false,
                'Message'=>'article not found'

              ],404);
                
        }
       
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $validate = $request->validate([
            'name'=>'required|string|max:255',
            'price'=>'required|numeric',
            'description'=>'required|string|max:255',
        ]);
        $article= Article::create($request->all());
         if($article){
            return response()->json([
                'staus'=>true,
                'Message'=>"Article has been created Successfully",
                'article'=> $article
            ],200);
         }
         else{
            return response()->json([
                'status'=> false,
                'Message'=>"Article has not been created ",
            ],400);       
         }
       
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $article = Article::with('comments')->findOrFail($id);
        $article->load('comments');

        if($article){
            return response()->json([
                'status'=>true,
                'article'=>$article
                
            ],200);
        }
        else{
           return response()->json([
            'status'=>false,
            'Message'=>'article has not found'
           ],404); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article= Article::find($id);
        if(!$article){
            return response()->json([
                'status'=>false,
                'Message'=>"Article not found"
            ],404);
        }
        else{
            return response()->json([
                'status'=>true,
                'article'=>$article
            ],202);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $article=Article::find($id);
        if(!$article){
           return respone()->json([
            'status'=>false,
            'Message'=>"Article has not been found"
           ],404); 
        }
        $validate=$request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string'
        ]);
        $article->update($validate);
        return response()->json([
            'status'=>true,
            'Message'=>"Article has updated successfully",
            'article'=>$article
        ],200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article=Article::find($id);
        if($article){
            $article->delete();
            return response()->json([
                'status'=>true,
                'Message'=>"Article has been deleted successfully"
            ],200);
        }
            else{
            return response()->json([
                'status'=>false,
                'Message'=>"Article has not found"
            ],404);     

    }}

}