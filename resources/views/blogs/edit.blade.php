@extends('layouts.app')

@section('content')
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h1 class="display-3">Update a Blog</h1>
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
      <form method="post" action="{{ route('blogs.update', $blog->id) }}">
          @method('PATCH')
          @csrf
          <div class="form-group">    
              <label for="title">Title <span class="error">*</span>:</label>
              <input type="text" class="form-control" name="blog_title" value="{{ $blog->title }}"/>
          </div>

          <div class="form-group">
              <label for="content">Content <span class="error">*</span> :</label>
              <textarea class="form-control" name="blog_content"/>{{$blog->content}}</textarea>
          </div>
          <div class="form-group">
              <label for="categories">Categories <span class="error">*</span> :</label>
              <select class="form-control" name="categories[]" multiple/>
                    @foreach($categories as $category)
                        {{$selected=''}}
                        @if (in_array($category->id,$blog_cat))
                         {{$selected='selected'}}
                        @endif
                    <option value="{{$category->id}}" {{$selected}}>{{$category->cat_name}}</option>
                    @endforeach
              </select>
          </div>
          <button type="submit" class="btn blogs">Update Blog</button>
          <a href="{{ route('blogs.index') }}"> <button class="btn btn-primary" type="button">Back</button></a>
      </form>
  </div>
</div>
</div>
@endsection
