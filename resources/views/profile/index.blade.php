@extends('layouts.app')

@section('content')


@if(!$books->isEmpty())
<div class="container" >
  <div class="col-md-10 col-md-offset-1 content" id="books">
		<table class="table">
			<thead>
				<tr>
					<th>
						<h3>Книга</h3>
					</th>
					<th>
						<h3>Автор</h3>
					</th>
					<th>
						<h3>Бр. страници</h3>
					</th>
					<th>
						<h3>Прочетени страници</h3>
					</th>
				</tr>
			</thead>
			<tbody>
				@foreach($books as $book)
				<tr>
					<td>
						<a href="{{ URL::to('/books') . '/' . $book->id }}" title=""><h4>{{ $book->book_name }}</h4></a>
					</td>
					<td>
						<h4>{{ $book->author->name }}</h4>
					</td>
					<td>
						<h4>{{ $book->total_pages }}</h4>
					</td>
					<td>
						<div class="form-group">
							<form action="/readedPages" method="post">
								{{ csrf_field() }}
								<input type="text" name="pivot_id" value="{{ $book->pivot->id }}" hidden>
								<div class="col col-md-6">
									<input type="number" name="pages_read" class="form-control" value="{{ $book->pivot->pages_read }}" min='0' max='{{ $book->total_pages }}'>
								</div>
									<button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-save" aria-hidden="true"></i>
			          				</button>
							</form>
						</div>	
					</td>
					<td>
						<form action="/removeBook" method="post" accept-charset="utf-8">
				          {{ csrf_field() }}
				          <input type="text" name="book_id" value="{{ $book->id }}" hidden>
				          <input type="submit" class="btn btn-danger" name="submit" value="Remove">
				        </form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

@else 
No records
@endif




@endsection