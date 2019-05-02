<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Share;

class ShareController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$shares = Share::all();
        $shares = Share::paginate(1);
        return view('shares.index', compact('shares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shares.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'share_name'=>'required',
        'share_price'=> 'required|integer',
        'share_qty' => 'required|integer',
        'share_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $share_image = time().'.'.request()->share_image->getClientOriginalExtension();
        request()->share_image->move(public_path('images'), $share_image);

        $share = new Share([
            'share_name' => $request->get('share_name'),
            'share_price' => $request->get('share_price'),
            'share_qty' => $request->get('share_qty'),
            'share_image' => $share_image
        ]);
        $share->save();
        return redirect('/shares')->with('success', 'Stock has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $share = Share::find($id);
        return view('shares.show', compact('share'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $share = Share::find($id);
        return view('shares.edit', compact('share'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
        'share_name'=>'required',
        'share_price'=> 'required|integer',
        'share_qty' => 'required|integer',
        'share_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $share_image = time().'.'.request()->share_image->getClientOriginalExtension();
        request()->share_image->move(public_path('images'), $share_image);

        $share = Share::find($id);
        $share->share_name = $request->get('share_name');
        $share->share_price = $request->get('share_price');
        $share->share_qty = $request->get('share_qty');
        $share->share_image = $share_image;
        $share->save();
        return redirect('/shares')->with('success', 'Stock has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $share = Share::find($id);
        $share->delete();
        return redirect('/shares')->with('success', 'Stock has been deleted Successfully');
    }
}
