<?php

namespace App\Http\Controllers;

use App\Question;
use App\Option;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions= Question::all();
        return view('question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $question= new Question();
        $question->question = $request->get('question');
        $question->active = (Boolean) $request->get('active');
        $question->many_answers = (Boolean) $request->get('many_answers');

        $options = [];
        if($request->get('ids'))
        {
            $ids = json_decode($request->get('ids'));
    
            foreach($ids as $id)
            {

                // $option =  Option::where('_id', 'LIKE', $id.'%')
                // ->get();
                $option = Option::find($id);
                
                $options []= $option;
               
            }
        }

        $question->save();
        $question->options()->saveMany($options);

        return redirect('question')->with('success', 'Question has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question = Question::find($id);
        return view('iframe.question',compact('question','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $question = Question::find($id);
        return view('question.edit',compact('question','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question= Question::find($id);
        $question->question = $request->get('question');
        $question->active = (Boolean) $request->get('active');
        $question->many_answers = (Boolean) $request->get('many_answers');
     
        $options = [];
        if($request->get('ids'))
        {
            $ids = json_decode($request->get('ids'));
    
            foreach($ids as $id)
            {

                // $option =  Option::where('_id', 'LIKE', $id.'%')
                // ->get();
                $option = Option::find($id);
                
                $options []= $option;
               
            }
        }

        $question->save();

        $question->options()->saveMany($options);

        return redirect('question')->with('success', 'Question has been successfully added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        return redirect('question')->with('success','Question has been  deleted');
    }

    public function search(Request $request)
    {
        // search

        // if($request->ajax()) {
            // select country name from database
            $data = Option::where('title', 'LIKE', '%'.$request->title.'%')
                ->get();
            // declare an empty array for output
            $output = '';
            // if searched countries count is larager than zero
            if (count($data)>0) {
                // concatenate output to the array
               
                // loop through the result array
                foreach ($data as $row){
                    // concatenate output to the array
                    $output .= '
                    <div class="form-row js-add mgb-20px">
                        <div class="col js-input bd-ced4da" data-id='.$row->_id.'>'.$row->title.'</div>
                        <div class="col col-auto"><button class="btn btn-success active btn-success" type="button">ADD</button></div>
                    </div>';
                }
                // end of output
              
            }
            else {
                // if there's no matching results according to the input
                $output .= '<p>Không tìm thấy option</p>';
            }
            // return output result array
            return $output;
        // }

        // else
        // {
        //     return '11111';
        // }
    }

}
