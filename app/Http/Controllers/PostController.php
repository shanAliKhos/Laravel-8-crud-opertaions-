<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    
    public function index()
    {
        $post = new Post;

        return Inertia::render('Crud/Index',[
            'posts'=>$post->paginate(10),
        ]);

    }
 
    public function create()
    {
        dd('create');
    }
 
    public function store(Request $request)
    { 
        $this->validate($request,[
            'text' =>'required|min:3|max:255|unique:posts',
            'image'=>'required|mimes:jpg,jpeg,png|max:100', 
            'video'=>'required|mimes:mp4,mov|max:100000', 
        ]);

  
        $post = new Post;
        $post->create([
            'text'=>$request->text,
            'image'=>$request->file('image')->store('post','public'),
            'video'=>$request->file('video')->store('post','public'),
        ]);
        return back()->with('success','Post saved'); 
    }

 
    public function show(Post $post)
    {
        dd('show');
    }

 
    public function edit(Post $post)
    {
        return Inertia::render('Crud/Index',[
            'post'=>$post,
            'posts'=>$post->paginate(10),
        ]);
    }

 
    public function update(Request $request, Post $post)
    { 
        $this->validate($request,[  
            'text' =>  'required|min:3|max:255||unique:posts,text,' .$post->id,  
        ]);  

        if($request->hasFile('image')){
            $this->validate($request,[ 
                "image" => 'required|mimes:jpg,jpeg,png|max:100',   
            ]);         

            try {
                if(Storage::disk('public')->exists($post->image)){
                    Storage::disk('public')->delete($post->image);
                }  
            } catch (\Throwable $th) {

            }       

            $post->update(['image' => $request->file('image')->store('post','public')]);               
        }     
        if(empty($request->image) && $post->image){

            if(Storage::disk('public')->exists($post->image)){
                Storage::disk('public')->delete($post->image);
            }          
            $post->update(['image' => null]);
        }        

        if($request->hasFile('video')){
            $this->validate($request,[ 
                'video'=>'required|mimes:mp4,mov|max:100000', 
 
            ]);         

            try {
                if(Storage::disk('public')->exists($post->video)){
                    Storage::disk('public')->delete($post->video);
                }  
            } catch (\Throwable $th) {

            }       

            $post->update(['video' => $request->file('video')->store('post','public')]);               
        }     
        if(empty($request->video) && $post->video){

            if(Storage::disk('public')->exists($post->video)){
                Storage::disk('public')->delete($post->video);
            }          
            $post->update(['video' => null]);
        }        


        $post->update([  
            'text'=>$request->text,     
        ]);

        return redirect()->route('post.index')->with('success','post update'); 

 
    }
 
    public function destroy(Post $post)
    { 
        if(Storage::disk('public')->exists($post->image)){
            Storage::disk('public')->delete($post->image);
        } 

        if(Storage::disk('public')->exists($post->video)){
            Storage::disk('public')->delete($post->video);
        } 

        try { 

            $post->delete();
            
            return redirect()->route('post.index')->with('success','post deleted');
            
        } catch (\Throwable $th) {
             
            return back()->route('post.index')->with('error','OPP s could not delete ');
        } 
    }
}
