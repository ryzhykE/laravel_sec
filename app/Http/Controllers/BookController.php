<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Book;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{
    public function index() {
        
        $books = Book::paginate(10);
        return view('book/index',['books'=>$books]);
    }
    
    public function show($id) {
        
        $book = Book::find($id);
        return view('book/show',['book'=>$book]);
        
    } 
    
    public function create(){
        
        return view('book/create');
    }
    
    public function store(Request $request) {
        $rules = [
            'title' => 'required|alpha|min:3',
            'author' => 'required|alpha|min:3',
            'year' => 'required',
            'genre' => 'required|alpha|min:3',
            'user_id' => 'exists:users,id'
        ];

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return Redirect::to('books/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $book = new Book();
            $book->title = $request->title;
            $book->author = $request->author;
            $book->year = $request->year;
            $book->genre = $request->genre;
            $book-> user_id = $request->user_id;
            $book->save();

            Session::flash('message', 'Successfully added book ' . $book->title);
            return Redirect::to('books');
        }
    }
    
    public function edit($id) {
        
        $book = Book::find($id);
        return view('book/edit',['book'=>$book]);  
    }
    
     public function update(Request $request, $id) {
        
        $book = Book::find($id);
        if ($request['_action'] == 'remove') {
            $book->user_id = null;
            $book->save();
            Session::flash('message', 'Successfully return Book Id:' .$book->id);
            return back();  
        }
        if ($request['_action'] == 'edit') {
            $rules = [
            'title' => 'required|alpha|min:3',
            'author' => 'required|alpha|min:3',
            'year' => 'required',
            'genre' => 'required|alpha|min:3',
            'user_id' => 'exists:users,id',
            ];
            
            $validator = Validator::make($request->all(),$rules);
            if($validator->fails()){
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
            } else {
                $book->title = $request->title;
                $book->year = $request->year;
                $book->author = $request->author;
                $book->genre = $request->genre;
                $book->user_id = $request->user_id;
                $book->save();
                Session::flash('message', 'Successfully updated book');
                return Redirect::to('books/');
            }
        }
    }
    
    public function destroy($id){
        Book::find($id)->delete();
        Session::flash('message', 'Successfully deleted book with Id: '.$id);
        return Redirect::back();
    }
    
}
