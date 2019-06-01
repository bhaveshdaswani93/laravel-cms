@extends('layouts.app')

@section('content')
{{-- <div class="d-flex justify-content-end mb-2">
  <a href="{{ route('posts.create') }}" class="btn btn-success">Add Post</a>
</div> --}}

<div class="card card-default">
  <div class="card-header">Trash Posts</div>
  <div class="card-body">
  @if($posts->count() > 0)
    <table class="table">
      <thead>
        <th>Image</th>
        <th>Title</th>
        <th></th>
      </thead>

      <tbody>

        @foreach($posts as $post)
          <tr>
              <td>
              <img  src="{{asset('storage/'.$post->image)}}" alt="">
                </td>
            <td>
              {{ $post->title }}
            </td>
            <td>
              {{-- <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">
                Edit
              </a> --}}
              <button class="btn btn-info btn-sm" onclick="handleRestore({{ $post->id }})">Restore</button>

              <button class="btn btn-danger btn-sm" onclick="handleDelete({{ $post->id }})">Delete</button>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deletepostForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="text-center text-bold">
                  Are you sure you want to delete this post ?
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                <button type="submit" class="btn btn-danger">Yes, Delete</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    <div class="modal fade" id="restoreModal" tabindex="-1" role="dialog" aria-labelledby="restoreModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="" method="POST" id="restorepostForm">
            @csrf
            @method('PUT')
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="restoreModalLabel">Restore post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="text-center text-bold">
                  Are you sure you want to restore this post ?
                </p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Go back</button>
                <button type="submit" class="btn btn-info">Yes, restore</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    @else
    <h3 class="text-center">No Trash posts yet.</h3>
    @endif
  </div>
</div>
@javascript('posts_trash_index',  route('posts.index') )
@endsection
@section('script')
<script>
  function handleDelete(id) {
    
    let url = posts_trash_index;
    var form = document.getElementById('deletepostForm')
    form.action = url+'/' + id
    $('#deleteModal').modal('show')
  }

  function handleRestore(id) {
    
    let url = posts_trash_index;
    var form = document.getElementById('restorepostForm')
    form.action = url+'/'+ id+ '/restore' 
    $('#restoreModal').modal('show')
  }
</script>
@endsection