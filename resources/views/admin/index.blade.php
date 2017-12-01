@extends('layouts.app')

@section('content')

<body class="admin">
<div class="container-fluid">
	<div class="row content">
		<div class="col-md-4">
      <h1>Users</h1>
			<table class="table">
  <thead>
    <tr>  
      <th scope="col">ID</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
    <tr>
      <th scope="row">{{ $user->id }}</th>
      <td>{{ $user->name }}</td>
      <td>{{ $user->email }}</td>
      <td>{{$user->role}}</td>
      <td><a href="{{ route('admin.edit', $user->id) }}"><button class="btn btn-primary">Edit</button></td>
    </tr>
    @endforeach
  </tbody>
</table>
		</div>

  <div class="col-md-4">
      <h1>Books</h1>
      <table class="table">
          <thead>
              <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Book Name</th>
                  <th scope="col">Pages</th>
              </tr>
          </thead>
          <tbody>
              @foreach($books as $book)
              <tr>
                  <th scope="row">{{$book->id}}</th>
                  <td><a href="/books/{{$book->id}}">{{$book->book_name}}</a>
                  </td>
                  <td>{{$book->total_pages}}</td>
                  <td>
                      <a href="{{ route('books.edit', $book->id) }}">
                      <button class="btn btn-primary">Edit</button>
                  </td>
              </tr>
              @endforeach
          </tbody>
      </table>
  </div>

  <div class="col-md-4">
    <h1>Authors</h1>
  <table class="table">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Author</th>                  
        </tr>
      </thead>
      <tbody>
        @foreach($authors as $author)
        <tr>
            <th scope="row">{{$author->id}}</th>
            <td>{{$author->name}}</td>
            <td>
              <a href="{{ route('author.edit', $author->id) }}">
              <button class="btn btn-primary">Edit</button>
            </td>
        </tr>
        @endforeach
      </tbody>    
  </table>

  </div>

</div>
</body>



@endsection