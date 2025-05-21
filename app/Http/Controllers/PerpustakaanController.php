<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PerpustakaanController extends Controller
{
    public function index(Request $request)
    {
        // 1.1 SELECT dasar
        $books = DB::table('books')->get();
        $authors = DB::table('authors')->get();
        $firstBook = DB::table('books')->first();
        $firstTitle = DB::table('books')->value('title');
        $titlesOnly = DB::table('books')->pluck('title');

        // 1.2 WHERE clause
        $tersedia = DB::table('books')->where('status','tersedia')->get();
        $orWhere = DB::table('books')->where('status','tersedia')->orWhere('year', '>', 2005)->get();
        $between = DB::table('books')->whereBetween('year',[2000,2010])->get();

        // 1.6 JOIN
        $booksWithAuthor = DB::table('books')
        ->join('authors', 'books.author_id', '=', 'authors.id')
        ->select('books.title', 'authors.name as author')
        ->get();

        // 1.7 SORTING dan PAGINATION
        $sorted = DB::table('books')
        ->orderBy('year','desc')
        ->limit(5)
        ->offset(0)
        ->get();

        // 1.8 AGGREGATE
        $total = DB::table('books')->count();
        $sum = DB::table('books')->sum('year');
        $avg = DB::table('books')->avg('year');
        $max = DB::table('books')->max('year');
        $min = DB::table('books')->min('year');

        // 2.0 Read ORM
        $books = Books::with('author')->get();
        $author = Authors::all();

        // 2.1 create ORM
        $validated = $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|string'
        ]);

        Books::created($validated);

        // 2.2 read by id
        $book = Books::findOrFail($request);

        // 2.3 delete by id
        $book = Books::destroy($request);

        return view('perpustakaan',compact(
            'books',
            'firstBook',
            'firstTitle',
            'titlesOnly',
            'tersedia',
            'orWhere',
            'between',
            'booksWithAuthor',
            'sorted',
            'total',
            'sum',
            'avg',
            'max',
            'min',
            'authors'
        ));
    }

    // public function insert(Request $request)
    // {
    //     $request->validate([
    //         'title' => 'required|string',
    //         'author_id' => 'required|integer',
    //         'year' => 'required|integer',
    //         'status' => 'required|string'
    //     ]);

    //     DB::table('books')->insert([
    //         'title' => $request->title,
    //         'author_id' => $request->author_id,
    //         'year' => $request->year,
    //         'status' => $request->status
    //     ]);

    //     return redirect()->route('index')->with('success', 'mantab');
    // }

    public function insert(Request $request){
        $validated = $request->validate([
            'title' => 'required|string',
            'author_id' => 'required|integer',
            'year' => 'required|integer',
            'status' => 'required|string'
        ]);

        Books::created($validated);
        return redirect()->route('index')->with('success', 'mantab');
    }

    public function getBookById($id)
    {
        $book = DB::table('books')->find($id);
        if (!$book) {
            return response()->json(['error' => 'Buku tidak ditemukan'], 404);
        }
        return response()->json($book);
    }

    public function update(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id',
            'title_update' => 'required|string',
            'year_update' => 'required|integer',
            'status_update' => 'required|string'
        ]);

        DB::table('books')->where('id',$request->book_id)->update([
            'title' => $request->title_update,
            'year' => $request->year_update,
            'status' => $request->status_update
        ]);

        return redirect()->route('index')->with('success', 'mantab');
    }

    public function delete(Request $request)
    {
        $request->validate([
            'book_id' => 'required|integer|exists:books,id'
        ]);

        DB::table('books')->where('id',$request->book_id)->delete();

        return redirect()->route('index')->with('success', 'mantab');
    }
}
