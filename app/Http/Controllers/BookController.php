<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Genre;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('genre')->paginate(10);
        $genres = \App\Models\Genre::pluck('name', 'id');
        return view('books.index', compact('books', 'genres'));
    }

    public function create()
    {
        $genres = \App\Models\Genre::all();
        return view('books.create', compact('genres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'genre_id' => 'required|exists:genres,id',
        ]);

        \App\Models\Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Libro creado correctamente.');
    }

    public function edit(Book $book)
    {
        $genres = \App\Models\Genre::all();
        return view('books.edit', compact('book', 'genres'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $book->update($request->validated());
        return redirect()->route('books.index')->with('success', 'Libro actualizado correctamente.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
