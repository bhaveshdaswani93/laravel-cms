@extends('layouts.app')

@section('content')
{{-- <div class="d-flex justify-content-end mb-2">
  <a href="{{ route('users.create') }}" class="btn btn-success">Add user</a>
</div> --}}

<div class="card card-default">
  <div class="card-header">users</div>
  <div class="card-body">
  @if($users->count() > 0)
    <table class="table">
      <thead>
        <th>Avtar</th>
        <th>Name</th>
        {{-- <th>No of posts</th> --}}
        <th></th>
      </thead>

      <tbody>

        @foreach($users as $user)
          <tr>
            <td>
              <img src="{{ gravatar($user->email)->size(120) }}" alt="">
            </td>
            <td>
              {{ $user->name }}
            </td>
            {{-- <td>
              {{ $user->posts->count() }}
            </td> --}}
            <td>
              @if (!Auth::user()->isAdmin())
                <form action="{{ route('users.make.admin',$user->id) }}"></form>
                @csrf
                @method('PUT')
                {{-- <button class="btn btn-info btn-sm" onclick="handleDelete({{ $user->id }})">Delete</button> --}}
                <button class="btn btn-info btn-sm" onclick="handleDelete({{ $user->id }})">Make Admin</button>    
              @endif
              
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <form action="" method="POST" id="deleteuserForm">
            @csrf
            @method('DELETE')
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <p class="text-center text-bold">
                  Are you sure you want to delete this user ?
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
    @else
    <h3 class="text-center">No users yet.</h3>
    @endif
  </div>
</div>
@javascript('users_index',  route('users.index') )
@endsection
@section('script')
<script>
  function handleDelete(id) {
    
    let url = users_index;
    var form = document.getElementById('deleteuserForm')
    form.action = url+'/' + id
    $('#deleteModal').modal('show')
  }
</script>
@endsection