<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Offer;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::with('subscription')->paginate(10);

        foreach ($data as $user) {
            if (!empty($user->vouchers)) {
                $total=0;
                foreach($user->vouchers as $voucher){
                    $total+=$voucher->offer->discount_value;
                }
                $user['saving']=$total;
            }else{
                $user['saving']=0;
            }

        }
        return view('admin.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
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
        $user = User::with(['subscriptions','subscription','enterprise_copnes'])->findOrFail($id);
        if (!empty($user->vouchers)) {
            $total=0;
            foreach($user->vouchers as $voucher){
                $total+=$voucher->offer->discount_value;
            }
            $user['saving']=$total;
        }
        return view('admin.users.show',compact('user'));
    }

    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit',compact('user'));
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
