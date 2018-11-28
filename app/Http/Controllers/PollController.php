<?php 

namespace App\Http\Controllers;
 
use Auth;

use App\Models\Blog;
use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;
 
class PollController extends Controller
{
  
    public function  show()
    {

    	// $cookie = request()->cookie('poll');
	
		$poll = Poll::with('pollOptions')->first();

    	return [
    		'poll'=> $poll->question,
    		'options' => $poll->pollOptions->map(function($item){
				return ['id' => $item->id, 
						'name' => $item->name, 
						'total' => $item->total ];
    		})
    		// 'isCookie' => $cookie ? true : false
			];
			
	}
	
	public function getPolls($blogid) 
	{
	
		return Poll::with(['pollOptions'])->get();
	
	}

	public function getPollOptions() 
	{
	
		return PollOption::all();
	
	}
 
 
    public function saveVote($poll_id, $blog_id)
    {

		// $blog_id = $request->get('blog_id');
		// $poll_id = $request->get('poll_id');

		$checkPollOptions = PollOption::where('blog_id', $blog_id)->where('user_id', Auth::user()->id)->first();

	   if(!$checkPollOptions) {
		$option = new PollOption;
		$option->poll_id = $poll_id;
		$option->user_id = Auth::user()->id;
		$option->blog_id = $blog_id;
		$option->total += 1;
		$option->save();

		return json_encode(['message' => 'vote']);
	   
	   } else if ($checkPollOptions->poll_id == $poll_id) {

		PollOption::where('blog_id', $blog_id)->where('user_id', Auth::user()->id)->delete();

		return json_encode(['message' => 'unvote']);
	   
		} else {
      
         PollOption::where('blog_id', $blog_id)->where('user_id', Auth::user()->id)->update([
		  'poll_id' => $poll_id,
          'total' => 1
        ]);

       return json_encode(['message' => 'changedVote']);

      }
    	
		// $option = PollOption::findOrFail($poll_id)->first();
		// $option->total += 1;	

		// $option->save();

		
		// ->cookie('poll','yes',1440);

	}
	
}