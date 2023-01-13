<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BooksController extends Controller
{
    //
    public function index()
    {
        $books = Book::where('library_id', request()->library_id)->get();
        return response()->json(['data' => $books], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'ISBN' => 'required|max:255',
        ]);
        $validatedData['library_id'] = request()->library_id;
        $book = Book::create($validatedData);
        return response()->json(['data' => $book], 201);
    }

    public function show($id)
    {
        $book = Book::where('library_id', request()->library_id)->find($id);
        if (!$book) {
            return response()->json(['error' => 'This book does not belong to this library'], 401);
        }
        return response()->json(['data' => $book], 200);
    }

    public function update(Request $request, $id)
    {
        $book = Book::where('library_id', request()->library_id)->find($id);
        if (!$book) {
            return response()->json(['error' => 'This book does not belong to this library'], 401);
        }
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:255',
            'ISBN' => 'required|max:255',
        ]);
        $book->update($validatedData);
        return response()->json(['data' => $book], 200);
    }

    public function destroy($id)
    {
        $book = Book::where('library_id', request()->library_id)->find($id);
        if (!$book) {
            return response()->json(['error' => 'This book does not belong to this library'], 401);
        }
        $book->delete();
        return response()->json(['message' => 'Successfully deleted'], 200);
    }

}