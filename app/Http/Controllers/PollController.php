<?php 

namespace App\Http\Controllers;
 
use App\Models\Poll;
use App\Models\PollOption;
use Illuminate\Http\Request;
 
class PollController extends Controller
{
  
    public function  show()
    {

    	$cookie = request()->cookie('poll');
		// if use  only active "tinyinteget"
	    // public function scopeActive($query)
		// {
		// 	return $query->where('active', true);
		// }

		$poll = Poll::with('pollOptions')->active()->first();

    	return [
    		'poll'=> $poll->question,
    		'options' => $poll->pollOptions->map(function($item){
				return ['id' => $item->id, 
						'name' => $item->name, 
						'total' => $item->total ];
    		}),
    		'isCookie' => $cookie ? true : false
			];
			
	}
	
	public function getPolls() {
		return Poll::with('pollOptions')->active()->get();
	}
 
    public function store(Request $request)
    {
    	$id = $request->get('id');
    	if($id)
    	{
    		$option = PollOption::findOrFail($id);
    		$option->total += 1;
    		$option->save();
 
			return response("Vote added successfully")
			->cookie('poll','yes',1440);
    	}
    }
}