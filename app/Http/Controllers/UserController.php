<?php

namespace App\Http\Controllers;

use App\Models\id;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userLog = Auth::user()->id;
        $users = User::whereNot('id',$userLog)->get();

        return view('admin.users.index',compact('users'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.add_user');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'address' => 'nullable|string',
            'role' => 'required|string',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:3124',
        ]);

        if($request->file('avatar')){
            $avatar = $request->file('avatar')->store('avatars','public');

            User::create([
                'username' => $data['username'],
                'name' =>  $data['name'],
                'email' =>  $data['email'],
                'password' => Hash::make($data['password']),
                'address' =>  $data['address'],
                'role' =>  $data['role'],
                'avatar' => $avatar,
            ]);
            return redirect()->route('users.index')->with('success','Create Account succesfully');
        }else{
            User::create([
                'username' => $data['username'],
                'name' =>  $data['name'],
                'email' =>  $data['email'],
                'password' => Hash::make($data['password']),
                'address' =>  $data['address'],
                'role' =>  $data['role'],
            ]);
            return redirect()->route('users.index')->with('success','Create Account succesfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit_user',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'username' => 'required|string',
            'name' => 'required|string',
            'role' => 'required|string',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image|mimes:png,jpg,jpeg|max:3124',
        ]);

        $user = User::findOrFail($id);

        try {
            if ($request->hasFile('avatar')) {
                // Jika ada file avatar baru
                if ($user->avatar) {
                    // Hapus avatar lama jika ada
                    Storage::disk('public')->delete($user->avatar);
                }
                // Simpan avatar baru
                $avatar = $request->file('avatar')->store('avatars', 'public');
                $user->avatar = $avatar;
            }

            $user->username = $data['username'];
            $user->name = $data['name'];
            $user->role = $data['role'];
            $user->address = $data['address'];
            $user->save();

            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if ($user->avatar) {
            // Hapus file avatar dari storage
            if (Storage::disk('public')->exists($user->avatar)) {
                Storage::disk('public')->delete($user->avatar);
            }
        }

        // Hapus user dari database
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
