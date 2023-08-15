<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Offer;
use App\Models\ProfileImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::get();
        return view('admin.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $profiles = ProfileImage::all();
        return view('admin.users.create',compact('profiles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request['password']=bcrypt($request->password);
        User::create($request->all());


        return redirect()->route('admin.users.index')
                        ->with('success','User has been added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(['profile','reviews'])->findOrFail($id);
        return view('admin.users.show',compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        $profiles = ProfileImage::all();
        return view('admin.users.edit',compact('user','profiles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::findOrFail($id);
        if ($request->password != null) {
            $request['password']=bcrypt($request->password);
        }else{
            unset($request['password']);
        }
        $user->update($request->all());


        return redirect()->route('admin.users.index')
                        ->with('success','User has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        User::findOrFail($request->id)->delete();
        return redirect()->route('admin.users.index')->with('success','User has been removed successfully');
    }
}
