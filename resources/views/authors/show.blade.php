@extends('layouts.app')

@section('content')

<div id="container">
	<div class="col-md-8 col-md-offset-2 author content">
		<h1>{{ $author->name }}</h1>
		<div class="empty-space"></div>
		<img src="{{ $author->photo_path }}">		
		<div class="empty-space"></div>
		<p>{!! $author->bio !!}</p>
		<div class="empty-space"></div>

		<h3>Kниги на {{ $author->name }}</h3>    
    	@foreach($books as $book)	
		<div class="col-md-4">
			<div class="empty-space-large"></div>
			<a href="{{ route('books.show', $book->id) }}"><img src="{{$book->photo_path}}" class="small-image"></a>		
			<a class="white" href="{{ route('books.show', $book->id) }}"><strong>{{$book->book_name}}</strong></a>	
		</div>	
		@endforeach	
	</div>
</div>

@endsection

