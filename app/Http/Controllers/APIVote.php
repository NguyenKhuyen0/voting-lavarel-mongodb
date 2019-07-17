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

}
