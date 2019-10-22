@extends('layouts.app')

@section('content')
@if(session()->has('success'))
    <div class="alert alert-success alert-dismissable" style="margin: 15px;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        {{ session()->get('success') }}
    </div>
@endif
<div class="col-md-12 row">
<div class="col-sm-12">
    <h1 class="display-3">Blogs List</h1> 
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div>
      @endif
</div>
</div>
    <div class="col-md-12 row">
        <div class="col-md-6">
            Created Date: 
            <input name="created_at" id="created_at" readonly>
            <button type="button" class="btn btn-primary" id="btnFilter">Filter</button>
            <button type="button" class="btn btn-danger" id="btnReset">Reset</button>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('blogs.create')}}" class="btn btn-success">
                Add Blog
            </a>
        </div>
        </div>
    <br>
    <div class="col-md-12 row">
    <div class="col-sm-12">
  <table class="table table-striped">
    <thead>
        <tr>
          <td>Title</td>
          <td>Categories</td>
          <td>Created At</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @if(!$blogs->isEmpty())
        @foreach($blogs as $blog)
            <?php 
            $cat=[];
            foreach ($blog->categories as $category) {
                $cat[]=$category->cat_name;
            }
            $cate = implode(', ', $cat);
             ?>
        <tr>
            <td>{{$blog->title}}</td>
            <td>{{$cate}}</td>
            <td>{{$blog->created_at}}</td>
            <td>
                <a href="{{ route('blogs.edit',$blog->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('blogs.destroy', $blog->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
       
        @else
            <tr>
                <td colspan="4">No record fond.</td>
            </tr>
        @endif
    </tbody>
  </table>
</div>
</div>
@endsection