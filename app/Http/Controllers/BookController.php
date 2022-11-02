<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    
    public function index()
    {
        return Book::all();
        //cu8ando se tiene cientos de registos se usan Book::paginate()
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>['required']
        ]);
        $book = new Book;
        $book->title = $request->input('title');
        $book->save();

        return $book;
    }

    public function show(Book $book)
    {
        //sino se agrega el Book solo retorna el la varible enviada por la url
        // return Book::find($book);//esta seria la forma sin usar el Book como parametro en el show
        return $book;
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'=>['required']
        ]);
       
        $book->title = $request->input('title');
        $book->save();

        return $book;
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}
