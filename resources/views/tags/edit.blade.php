@extends('layouts.app')

@section('content')
<div class="card card-default">
  <div class="card-header">Edit Tag</div>
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
  <form action="{{ route('categories.update',$tag->id) }}" method="POST">
        @csrf
        @method('PUT')
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" class="form-control" value="{{ $tag->name }}" name="name">
      </div>
      <div class="form-group">
        <button class="btn btn-success">Edit Tag</button>
      </div>
    </form>
  </div>
</div>
@endsection