<?php

namespace App\Http\Controllers;
use App\User;
use App\User_detail;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Cookie;
use DB;

class UserController extends Controller
{
    //
	public function store(Request $request)
    {
        $this->validate($request,[
            'name'		 =>  'required',
        ]);
		
		$user = new User;
		$user->name		=   $request->name;
        $user->save();
		
        return redirect('/questions')->withCookie(cookie('user_id', $user->id, 15));
    }
	public function showQuestions()
	{
		$client = new Client;
		$res = $client->request('GET', 'https://opentdb.com/api.php?amount=10');
		$data = $res->getBody()->getContents();
		return view('/questions', ['data'=>json_decode($data, true)]);
	}
	public function storeDetails(Request $request)
	{
		$user_id = $request->cookie('user_id');
		$ans = $request->data;
		for($i=0; $i<count($ans); $i++)
		{
			$user_details = new User_detail;
			$user_details->user_id = $user_id;
			$user_details->user_ans = $ans[$i][1];
			$user_details->correct_ans = $ans[$i][0];
			$user_details->result = $ans[$i][2];
			$user_details->save();
		}
		Cookie::queue(Cookie::forget('user_id'));
		return \Response::json(['success' => "Thank you"], 200);

	}
	public function getAll()
	{
		return json_encode(User::get(['id', 'name']));
	}
	public function getUserDetails()
    {
		
		$users = DB::table('users')
			->leftjoin( DB::raw(" (select count(result) as score, user_id from user_details where result=1 group by user_id) as ud"), 'ud.user_id', '=', 'users.id')
			->select('users.id','users.name', 'ud.score')
			->paginate(5);
		
		return view('user_details')->with('data', $users);
    }

    public function fetch_data(Request $request)
    {
     if($request->ajax())
     {
      $sort_by = $request->get('sortby');
      $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
		$data = DB::table('users')
			->leftjoin( DB::raw(" (select count(result) as score, user_id from user_details where result=1 group by user_id) as ud"), 'ud.user_id', '=', 'users.id')
			->where('users.id', 'like', '%'.$query.'%')
            ->orWhere('users.name', 'like', '%'.$query.'%')
            ->orderBy($sort_by, $sort_type)
            ->paginate(5);
      return view('pagination_data', compact('data'))->render();
     }
    }
}
