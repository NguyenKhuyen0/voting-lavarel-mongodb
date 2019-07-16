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
        $options = $request->get('options');
        $id_voting = $request->get('id_voting');
        $id_user =  $request->get('id_user');
        // votes : [{'id' => ,}, ], id: od option
        foreach($options as $option)
        {
            $id_option = $option->id;
            vote($id_option, $id_user);
        }
        return ['maso' => getMaSo($id_voting, $id_user)];
    }
    private function vote($id_option, $id_user)
    {
        $option = Option::find($id_option);
        $voted_users =  $option->voted_users;

        if( (is_array($voted_users) && !in_array( $id_user ,$voted_users)) || empty($voted_users))
        {
            $option->voted_users =  $voted_users ? (array_push($voted_users, $id_user)) : [$id_user];
            $option->votes = empty($option->votes) ?  0 : (int) $option->votes + 1;
            $option->save();
        }
    }
    private function getMaSo($id_voting, $id_user)
    {
        $current_maso =  1000;
        $current_voting = Voting::find($id_voting);
        $voted_users = [];
        if($current_voting)
        {
            $current_voted_users = $current_voting->voted_users;
           
            if(empty($voted_users))
            {
                $voted_users []= [
                    'id_user' => $id_user,
                    'maso' => $current_maso,
                  ];
            }
            else
            {
                if(!in_array($id_user, $current_voted_users))
                {
                    $current_maso = (int)$current_voted_users[$current_voted_users.length - 1]->maso + 1;
                    $voted_users []= [
                        'id_user' => $id_user,
                        'maso' => $current_maso,
                      ];
                }
            }

        }
        $current_voting->voted_users = $voted_users;
        $current_voting->save();

        return $current_maso;
    }

}
