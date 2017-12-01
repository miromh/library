<?php

namespace App\Http\Controllers;
use App\Http\Requests\AuthorCheck;
use Illuminate\Http\Request;
use App\Author;
use App\Book;


class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors = Author::get();
        return view('authors.index', ['authors' => $authors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('authors.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AuthorCheck $request)
    {       
        $author = new Author;

        if($request->hasFile('author_photo'))
        {
            $author_photo = $request->file('author_photo')->getClientOriginalName();
            $author_photo = uniqid('author_');
            $request->file('author_photo')->move('img/authors', $author_photo);    
            $author->photo_path     = '/img/authors/' . $author_photo;
        }

        $author->name           = $request->author_name;
        $author->bio            = $request->bio;        
        $author->save();

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
        $author = Author::get()->where('id', '=', $id)->first();
        $books_by_author = Book::get()->where('author_id', '=', $id);
        return view('authors.show', ['author' => $author, 'books' => $books_by_author]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
