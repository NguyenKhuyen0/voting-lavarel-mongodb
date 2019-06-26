<?php

namespace App\Http\Controllers;

use App\Voting;
use App\Question;
use Illuminate\Http\Request;

class VotingController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $votings= Voting::all();
        return view('voting.index',compact('votings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('voting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $voting= new Voting();
        $voting->title = $request->get('title');
        $questions = [];
        if($request->get('ids'))
        {
            $ids = json_decode($request->get('ids'));
    
            foreach($ids as $id)
            {

                // $voting =  voting::where('_id', 'LIKE', $id.'%')
                // ->get();
                $question = Question::find($id);
                
                $questions []= $question;
            }
        }

        $voting->save();
        $voting->questions()->saveMany($questions);

        return redirect('voting')->with('success', 'Question has been successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function show(voting $voting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $voting = Voting::find($id);
        return view('voting.edit',compact('voting','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $voting= Voting::find($id);
        $voting->title = $request->get('title');
        $questions = [];
        if($request->get('ids'))
        {
            $ids = json_decode($request->get('ids'));
    
            foreach($ids as $id)
            {

                // $voting =  voting::where('_id', 'LIKE', $id.'%')
                // ->get();
                $question = Question::find($id);
                
                $questions []= $question;
            }
        }

        $voting->save();
        $voting->votings()->saveMany($questions);

        return redirect('voting')->with('success', 'Question has been successfully added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\voting  $voting
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $voting = Voting::find($id);
        $voting->delete();
        return redirect('voting')->with('success','Voting has been  deleted');
    }

    public function search(Request $request)
    {
        // search

        // if($request->ajax()) {
            // select country name from database
            $data = Question::where('question', 'LIKE', $request->title.'%')
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
                        <div class="col js-input bd-ced4da" data-id='.$row->_id.'>'.$row->question.'</div>
                        <div class="col col-auto"><button class="btn btn-success active btn-success" type="button">ADD</button></div>
                    </div>';
                }
                // end of output
              
            }
            else {
                // if there's no matching results according to the input
                $output .= '<p>Không tìm thấy question
                
                </p>';
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
