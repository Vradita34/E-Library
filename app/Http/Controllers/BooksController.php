<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::latest()->paginate(10);
        return view('admin.books.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Categories::latest()->get();
        return view('admin.books.add_book',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'category_id' => 'required',
            'synopsis' => 'required|string',
            'read_duration' => 'required|integer|min:1|max:200',
            'cover' => 'nullable|image|mimes:png,jpg,jpeg|max:3124',
            'file' => 'required|file|mimes:pdf,txt,word',
            'release_date' => 'required',
        ]);

        if($request->file('cover')){
            $cover = $request->file('cover')->store('covers','public');
            $file = $request->file('file')->store('files','public');
            Books::create([
                'title' => $data['title'],
                'author' =>  $data['author'],
                'publisher' =>  $data['publisher'],
                'category_id' =>  $data['category_id'],
                'synopsis' =>  $data['synopsis'],
                'read_duration' =>  $data['read_duration'],
                'release_date' =>  $data['release_date'],
                'cover' => $cover,
                'file' => $file,
            ]);
            return redirect()->route('books.index')->with('success','Create Books succesfully');
        }else{
            $file = $request->file('file')->store('files','public');
            Books::create([
                'title' => $data['title'],
                'author' =>  $data['author'],
                'publisher' =>  $data['publisher'],
                'category_id' =>  $data['category_id'],
                'synopsis' =>  $data['synopsis'],
                'read_duration' =>  $data['read_duration'],
                'release_date' =>  $data['release_date'],
                'file' => $file,
            ]);
            return redirect()->route('books.index')->with('success','Create Books succesfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $books)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Categories::latest()->get();
        $book = Books::findOrFail($id);
        return view('admin.books.edit_book',compact('book','category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'author' => 'required|string',
            'publisher' => 'required|string',
            'category_id' => 'required',
            'synopsis' => 'required|string',
            'read_duration' => 'required|integer|min:1|max:200',
            'cover' => 'nullable|image|mimes:png,jpg,jpeg|max:3124',
            'file' => 'nullable|file|mimes:pdf,txt,word',
            'release_date' => 'required',
        ]);

        $books = Books::find($id);
        try {
            if($request->hasFile('cover')){
                if($books->cover){
                    Storage::disk('public')->delete($books->cover);
                }
                $cover = $request->file('cover')->store('covers','public');
                $books->cover = $cover;
            }
            if($request->hasFile('file')){
                if($books->file){
                    Storage::disk('public')->delete($books->file);
                }
                $file = $request->file('file')->store('files','public');
                $books->file = $file;
            }
            $books->title = $data['title'];
            $books->author =  $data['author'];
            $books->publisher =  $data['publisher'];
            $books->category_id = $data['category_id'];
            $books->synopsis = $data['synopsis'];
            $books->read_duration = $data['read_duration'];
            $books->release_date = $data['release_date'];
            $books->save();
            return redirect()->route('books.index')->with('success','update success');
        } catch (Exception $e) {
            return redirect()->back()->with('error',$e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $books = Books::find($id);
        // dd($books);
        if($books->cover != null){
            unlink(public_path('storage/'.$books->cover));
        }
        $books->delete();
        return  redirect()->route('books.index')->with('success','delete books successfully');
    }
}
