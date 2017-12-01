@extends('layouts.app')

@section('content')
<body class="admin">
<div class="container">
	<div class="col-md-8 col-md-offset-2 content">
		<form action="{{ action('AuthorController@store') }}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group">
				<label for="author_name">Име на автора: </label>
				<input class="form-control" type="text" name="author_name" id="author_name">
				@if($errors->get('author_name'))
					<div class="alert alert-danger">
						Задължително поле
					</div>
				@endif	
			</div>
			
			<div class="form-group">
				<label for="bio">Информация за автора</label>
				@if($errors->get('bio'))
					<div class="alert alert-danger">
						Задължително поле
					</div>
				@endif
				<textarea class="form-control" name="bio" id="bio" rows="15"></textarea>
			</div>

			<div class="form-group">
				<label class="file">Снимка на автора</label>
	       		<input type="file" id="file" name="author_photo" class="custom-file-input">   	
			</div>
			
			<div class="form-group">
				<button type="submit" class="col-md-8 col-md-offset-2 btn btn-success">Save</button>
			</div>
		</form>
	</div>
</div>
</body>
@endsection