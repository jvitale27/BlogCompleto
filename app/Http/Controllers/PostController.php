<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class PostController extends Controller
{
    public function index(){
//    	$posts = Post::where('status', 2)->get();						//todos
//    	$posts = Post::where('status', 2)->paginate(8);					//paginado de 8
    	$posts = Post::where('status', 2)->latest('id')->paginate(8);	//del ultimo al primero por 'id'

    	return view('posts.index', compact('posts'));
    }

    public function show(Post $post){

    	$similares = Post::where('category_id', $post->category_id)
    					->where('status', 2)
    					->where('id', '!=', $post->id)
    					->latest('id')
    					->take(4)
    					->get();					/* take() acepta el metodo get() */
    					
    	return view('posts.show', compact('post', 'similares'));

    }

    public function category(Category $category){
 /*   
    	$posts = Post::where('category_id', $category->id)
    					->where('status', 2)
    					->latest('id')
    					->paginate(4);
*/
		//lo mismo. paginate() no necesita el metodo get()
    	$posts = $category->posts()->where('status',2)->latest('id')->paginate(4);


    	return view('posts.category', compact('posts', 'category'));
    }

    public function tag(Tag $tag){

    	$posts = $tag->posts()->where('status',2)->latest('id')->paginate(4);

    	return view('posts.tag', compact('posts', 'tag'));
    }
}