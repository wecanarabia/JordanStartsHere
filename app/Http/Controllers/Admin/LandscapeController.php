<?php

namespace App\Http\Controllers\Admin;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Models\LandscapeImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\PortraitRequest;

class LandscapeController extends Controller
{
             /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = LandscapeImage::latest()->with('partner')->orderBy('partner_id')->get();
        return view('admin.landscapes.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $partners = Partner::all();
        return view('admin.landscapes.create',compact('partners'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PortraitRequest $request)
    {
        foreach($request->images as $image) {
                if (LandscapeImage::where('partner_id',$request->partner_id)->count()==0) {
                    $order = 1;
                }else{
                    $order = LandscapeImage::where('partner_id',$request->partner_id)->max('order')+1;
                }
                LandscapeImage::create([
                    'image'=>$image,
                    'order'=>$order,
                    'partner_id'=>$request->partner_id,
                ]);
        }
        return redirect()->route('admin.landscapes.index')
                        ->with('success','Landscape Images has been added successfully');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $partners = Partner::all();
        $image = LandscapeImage::with('partner')->findOrFail($id);
        return view('admin.landscapes.edit',compact('image','partners'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PortraitRequest $request, string $id)
    {
        $image = LandscapeImage::findOrFail($id);

        if ($request->has('image')&&$image->image  && File::exists($image->image)) {
            unlink($image->image);
        }
        $image->update($request->all());


        return redirect()->route('admin.landscapes.index')
                        ->with('success','Landscape Image has been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        LandscapeImage::findOrFail($request->id)->delete();
        return redirect()->route('admin.landscapes.index')->with('success','Landscape Image has been removed successfully');
    }
}
