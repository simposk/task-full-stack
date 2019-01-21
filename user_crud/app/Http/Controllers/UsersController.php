<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Auth;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == "admin" || Auth::user()->role == "developer") {
            $users = User::orderBy('id', 'desc')->paginate(8);
            return view('users.index', compact('users'));
        }

        return redirect(route('posts.index'));
    }

    public function create()
    {
        if (Auth::user()->role == "admin")
        {
            $roles = Role::get();
            return view('users.create', compact('roles'));
        }

        return redirect(route('posts.index'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role == "admin")
        {
            $this->validate($request, [
                'name' => 'required',
                'email'  => 'required|unique:users|max:30',
                'password' => 'required|confirmed',
                'role' => 'required'
            ]);

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return redirect()->route('users.index');
        }

        return redirect(route('posts.index'));
    }

    public function edit($id)
    {
        if (Auth::user()->role == "admin")
        {
            $user = User::find($id);
            return view('users.edit', compact('user'));
        }

        return redirect(route('posts.index'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role == "admin") {
            $this->validate($request, [
                'name' => 'required|max:20',
                'email' => 'required|max:30',
                'role' => 'required',
            ]);

            $user = User::find($id);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();

            //        Session::flash('success', 'Your post was successfully updated.');
            return redirect()->route('users.index');
        }
    }

    public function upload(Request $request)
    {
        return "Success";
//        $item = (string)$request;
//        $x = $item->split('\n');
//        return $x;
//        return response()->json($response);
//        return $request->all();
//        return $request->data;
    }

    public function destroy($id)
    {
        if (Auth::user()->role == "admin") {
            $user = User::find($id);
            $user->delete();

//          Session::flash('success', 'Your post was successfully deleted.');
            return redirect()->route('users.index');
        }
    }
}
