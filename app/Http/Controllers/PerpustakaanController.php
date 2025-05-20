<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    public function index()
    {
        // 1.1 SELECT dasar

        // 1.2 WHERE clause

        // 1.6 JOIN

        // 1.7 SORTING dan PAGINATION

        // 1.8 AGGREGATE

        return view('perpustakaan');
    }

    public function insert(Request $request)
    {

    }

    // public function getBookById($id)
    // {
    //     $book = DB::table('books')->find($id);
    //     if (!$book) {
    //         return response()->json(['error' => 'Buku tidak ditemukan'], 404);
    //     }
    //     return response()->json($book);
    // }

    public function update(Request $request)
    {

    }

    public function delete(Request $request)
    {

    }
}
