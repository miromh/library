@extends('layouts.app')

@section('content')

<div class="container" >
    <div class="row">
        <div class="col-md-6 col-sm-offset-3 content">
            <div id="imaginary_container"> 
              <form method="get" action="{{ action('BookController@search') }}">              
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control" name="search" placeholder="Search">
                    <span class="input-group-addon">
                        <button type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>  
                    </span>
                </div>
              </form>
            </div>
        </div>
    </div>
  <div class="empty-space"></div>

  <div class="col-md-8 col-md-offset-2" >
      @foreach($books as $book)
        <div class="row book-row">          
          <div class="form-group">            
            <div class="col col-md-4">
              <a href="{{ route('books.show', $book->id) }}"><img class="book-cover-thumb" src="{{URL::to('/') . $book->photo_path}}"></a>
                <h5 class="col-md-12">Автор: <a class="white" href="{{ URL::to('/author') . '/' . $book->author->id }}">{{$book->author->name}}</a></h5>
                <form action="/addBook" method="post" accept-charset="utf-8" class="col-md-12">
                  {{ csrf_field() }}
                    <input type="text" name="book_id" value="{{ $book->id }}" hidden>
                    
                    @if($my_books->contains('book_id', $book->id))
                    Добавено в любими
                    @else
                     <button type="submit" class="btn btn-warning col-md-12" name="submit"><i class="fa fa-plus" aria-hidden="true"> 
                    Добави в любими
                    </i>
                    </button>
                    @endif

                    <a href="{{$book->file_path }}" download><button type="button" class="btn btn-success col-md-12">Download</button></a>
                </form>
                
                             
            </div>
            <div class="col col-md-8">
             <a class="white" href="{{ route('books.show', $book->id) }}"><h2>{{$book->book_name}}
              @if($role == 'admin') 
              <a class="edit" href="{{ route('books.edit', $book->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
              @endif 

             </h2></a>

             
              <p>{!! str_limit($book->excerption, 450) !!}</p>
            </div>

          </div>            
        </div>  
        <div class="empty-space"></div> 
      @endforeach
      <div class="col col-md-4 col-md-offset-4" id="pagination">
        {{ $books->links()}}  
      </div>
  </div>
</div>


@endsection