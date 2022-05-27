<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Database\Schema\Blueprint;
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

 Route::get('/', function () {
     return view('welcome');
//     $myItem = \Config::get('database.connections');
//     echo '<pre>';
//  var_dump($myItem);
//  echo '</pre>';
 });

Route::get('/create_books_table', function(){

    if(!Schema::hasTable('books')){

    Schema::create('books', function(blueprint $table){
$table -> increments('id');
$table -> string('title');
$table -> integer('page_count');
$table -> text('description');
$table -> decimal('price', 4, 2);
$table -> timestamps();

});
}
});


Route::get('/update_books_table', function(){

  Schema::table('books', function(blueprint $table){
$table -> string('title', 250)->change();
});
});




Route::get('/book_create', function(){
    $book = new \App\Models\Book;
    $book -> title ="This is the title of my book";
    $book -> page_count = 230;
    $book -> price = 10.3;
    $book -> description = "This book is very amazing";

    $book->save();


    echo 'This '.$book->title.' has now been added with an id of '.$book->id;
});



Route::get('/book_get_all',function(){
    $book = new \App\Models\Book;
    return $book->all();

});


Route::get('/book_get_2',function(){
    $book = new \App\Models\Book;
    return $book->find(2);

});


Route::get('/book_get_where',function(){
    $book = new \App\Models\Book;
    return $book->where('page_count', '<', 1000)->first();

});


Route::get('/book_get_where_chained', function(){
$model = new \App\Models\Book;
return $model->where('page_count', '<', 1000) -> where('title', '=', 'animal farm')->get();
});


Route::get('/book_getting_where_more_complex', function(){
$results = \App\Models\Book::where(function($query){
$query->where('pages_count', '>', 120)->where('title', 'LIKE', '%Book%');
})->where(function($query){
    $query->orWhere()->orWhere();
})->get();

});
//Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');


//Route::get('/redirect', [homeController::class, 'redirect']);

//Route::get('/', [homeController::class, 'index']);