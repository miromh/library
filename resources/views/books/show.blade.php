@extends('layouts.app')

@section('content')

<div class="container">
		
	<div class="col-md-8 col-md-offset-2 content" id="single-book-container">
		@if($role == 'admin')
          <a href="{{ route('books.edit', $book->id) }}"><button class="btn btn-primary">EDIT</button></a>
        @endif 
		<h2 id="book-name">{{ $book->book_name }}</h2>
		<p><img  class="img-fluid book-cover" src="{{URL::to('/') . '/' .  $book->photo_path }}"></p>
		{!! $book->excerption !!}
		<h3> Author:  {{$book->author->name}}</h3>
		<form action="/addBook" method="post" accept-charset="utf-8" class="col-md-12">
	      {{ csrf_field() }}
	        <input type="text" name="book_id" value="{{ $book->id }}" hidden>
	        @if($my_books->contains('book_id', $book->id))
	        Добавено в любими
	        @else
	         <button type="submit" class="btn btn-warning" name="submit"
	        @if($my_books->contains('book_id', $book->id))
	        disabled
	        @endif
	        ><i class="fa fa-heart" aria-hidden="true"> 
	        Добави в любими
	        </i>
	        </button>
	        @endif
    	</form>
    	<div class="empty-space-large"></div>
		<a href="{{$book->file_path }}" download><button type="button" class="btn btn-default col-md-6 col-md-offset-3">Download</button></a>
			
	</div>	
</div>

@endsection