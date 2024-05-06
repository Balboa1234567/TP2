<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comment= Comment::all();
        if($comment){

            return response()->json([
                'status'=>true,
                'comment'=>$comment
            ],200);            
          
        }else{

            return response()->json([
                'status'=>false,
                'Message'=>"comment not found"
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
        $this->authorize('create');
        $comment=new Comment();
        $comment->content=$request->content;
        $comment->user_id=Auth::user()->id;
        $comment->save();

        $validate = $request->validate([
            'content'=>'required|string'
        ]);
        $comment= Comment::create($request->all());
        if($comment){
            return response()->json([
                'status'=>true,
                'Message'=>"comment has been added",
                'comment'=>$comment
            ],200);
        }else{

           return response()->json([
            'status'=>false,
            'Message'=>"Our comment has not been added! Sorry retry in few times"
           ],404);
            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $comment= Comment::find($id);
     
       if($comment){
        return response()->json([
            'status'=>true,
            'comment'=>$comment
        ],200);

     } else{

        return response()->json([
            'status'=>false,
            'Message'=>"The comment has not been found"
        ]);
     }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comment = Commment::find($id);
        if($comment){
           return response()->json([
            'status'=>true,
            'comment'=>$comment
           ],200);
        }else{
            return response()->json([
                'status'=>false,
                'Message'=>"The content has not been found! retry in fews"
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       $comment = Comment::find($id);
       if(!$comment){
        return response()->json([
            'status'=>false,
            'Message'=>"Comment did not exist"
        ],404);
       }   
       $validate=$request->validate([
            'content'=>'required|string'
       ]);

       $comment=update($validate);
       return response()->json([
            'status'=>true,
            'comment'=>$comment
       ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment= Comment::find($id);
        $comment->delete();

        if($comment){
            return response()->json([
                'status'=>true,
                'Message'=>"Content was deleted Successfully"
            ]);
        }
            else{
                return response()->json([
                    'status'=>false,
                    'Message'=>"Content has not been deleted"
                ]);
        }
    }
}
