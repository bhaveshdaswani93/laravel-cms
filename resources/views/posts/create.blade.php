@extends('layouts.app')

@section('content')
<div class="card card-default">
  <div class="card-header">Create post</div>
  <div class="card-body">
      @if ($errors->any())
      <div class="alert alert-danger">
            <ul class="list-group">
              @foreach($errors->all() as $error)
                <li class="list-group-item text-danger">
                  {{ $error }}
                </li>
              @endforeach
            </ul>
          </div>
          
      @endif
  <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" id="title" class="form-control" name="title">
      </div>
              <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="5" rows="5" class="form-control"></textarea>
          </div>
          <div class="form-group">
            <label for="content">Content</label>
            {{-- <textarea name="content" id="content" cols="5" rows="5" class="form-control"></textarea> --}}
            <input id="content" type="hidden" name="content">
        <trix-editor input="content"></trix-editor>
          </div>
          <div class="form-group">
              <label for="published_at">Published At</label>
              <input type="text" name="published_at" id="published_at" class="form-control">
            </div>
            <div class="form-group">
                <label for="image">Post Image</label>
                <input type="file" id="image" class="form-control" name="image">
              </div>
              <div class="form-group">
                <label for="category_id">Post category</label>
                <select name="category_id" id="category_id" class="form-control">
                  @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                
              </div>
              <div class="form-group">
                <label for="tags">Post Tag</label>
                <select  name="tags[]" id="tags" multiple class="form-control tag">
                  @foreach ($tags as $tag)
                <option
                    
                value="{{ $tag->id }}">{{ $tag->name }}</option>
                  @endforeach
                </select>
                
              </div>
              
              
      <div class="form-group">
        <button class="btn btn-success">Add post</button>
      </div>
    </form>
  </div>
</div>
@endsection
@section('css')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />

@endsection
@section('script')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  <script>
    flatpickr('#published_at', {
      enableTime: true,
      enableSeconds:true
    })
    $(".tag").select2({

    });
  </script>
@endsection