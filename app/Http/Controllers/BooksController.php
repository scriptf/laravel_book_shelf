<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Validator;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 更新 
    public function update(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'item_name' => 'required|min:3|max:255',
            'item_number' => 'required|min:1|max:3',
            'item_amount' => 'required|max:6',
            'published' => 'required',
        ]);
        // バリデーション: エラー
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        //データ更新
        $books = Book::find($request->id);
        $books->item_name   = $request->item_name;
        $books->item_number = $request->item_number;
        $books->item_amount = $request->item_amount;
        $books->published   = $request->published;
        $books->save();
        return redirect('/');
    }

    public function store(Request $request) 
    {
        $validator = Validator::make($request->all(), [
        'item_name' => 'required|min:3|max:255',
        'item_number' => 'required | min:1 | max:3',
        'item_amount' => 'required | max:6',
         'published'   => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect('/')
                ->withInput()
                ->withErrors($validator);
        }
        
        // Eloquent モデル
        $books = new Book;
        $books->item_name = $request->item_name;
        $books->item_number = '1';
        $books->item_amount = '1000';
        $books->published = '2017-03-07 00:00:00';
        $books->save();// 「/」 ルートにリダイレクト
        return redirect('/');
    } 

    public function index()
    {
        //$books = Book::orderBy('created_at', 'asc')->get();
        $books = Book::orderBy('created_at', 'asc')->paginate(3);
        return view('books', ['books' => $books]);
    }

    public function edit()
    {
        return view('booksedit', ['book' => $books]);
    }

    public function delete()
    {
        $book->delete();
        return redirect('/');
    }
    
}
