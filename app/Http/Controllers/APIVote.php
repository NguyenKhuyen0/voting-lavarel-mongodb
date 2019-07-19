<?php

namespace App\Http\Controllers;
use App\Voting;
use App\Question;
use App\Option;
use Illuminate\Http\Request;

class APIVote extends Controller
{
    public function index()
    {
    }

    public function api_votes(Request $request)
    {
        // echo 111;
        $options = $request->get('options');
        $voting_id = $request->get('voting_id');
        $voting = Option::find($voting_id);
        $active = $voting->active;
        $start_time = strtotime($voting->start_time);
        $end_time = strtotime($voting->end_time);

        if($active && ($start_time < $time && $time < $end_time))
        {
            $user_id =  $request->get('user_id');
            $voted = false;
            // votes : [{'id' => ,}, ], id: od option
            foreach($options as $option_id)
            {
                if($this->vote($option_id, $user_id)) $voted = true;
            }
            // return false: User đã vote option này rồi
            return !$voted ?  ['maso' => $this->getMaSo($voting_id, $user_id)] : false;
        }
        return 0;
    }
    private function vote($option_id, $user_id)
    {
        $option = Option::find($option_id);
        $voted_users =  $option->voted_users;
        if( (is_array($voted_users) && !in_array( $user_id ,$voted_users)) || empty($voted_users))
        {
            $option->voted_users =  $voted_users ? (array_push($voted_users, $user_id)) : [$user_id];
            $option->votes = empty($option->votes) ?  0 : (int) $option->votes + 1;
            $option->save();
            return true;
        }
        else return false;
        
    }
    private function getMaSo($voting_id, $user_id)
    {
        $current_maso =  dechex(time());
        $current_voting = Voting::find($voting_id);
        // return json_encode( $current_voting);
        $voted_users = [];
        if($current_voting)
        {
            $current_voted_users = $current_voting->voted_users;
           
            if(empty($voted_users))
            {
                $voted_users []= [
                    'user_id' => $user_id,
                    'maso' => $current_maso,
                  ];
            }
            else
            {
                if(!in_array($user_id, $current_voted_users))
                {
                    $current_maso = (int)$current_voted_users[$current_voted_users.length - 1]->maso + 1;
                    $voted_users []= [
                        'user_id' => $user_id,
                        'maso' => $current_maso,
                      ];
                }
            }

        }
        $current_voting['voted_users'] = $voted_users;
        $current_voting->save();

        return $current_maso;
    }
    public function get_voting($id)
    {
        $voting = Voting::find($id);
        $active = $voting->active;
        $time = time();
        $start_time = strtotime($voting->start_time);
        $end_time = strtotime($voting->end_time);
   
        if($active && ($start_time < $time && $time < $end_time))
        {

            $temp_questions =  Question::where('voting_id', 'LIKE', $voting->id.'%')->get();
    
            $questions = [];
            $options = [];
            if($temp_questions)
            {
                foreach ($temp_questions as $key => $question) {
                    if($question->active)
                    {
                        $temp_options =  Option::where('question_id', 'LIKE', $question->id.'%')->get();
                        if($temp_options)
                        {
                            foreach($temp_options as $option)
                            {
                                if($option->active)  $options  []= $option;
                            }
                            $question->options = $options;
                        }
                        $questions []= $question;
                    }
                   
                }
            }
            $voting->questions = $questions;
            return json_encode($questions);
        }
        return 0;
    }
    public function get_question($id)
    {
        $question = Question::find($id);
        $active = $question->active;
        $voting_id = $question->voting_id;
        $voting = Voting::find($voting_id);
        $voting_active = $voting->active;

        $time = time();
        $start_time = strtotime($voting->start_time);
        $end_time = strtotime($voting->end_time);


        if($active && ($start_time < $time && $time < $end_time) && $voting_active)
        {
            $options = [];
            $temp_options =  Option::where('question_id', 'LIKE', $question->id.'%')->get();
            if($temp_options)
            {
                foreach($temp_options as $option)
                {
                    if($option->active)  $options  []= $option;
                }
                $question->options = $options;
            }
            return json_encode($question);
        }
        return 0;
    }

}
