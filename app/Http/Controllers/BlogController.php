<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\Categories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::with('categories')->with('user')->where('user_id', '=', Auth::user()->id)->get();
        //echo "<pre>";print_r($blogs);die;
        return view('blogs.index', compact('blogs'));
    }

    public function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->date != '')
                $blogs = Blog::with('categories')->with('user')->where('user_id', '=', Auth::user()->id)->whereDate('created_at', '=', $request->date)->get();
            else
                $blogs = Blog::with('categories')->with('user')->where('user_id', '=', Auth::user()->id)->get();
            $categories=[];
            foreach ($blogs as $key => $blog) {
                $categories=[];
                foreach ($blog->categories as $category) {
                    $categories[]=$category->cat_name;
                }
                $blogs[$key]->category = implode(', ',$categories);
            }
            echo json_encode($blogs);exit;
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories= Categories::all();
        return view('blogs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'blog_title'=>'required',
            'blog_content'=>'required'
        ]);
        $blog = new Blog([
            'user_id' => auth()->user()->id,
            'title' => $request->get('blog_title'),
            'content' => $request->get('blog_content'),
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        $blog->save();
        $blog->categories()->attach($request->get('categories'));
        return redirect('/blogs')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories= Categories::all();
        $blog = Blog::with('categories')->find($id);
        $blog_cat=[];
        foreach ($blog->categories as $value) {
            $blog_cat[]=$value->id;
        }
        return view('blogs.edit', compact(['blog','categories','blog_cat']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'blog_title'=>'required',
            'blog_content'=>'required'
        ]);
        $blog = Blog::find($id);
        $blog->title = $request->get('blog_title');
        $blog->content = $request->get('blog_content');
        $blog->updated_at = date("Y-m-d H:i:s");
        $blog->save();
        $blog->categories()->detach();
        $blog->categories()->attach($request->get('categories'));
        return redirect('/blogs')->with('success', 'Blog updated successfully.');
    }   

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->delete();
        return redirect('/blogs')->with('success', 'Blog deleted successfully.');
    }
}
