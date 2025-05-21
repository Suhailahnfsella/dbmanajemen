<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PerpustakaanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PerpustakaanController::class, 'index'])->name('index');
Route::post('/books/insert', [PerpustakaanController::class, 'insert'])->name('books.insert');
Route::post('/books/update', [PerpustakaanController::class, 'update'])->name('books.update');
Route::post('/books/delete', [PerpustakaanController::class, 'delete'])->name('books.delete');
Route::get('/books/{id}', [PerpustakaanController::class, 'getBookById'])->name('books.getById');
