@extends('layouts.app')

@section('content')

<body class="admin">  
<div class="container">
	<div class="col col-md-8 col-md-offset-2 content">
	
		
		<form method="post" action="{{ action('BookController@store') }}" enctype="multipart/form-data">
			{{ csrf_field() }}
				<div class="form-group">
					<label for="book_name">Име на книгата:</label>          
					<input type="text" class="form-control" id="book_name" name="book_name" value="{{ old('book_name') }}">
					@if($errors->get('book_name'))
					<div class="alert alert-danger">
					@foreach($errors->get('book_name') as $error)
					<p>{{$error}}</p>
					@endforeach
					@endif          
				</div>
				<label for="excerption">Информация за книгата:</label>
				@if($errors->get('excerption'))
					<div class="alert alert-danger">
					<p>{{ $errors->get('excerption')[0] }}</p>
					</div>
				@endif
				<textarea name="excerption" id="excerption" class="form-control" rows="15">{{ old('excerption') }}</textarea> 
				<div class="empty-space-large"></div>
				<div class="form-group">
					<label for="author_name">Автор:</label>          
					<select name="author_id" class="form-control">            
						<option disabled selected>Select</option>
						@foreach($authors as $author)
						<option value="{{$author->id}}">{{$author->name}}</option>
						@endforeach
					</select>
					@if($errors->get('author_id'))
						<div class="alert alert-danger">
						<p>{{ $errors->get('author_id')[0] }}</p>
						</div>
					@endif
				</div>
				
				<div class="empty-space"></div>

				<label class="file">Обложка/Корица (JPG/JPEG)</label>
				<input type="file" id="file" name="book_cover" class="custom-file-input">              
			
				<div class="empty-space"></div>
				
				<label class="file2">File (PDF/TXT)</label>
				<input type="file" id="file2" name="book_file" class="custom-file-input">              
						@if($errors->get('book_file'))
								<div class="alert alert-danger">
								@foreach($errors->get('book_file') as $file_error)
									<p>{{ $file_error }}</p>
								@endforeach
								</div>
						@endif
				<div class="empty-space"></div>
				
				<div class="form-group">
					<label for="total_pages">Pages</label>
					<input class="form-control" type="number" name="total_pages" id="total_pages" min="10" value="{{ old('total_pages') }}">
					 @if($errors->get('total_pages'))
								<div class="alert alert-danger">
								@foreach($errors->get('total_pages') as $page_num_error)
									<p>{{ $page_num_error }}</p>
								@endforeach
								</div>
						@endif
				</div>      
				<input type="submit" class="btn btn-primary" value="Save">
		</form>
	</div>
</body>
@endsection