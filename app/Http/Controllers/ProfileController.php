<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Auth;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::get();

        if(Auth::User()){
            $user_id = Auth::user()->id;
            $books = User::find($user_id);            
            return view('profile.index', ['books' => $books->books]);
        }else{
            return view('layouts.home');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function addBook(Request $request)
    {
        
        $user_id = Auth::user()->id;
        
        DB::table('book_user')->insert(
        [
            'user_id' => $user_id,
            'book_id' => $request->book_id
        ]);
    	return back();
    }

    public function removeBook(Request $request)
    {

        $user_id = Auth::user()->id;
        
        DB::table('book_user')->where('book_id', '=', $request->book_id)->delete();
        return redirect('profile');
    }

    public function readedPages(Request $request)
    {        
        
        DB::table('book_user')->where('id', '=', $request->pivot_id)->update(
        [
            'pages_read' => $request->pages_read   
        ]);
        return redirect('profile');
    }
}
