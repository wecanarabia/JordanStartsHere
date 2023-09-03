<?php

namespace App\Http\Controllers\Admin;

use App\Models\Ad;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\AdRequest;

class AdController extends Controller
{
    public function show()
    {
        $ad = Ad::first();
        return view('admin.ads.show',compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $ad = Ad::first();
        return view('admin.ads.edit',compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdRequest $request)
    {
        $ad = Ad::first();
        if ($request->has('image')&&$ad->image  && File::exists($ad->image)) {
            unlink($ad->image);
        }
        $ad->update($request->all());


        return redirect()->route('admin.ads.show')
                        ->with('success','Ad has been updated successfully');
    }

}
