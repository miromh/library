<?php

Route::group(array('middleware' => ['auth', 'admin']), function ()
  {
     Route::resource('/admin', 'AdminController');
     Route::resource('/author', 'AuthorController');
     Route::resource('/books', 'BookController');
     Route::resource('/profile', 'ProfileController');
  });


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::group(array('middleware' => ['auth']), function ()
  {
      Route::get('/profile', 'ProfileController@index');
      Route::get('/books', 'BookController@index')->name('books.index');
      Route::get('/books/{book}', 'BookController@show')->name('books.show');
      Route::get('/author/{author}', 'AuthorController@show');
      Route::post('/addBook', 'ProfileController@addBook')->name('addBook');
      Route::post('/removeBook', 'ProfileController@removeBook')->name('removeBook');
      Route::post('/readedPages', 'ProfileController@readedPages')->name('readedPages');
      Route::get('/search', 'BookController@search');
  });