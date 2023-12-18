<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users =  DB::table('users')
        ->when($request->input('search'), function($query, $search){
            $query->where('name', 'like','%'. $search . '%')
                  ->orWhere('email', 'like','%'. $search . '%')
                  ->orWhere('phone', 'like','%'. $search . '%');
        })
        ->orderBy('id','desc')
        ->paginate(10);
        return view('pages.user.index', compact('users'));
    }



    public function create()
    {
        return view('pages.user.create');
    }

    public function store(StoreUserRequest $request)
    {

        // dd($request->all());

        $data = $request->all();
        $data['password']=Hash::make($request->password);
        \App\Models\User::create($data);
        return redirect()->route('user.index')->with('success','User successfully created');
    }



    public function show(User $user)
    {
        //
    }

    public function edit($id)
    {
        $user = \App\Models\User::findOrFail($id);
        return view('pages.user.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        // dd($request->validated());

        $data = $request->validated();
        $user->update($data);
        return redirect()->route('user.index')->with('success', 'User successfully update');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User successfully deleted');
    }
}
