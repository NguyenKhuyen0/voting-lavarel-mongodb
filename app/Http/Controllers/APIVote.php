<?php

namespace App\Http\Controllers;
use App\Voting;
use App\Question;
use App\Option;
use Illuminate\Http\Request;

class APIVote extends Controller
{
    private $message;
    private $cho_phep_user_vote_nhieu_lan = true;

    public function index()
    {
    }

    public function api_votes(Request $request)
    {

        $options = $request->get('options');
        $voting_id = $request->get('voting_id');
        $voting = Voting::find($voting_id);
        $active = $voting->active;
        $time = time();
        $start_time = strtotime($voting->start_time);
        $end_time = strtotime($voting->end_time);

        if($active && ($start_time < $time && $time < $end_time))
        {
            $user_id =  $request->get('user_id');
            $not_voted = true;
            // votes : [{'id' => ,}, ], id: od option
            foreach($options as $option_id)
            {
                if($this->vote_thanh_cong($option_id, $user_id))
                {
                    $not_voted = false;
                }
            
            }
            // return false: User đã vote option này rồi
            if($not_voted)
            {
                $this->message['fail']= true;
                return $this->echo_log($this->message);
            }
            else 
            {
                return $this->echo_log(['maso' => $this->getMaSo($voting_id, $user_id)]);
            }
        }
        $this->message['timeout']= true;
        return  $this->echo_log($this->message);
    }
    private function vote_thanh_cong($option_id, $user_id)
    {
        $option = Option::find($option_id);
        $voted_users =  $option->voted_users;
        
        if( $this->cho_phep_user_vote_nhieu_lan || $this->chua_vote_option($voted_users, $user_id))
        {

            $option->voted_users =  empty($voted_users) ? (array_push($voted_users, $user_id)) : [$user_id];
            $option->votes = empty($option->votes) ?  1 : (int) $option->votes + 1;
            $option->save();
            return true;
        }
        else 
        {
            $this->message['da_binh_chon']= true;
            return false;
        }
        
    }
    private function chua_vote_option($voted_users, $user_id)
    {
        return (is_array($voted_users) && !in_array( $user_id ,$voted_users)) || empty($voted_users);
    }
    private function getMaSo($voting_id, $user_id)
    {
        $current_maso =  dechex(time());
        $current_voting = Voting::find($voting_id);
        // return json_encode( $current_voting);
        $voted_users = [];
        if($current_voting)
        {
            $voted_users = $current_voting->voted_users;
            if($this->chua_vote_voting($voted_users, $user_id))
            {

                $voted_users = $this->update_voted_users($voted_users, $user_id, $current_maso);
                $current_voting['voted_users'] = $voted_users;
                $current_voting->save();
            }
            else
            {
                $array = array_column($voted_users, 'user_id');
                $key = array_search($user_id,  $array);
                $current_maso = $voted_users[$key]['maso'];
            }
        }


        return $current_maso;
    }
    private function chua_vote_voting($voted_users, $user_id)
    {
        return empty($voted_users) || !in_array($user_id, array_column($voted_users, 'user_id'));
    }
    private function update_voted_users($voted_users, $user_id, $current_maso)
    {

        $voted_users []= [
            'user_id' => $user_id,
            'maso' => $current_maso,
            ];
    
        return $voted_users;
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
            return json_encode($voting);
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

    private function echo_log($obj_message)
    {
        echo json_encode($obj_message);
    }
}
