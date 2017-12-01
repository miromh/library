<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Requests\SubmitBook;
use App\Http\Requests\UpdateBook;
use App\Http\Requests\DeleteBook;
use Auth;
use App\Book;
use App\User;
use App\Admin;
use App\Author;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $my_id      = Auth::User()->id;
        $my_books   = DB::table('book_user')->where('user_id', '=', $my_id)->get();
        $user_role  = Auth::User()->role;
        return view('books.index', ['books' => Book::with('author')->orderBy('id', 'desc')->paginate(6), 'my_id' => $my_id,'my_books' => $my_books, 'role' => $user_role]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create', ['authors' => Author::get()]);      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubmitBook $request)
    {

        $book = new Book;
        
        if ($request->hasFile('book_cover')) {            
            $cover_image_filename   = $request->file('book_cover')->getClientOriginalName();
            $cover_image_filename   = uniqid('img_');
            $request->file('book_cover')->move('img/book-covers/', $cover_image_filename);
            $book->photo_path       = '/img/book-covers/' . $cover_image_filename;
        }

        
        $book_filename = $request->file('book_file')->getClientOriginalName();
        $request->file('book_file')->move('pdf/', $book_filename);
        $book->file_path    = '/pdf/' . $book_filename;   
        $book->book_name    = $request->book_name;
        $book->excerption   = $request->excerption;
        $book->author_id    = $request->author_id;
        $book->total_pages  = $request->total_pages;
        $book->save();

        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $my_id      = Auth::User()->id;
        $my_books   = DB::table('book_user')->where('user_id', '=', $my_id)->get();
        $user_role  = Auth::User()->role;

        $book = Book::where('id', '=', $id)->first();        
        return view('books.show', ['book' => $book, 'my_books' => $my_books, 'my_id' => $my_id,'role' => $user_role ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
            $authors = Author::get();
            return view('books.edit', ['book' => Book::with('author')->get()->where('id', '=', $id)->first(), 'authors' => $authors]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBook $request, $id)
    {
        $book = Book::find($id);

        if ($request->hasFile('book_cover')) {            
            $cover_image_filename   = $request->file('book_cover')->getClientOriginalName();            
            $cover_image_filename   = uniqid('img_');
            $request->file('book_cover')->move('img/book-covers/', $cover_image_filename);
            $book->photo_path       = '/img/book-covers/' . $cover_image_filename;
        }

        if ($request->hasFile('book_file')) {
            $book_filename = $request->file('book_file')->getClientOriginalName();
            $request->file('book_file')->move('pdf/', $book_filename);
            $book->file_path    = '/pdf/' . $book_filename;       
        }
        
        $book->book_name    = $request->book_name;
        $book->excerption   = $request->excerption;
        $book->author_id    = $request->author_id;
        $book->total_pages  = $request->total_pages;
        $book->save();
        
        return redirect()->route('books.show', $id);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteBook $request)
    {
        DB::table('book_user')->where('book_id', '=', $request->id)->delete();
        Book::where('id', '=', $request->id)->delete();
        return redirect()->route('books.index');
    }

    public function search(Request $request)
    {        
        $search     = '%' . $request->search . '%';        
        $my_id      = Auth::User()->id;
        $my_books   = DB::table('book_user')->where('user_id', '=', $my_id)->get();
        $user_role  = Auth::User()->role;
        $books      = Book::where('book_name', 'LIKE', $search)->with('author')->paginate(6);
        
        return view('books.index', ['books' => $books, 'my_id' => $my_id,'my_books' => $my_books, 'role' => $user_role]);
    }
}
