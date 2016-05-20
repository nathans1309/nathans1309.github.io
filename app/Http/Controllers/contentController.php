<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class contentController extends Controller
{
    public function index(Request $request)
    {
    	$data = [
    		(object) ['title' => 'title1', 'text' => 'bunch of text'],
    		(object) ['title' => 'title2', 'text' => 'bunch of text'],
    		(object) ['title' => 'title3', 'text' => 'bunch of text'],
    		(object) ['title' => 'title4', 'text' => 'bunch of text'],
    		(object) ['title' => 'title5', 'text' => 'bunch of text'],
    		(object) ['title' => 'title6', 'text' => 'bunch of text'],
    		(object) ['title' => 'title7', 'text' => 'bunch of text'],
    	];
    	return view('content.index', ['data'=>$data]);
    }

    public function scheduled(Request $request)
    {
    	$data = [
    		(object)['title'=>'Post 1', 'time'=>'4pm'],
    		(object)['title'=>'Post 2', 'time'=>'8:30pm'],
    		(object)['title'=>'Post 3', 'time'=>'12am']
    	];

    	return view('content.scheduled', ['data' => $data]);
    }

    public function loadTemplate(Request $request, $id)
    {
	//get template info from id
    	$data = [
    		'title' => 'title1', 
    		'text' => 'post content',
    		'img' => 'http://placehold.it/300x300',
    		'video' => 'video src'
	];

	return view('content.load', $data);
    }

    public function history(Request $request)
    {
    	$data = [
    		(object)['title'=>'Post 1'],
    		(object)['title'=>'Post 2'],
    		(object)['title'=>'Post 3']
    	];

    	return view('content.history', ['data' => $data]);
    }

    public function socialBlast(Request $request){
    	return redirect('content');
    }
}
