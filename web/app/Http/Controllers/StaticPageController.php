<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Illuminate\Http\Request;

class StaticPageController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        if(Auth::check())
		{
			return view('pages.dashboard-status')->with('active','status');
		}
		return view('pages.front-guest');
	}

    public function what() {
        return view('pages.info-what');
    }

    public function how() {
        return view('pages.info-how');
    }

    public function todo() {
        return view('pages.info-todo');
    }
}
