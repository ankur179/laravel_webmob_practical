@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Add a Blog</h1>
  <div>
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('blogs.store') }}">
          @csrf
          <div class="form-group">    
              <label for="title">Title <span class="error">*</span>:</label>
              <input type="text" class="form-control" name="blog_title"/>
          </div>

          <div class="form-group">
              <label for="content">Content <span class="error">*</span> :</label>
              <textarea class="form-control" name="blog_content"/></textarea>
          </div>
          <div class="form-group">
              <label for="categories">Categories <span class="error">*</span> :</label>
              <select class="form-control" name="categories[]" multiple/>
                    @foreach($categories as $category)
                    <option value="{{$category->id}}">{{$category->cat_name}}</option>
                    @endforeach
              </select>
          </div>
          <button type="submit" class="btn btn-success">Add Blog</button>
          <a href="{{route('blogs.index')}}"><button class="btn btn-primary" type="button">Back</button></a>
      </form>
  </div>
</div>
</div>
@endsection
