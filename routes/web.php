<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookIssuedsController;
use App\Http\Controllers\IssueBooksController;
use App\Http\Controllers\BooksController;

Route::get('/', function () {
    return view('welcome');
});

// Unauthenticated group
Route::group(array('before' => 'guest'), function () {

    // CSRF protection
    Route::group(array('before' => 'csrf'), function () {

        // Create an account (POST)
        Route::post('/create', array(
            'as' => 'account-create-post',
            'uses' => 'AccountController@postCreate'
        ));

        // Sign in (POST)
        Route::post('/sign-in', array(
            'as' => 'account-sign-in-post',
            'uses' => 'AccountController@postSignIn'
        ));

        // Sign in (POST)
        Route::post('/student-registration', array(
            'as' => 'student-registration-post',
            'uses' => 'StudentController@postRegistration'
        ));

    });

    // Sign in (GET)
    Route::get('/', array(
        'as' => 'account-sign-in',
        'uses' => 'AccountController@getSignIn'
    ));

    // Create an account (GET)
    Route::get('/create', array(
        'as' => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));

    // Student Registeration form
    Route::get('/student-registration', array(
        'as' => 'student-registration',
        'uses' => 'StudentController@getRegistration'
    ));

    // Render search books panel
    Route::get('/book', array(
        'as' => 'search-book',
        'uses' => 'BooksController@searchBook'
    ));

});

// Main books Controlller left public so that it could be used without logging in too
Route::resource('/books', 'BooksController');

// Authenticated group
// Route::group(array('before' => 'auth'), function() {
Route::group(['middleware' => ['auth']], function () {

    // Home Page of Control Panel
    Route::get('/home', array(
        'as' => 'home',
        'uses' => 'HomeController@home'
    ));

    // Render Add Books panel
    Route::get('/add-books', array(
        'as' => 'add-books',
        'uses' => 'BooksController@renderAddBooks'
    ));

    Route::get('/add-book-category', array(
        'as' => 'add-book-category',
        'uses' => 'BooksController@renderAddBookCategory'
    ));

    Route::post('/bookcategory', 'BooksController@BookCategoryStore')->name('bookcategory.store');


    // Render All Books panel
    Route::get('/all-books', array(
        'as' => 'all-books',
        'uses' => 'BooksController@renderAllBooks'
    ));

    Route::get('/bookBycategory/{cat_id}', array(
        'as' => 'bookBycategory',
        'uses' => 'BooksController@BookByCategory'
    ));

    // Students
    Route::get('/registered-students', array(
        'as' => 'registered-students',
        'uses' => 'StudentController@renderStudents'
    ));

    // Render students approval panel
    Route::get('/students-for-approval', array(
        'as' => 'students-for-approval',
        'uses' => 'StudentController@renderApprovalStudents'
    ));
    Route::get('student/{id}/approve', 'StudentController@approve')->name('students.approve');
    Route::get('student/{id}/reject', 'StudentController@reject')->name('students.reject');

    // Render students approval panel
    Route::get('/settings', array(
        'as' => 'settings',
        'uses' => 'StudentController@Setting'
    ));

    // Render students approval panel
    Route::post('/setting', array(
        'as' => 'settings.store',
        'uses' => 'StudentController@StoreSetting'
    ));

    // Main students Controlller resource
    Route::resource('/student', 'StudentController');

    Route::post('/studentByattribute', array(
        'as' => 'studentByattribute',
        'uses' => 'StudentController@StudentByAttribute'
    ));

    // Issue Logs
    Route::get('/issue-return', array(
        'as' => 'issue-return',
        'uses' => 'LogController@renderIssueReturn'
    ));

    // Render logs panel
    Route::get('/currently-issued', array(
        'as' => 'currently-issued',
        'uses' => 'LogController@renderLogs'
    ));

    // Main Logs Controlller resource
    Route::resource('/issue-log', 'LogController');

    // Sign out (GET)
    Route::get('/sign-out', array(
        'as' => 'account-sign-out',
        'uses' => 'AccountController@getSignOut'
    ));

});

Route::group(['prefix' => 'issue_books'], function () {

    Route::get('/', 'IssueBooksController@index')->name('issue_books.issue_book.index');
    Route::get('/create', 'IssueBooksController@create')->name('issue_books.issue_book.create');
    Route::get('/show/{issueBook}', 'IssueBooksController@show')->name('issue_books.issue_book.show')->where('id', '[0-9]+');
    Route::get('/{issueBook}/edit', 'IssueBooksController@edit')->name('issue_books.issue_book.edit')->where('id', '[0-9]+');
    Route::post('/', 'IssueBooksController@store')->name('issue_books.issue_book.store');
    Route::get('/return_book', 'IssueBooksController@renderIssueReturn')->name('issue_books.issue_book.renderIssueReturn');
    Route::get('/return/{student_id}', 'IssueBooksController@check_books')->name('issue_books.issue_book.check_books');
    Route::post('/return_book', 'IssueBooksController@return_book')->name('issue_books.issue_book.return_book');
    Route::put('issue_book/{issueBook}', 'IssueBooksController@update')->name('issue_books.issue_book.update')->where('id', '[0-9]+');
    Route::delete('/issue_book/{issueBook}', 'IssueBooksController@destroy')->name('issue_books.issue_book.destroy')->where('id', '[0-9]+');

});

Route::group(['prefix' => 'books'], function () {
    Route::get('/', 'BooksController@index')->name('books.books.index');
    Route::get('/create','BooksController@create')->name('books.books.create');
    Route::get('/show/{books}','BooksController@show')->name('books.books.show');
    Route::get('/{books}/edit','BooksController@edit')->name('books.books.edit');
    Route::post('/', 'BooksController@store')->name('books.books.store');
    Route::put('books/{books}', 'BooksController@update')->name('books.books.update');
    Route::delete('/books/{books}','BooksController@destroy')->name('books.books.destroy');
});
