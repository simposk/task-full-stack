<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Auth;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->role == "admin" || Auth::user()->role == "developer")
        {
            $roles = Role::orderBy('id', 'asc')->paginate(8);
            return view('roles.index', compact('roles'));
        }

        return redirect(route('posts.index'));
    }

    public function create()
    {
        if (Auth::user()->role == "admin" || Auth::user()->role == "developer")
        {
            return view('roles.create');
        }

        return redirect(route('posts.index'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role == "admin" || Auth::user()->role == "developer")
        {
            $this->validate($request, [
                'name' => 'required',
            ]);

            $role = new Role($request->all());
            $role->save();

            return redirect()->route('roles.index');
        }
        return redirect(route('posts.index'));
    }

    public function edit($id)
    {
        if (Auth::user()->role == "admin" || Auth::user()->role == "developer")
        {
            $role = Role::find($id);
            return view('roles.edit', compact('role'));
        }

        return redirect(route('posts.index'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role == "admin" || Auth::user()->role == "developer")
        {

            $this->validate($request, [
                'name' => 'required|max:20',
            ]);

            $role = Role::find($id);

            $role->name = $request->name;
            $role->save();
//        Session::flash('success', 'Your post was successfully updated.');
            return redirect()->route('roles.index');
        }

        return $this->unautohrized($request);
    }

    public function destroy($id)
    {
        if (Auth::user()->role == "admin" || Auth::user()->role == "developer")
        {
            $role = Role::find($id);
            $role->delete();
//        Session::flash('success', 'Your post was successfully deleted.');
            return redirect()->route('roles.index');
        }

        die('Unauthorized action');
    }
}
