<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Permission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\ElseIf_;

class ReaderController extends Controller
{
    public function index() : View
    {
        $books = Books::mostPopularBook()->get();
        return view('reader.home',compact('books'));
    }

    public function book_detail($id) : View
    {
        $isExpired = false;
        $book = Books::findOrFail($id);
        if(Auth::check()){
            $permission = Permission::where('book_id',$id)->where('user_id',Auth::user()->id)->orderByDesc('created_at')->first();
            if ($permission && $permission->expired_date && $permission->expired_date < now()) {
                $isExpired = true;
            }
        }else{
            $permission = null;
        }
        // dd($isExpired);
        return view('reader.book_detail',compact('book','permission','isExpired'));
    }

    public function send_request($id) : RedirectResponse
    {
        // dd(Auth::id());
        $existPermission = Permission::where('user_id',Auth::id())->where('book_id',$id)->where(function($query){
            $query->where('status',['process','approved'])->orWhere('expired_date','>',now());
        })->latest('created_at')->first();
        if($existPermission){
            if($existPermission->status == 'process'){
                return redirect()->back()->with('error','You request has been process');
            }elseif($existPermission->status == 'approved'){
                if($existPermission->expired_date > now()){
                    return redirect()->back()->with('error','You have already request ');
                }else{
                    return redirect()->back()->with('error','You request has been expired, make new request');
                }
            }
        }else{
            Permission::create([
                'user_id' => Auth::id(),
                'book_id' => $id,
            ]);
        }
        return redirect()->back()->with('success','request success');
    }

    public function read_book($id) : View
    {
        $permission = Permission::where('status','approved')->where('expired_date', '>=', now())->where('user_id',Auth::user()->id)->where('book_id',$id)->first();
        $idBook = $permission->book_id;
        $book = Books::findOrFail($idBook);
        return view('reader.pdf_viewer',compact('book'));
    }
}
