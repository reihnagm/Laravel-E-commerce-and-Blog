<?php 

namespace App\Http\Controllers;
 
use App\Models\Poll;
use App\Models\Blog;
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
	
	public function getPolls() 
	{
	
		return Poll::with('pollOptions')->get();
	
	}
 
    public function store(Request $request)
    {

		$poll_option_id = $request->get('poll_option_id');
		$blog_id = $request->get('blog_id');

    	if($poll_option_id && $blog_id)
    	{
			
			$option = PollOption::findOrFail($poll_option_id);
			$option->blog_id = $blog_id;
			$option->total += 1;	

			$option->save();

			return response("Vote added successfully");
			// ->cookie('poll','yes',1440);
		
		}

	}
	
}