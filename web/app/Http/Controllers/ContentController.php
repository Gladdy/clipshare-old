<?php namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;

use App\Cliptext;
use App\Clipfile;
use App\User;

use Illuminate\Http\Request;
use Input;
use Auth;
use Validator;
use Response;
use File;

class ContentController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function findLocation(Request $request, $filename)
    {
        $root = $request->root();
        $infix = '/static/';
        $localStorage = '/web-storage/clipshare';

        do{
            $randomString = str_random(8);
            $local = $localStorage.$infix.$randomString .'/';
        }
        while (File::exists($local));

        $url = $root.$infix.$randomString .'/'.$filename;

        return ['folder' => $local, 'url' => $url, 'local' => $local.$filename];
    }

    public function postContent(Request $request)
    {
        if (Input::hasFile("file")) {
            $file = Input::file("file");

            if ($file->isValid())
            {
                $mimeType = $file->getMimeType();
                $filename = $file->getClientOriginalName();
                $location = $this->findLocation($request, $filename);

                $file->move($location['folder'], $filename);


                $clipfile = new Clipfile;
                $clipfile->user_id = Auth::id();
                $clipfile->file_location = $location['local'];
                $clipfile->file_url = $location['url'];
                $clipfile->file_mimetype = $mimeType;
                $clipfile->file_size = filesize($location['local']);
                $clipfile->save();

                return '{"folder" : "'. $location['folder']  .'", "url" : "'. $location['url']  .'", "local" : "'. $location['local']  .'"}';
            }
        } else {
            return Response::json(["value" => "Well maybe it's text"], 400);
        }

        return Response::json("error", 400);
    }

    public function getText()
    {
        return view('pages.dashboard-text')->with('active','text')->with('data',Auth::user()->textClips);
    }

    public function getStatus()
    {
        return view('pages.dashboard-status')->with('active','status');
    }

    public function getFiles()
    {
        return view('pages.dashboard-files')->with('active','files');
    }

    public function getSettings()
    {
        return view('pages.dashboard-settings')->with('active','settings');
    }

}
