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
        $image = '';
        $gallery = [];
        
        // $request->validate([
 
        //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        //     'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
 
        // ]);
 
        
        if($request->hasfile('gallery'))
        {
            foreach($request->file('gallery') as $img)
            {
                $name=$img->getClientOriginalName();
                $img->move(public_path().'/images/', $name);  
                $gallery []= $name;  
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
        $option->title = $request->get('title');
        $option->content = $request->get('content');
        $option->image = $image;
        $option->gallery =  $gallery;
        $option->votes = (int) $request->get('votes');  
        $option->active = (Boolean) $request->get('active');
        $option->save();

        return redirect('option')->with('success', 'Option has been successfully added');
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
        $image = '';
        $gallery = [];
        
        // $request->validate([
 
        //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        //     'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
 
        // ]);

        if($request->hasfile('gallery'))
        {
            foreach($request->file('gallery') as $img)
            {
                $name=$img->getClientOriginalName();
                $img->move(public_path().'/images/', $name);  
                $gallery []= $name;  
            }
        }
   

        if($request->hasfile('image'))
        {
            $img = $request->file('image');
            $name = $img->getClientOriginalName();
            $img->move(public_path().'/images/', $name);  
            $image = $name;  
        }
     

        $option= Option::find($id);
        $option->title = $request->get('title');
        $option->content = $request->get('content');
        if($image)
        {
            $option->image = $image;
        }
        if($gallery)
        {
            $option->gallery =  $gallery;
        }
        $option->votes = (int) $request->get('votes');  
        $option->active = (Boolean) $request->get('active');      
        $option->save();

        return redirect('option')->with('success', 'Option has been successfully added');
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
        return redirect('option')->with('success','option has been  deleted');
    }
    public function ajax_store(Request $request)
    {
        $image = '';
        $gallery = [];
        
        // $request->validate([
 
        //     'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        //     'gallery.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
 
        // ]);
 
        
        if($request->hasfile('gallery'))
        {
            foreach($request->file('gallery') as $img)
            {
                $name=$img->getClientOriginalName();
                $img->move(public_path().'/images/', $name);  
                $gallery []= $name;  
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
        $option->title = $request->get('title');
        $option->content = $request->get('content');
        $option->image = $image;
        $option->gallery =  $gallery;
        $option->votes = $request->get('votes');       
        $option->save();
    
        echo json_encode($option);
    }
}
