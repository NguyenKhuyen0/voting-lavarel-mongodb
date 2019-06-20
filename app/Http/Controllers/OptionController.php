<?php

namespace App\Http\Controllers;

use App\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $options= Option::all();
        return view('option.index',compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('option.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $extra_images = [];
        $image = '';
        request()->validate([
 
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
            'extra_images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
 
        ]);
 
        
        if($request->hasfile('extra_images'))
        {

            foreach($request->file('extra_images') as $img)
            {
                $name=$img->getClientOriginalName();
                $img->move(public_path().'/images/', $name);  
                $extra_images[] = $name;  
            }

        }

        if($request->hasfile('image'))
        {
            $img = $request->file('image');
            $name = $img->getClientOriginalName();
            $img->move(public_path().'/images/', $name);  
            $image = $name;  
        }
     

        $option= new Option();
        $option->image = $image;
        $option->extra_images =  $extra_images;
        $option->content = $request->get('content');
        $option->votes = $request->get('votes');       
        $option->save();

        return redirect('option.index')->with('success', 'Option has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $option = Option::find($id);
        return view('option.single',compact('option','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $option = Option::find($id);
        return view('option.edit',compact('option','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $option= Option::find($id);
        $option->image = $request->get('image');
        $option->extra_images = $request->get('extra_images');
        $option->content = $request->get('content');
        $option->votes = $request->get('votes');       
        $option->save();

        return redirect('option.single')->with('success', 'Option has been successfully update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Option  $option
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $option = Option::find($id);
        $option->delete();
        return redirect('option.index')->with('success','option has been  deleted');
    }
}
