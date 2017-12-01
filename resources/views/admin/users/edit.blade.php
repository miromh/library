@extends('layouts.app')

@section('content')
<body class="admin">
<div id="edit-form" class="content"> 
	<h1>Edit user</h1>
{!! Form::open(['method' => 'PATCH', 'route' => ['admin.update', $user->id]]) !!}


	<div class="form-group">
	    <input type="text" class="form-control" name="name" value="{{$user->name}}">
	</div>

	<div class="form-group">
	    <input type="email" class="form-control" name="email" value="{{$user->email}}">
	</div>
	
	<div class="form-group">
		<input type="radio" name="role" value="user" 
		@if($user->role == 'user')
		checked
		@endif 
		>
		<strong>User</strong>
	</div>
	<div class="form-group">
		<input type="radio" name="role" value="admin"
		@if($user->role == 'admin')
		checked
		@endif 
		>
		<strong>Admin</strong>
	</div>
	{!! Form::submit('SAVE', ['class' => 'btn btn-success']) !!}
{!! Form::close() !!}
</div>


<div id="delete-form"> 
	<h1>Delete user</h1>
{!! Form::open(['method' => 'DELETE', 'route' => ['admin.destroy', $user->id]]) !!}
	<input type="text" name="id" value="{{ $user->id }}" hidden>
	<div class="form-group">
		<input type="text" class="form-control" name="delete_check" placeholder="Write 'delete' and hit button">

	@if ($errors->has('delete_check'))
		<div class="alert alert-danger" role="alert">
				{{ $errors->first('delete_check')}}
		</div>
	@endif

	{!! Form::submit('DELETE', ['class' => 'btn btn-danger']) !!}
	</div>

{!! Form::close() !!}
</div>
</body>

@endsection