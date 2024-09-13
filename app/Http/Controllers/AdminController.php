<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Permission;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index() : View
    {
        return view('admin.dashboard');
    }

    public function permissions() : View
    {
        $permissions = Permission::where('status','process')->orderByDesc('created_at')->get();
        return view('admin.permissions.index',compact('permissions'));
    }
    public function permissionLastHandle() : View
    {
        $permissions =  Permission::whereNot('status','process')->orderByDesc('expired_date')->get();
        return view('admin.permissions.index2',compact('permissions'));
    }

    public function handlePermissions(Request $request, $id) : RedirectResponse
    {
        $validator = $request->validate([
            'action' => 'required',
            'note' => 'string|nullable',
        ]);

        $permission = Permission::findOrFail($id);
        $book = Books::findOrFail($permission->book_id);
        $librarian = Auth::user();
        $action = $validator['action'];
        $expiredPermit =  now()->addDays($book->read_duration);
            // Check if the user has the 'librarian' role
        if ($librarian->role !== 'librarian') {
            return redirect()->back()->with('error', 'Your role does not support this action.');
        }

        try {
            if($action == 'accept'){
                $permission->status = $action;
                $permission->librarian_id = $librarian->id;
                $permission->expired_date = $expiredPermit;
                $permission->save();
            } else {
                $permission->status = $action;
                $permission->note = $request->note;
                $permission->librarian_id = $librarian->id;
                $permission->expired_date = $expiredPermit;
                $permission->save();
            }
            return redirect()->back()->with('success')->with('permit has been handled :D');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'handle permit failed = '. $e);
        }
    }
}
