<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MovieRequest;
use App\Models\Movie;
Use Exception;
use Auth;
use Youtube;

class MovieController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(MovieRequest $request)
    {
        $url = $request->url_link;
        $ids = Youtube::getYoutubeIDs($url);
        if (!empty($ids)) {
            $video_id = $ids[0];
            $data = [];
            try {
                $data = Youtube::getVideoDetail($video_id);
                $data['user_id'] = Auth::user()->id;
                $data['url_link'] = $request->url_link;
                $movie = Movie::create($data);
            } catch (Exception $ex) {
                return redirect()->back()
                    ->withErrors(['Youtube url is wrong format.'])
                    ->withInput();            }
        } else {
            return redirect()->back()
                ->withErrors(['Youtube url is wrong format.'])
                ->withInput();
        }
        // Output title
        return redirect()->back()->with('success', 'Movie success added!');
    }

    public function store2(MovieRequest $request)
    {
        $url = $request->url_link;
        $ids = Youtube::getYoutubeIDs($url);
        if (!empty($ids)) {
            $api_key = "AIzaSyBp7QOR_Wcx9ffTrue0usCBCglt-JpjbVo";
            $video_id = $ids[0];
            $url = "https://www.googleapis.com/youtube/v3/videos?id=" . $video_id . "&key=" . $api_key . "&part=snippet,contentDetails,statistics,status";
            $data = [];
            try {
                $json = file_get_contents($url);
                $getData = json_decode($json , true);
                foreach((array)$getData['items'] as $key => $gDat){
                    $data['title'] = $gDat['snippet']['title'];
                    $data['description'] = $gDat['snippet']['description'];
                    $data['user_id'] = Auth::user()->id;
                    $data['url_link'] = $request->url_link;
                }
                $data['youtube_id'] = $video_id;
                $movie = Movie::create($data);
            } catch (Exception $ex) {
                return redirect()->back()
                    ->withErrors(['Youtube url is wrong format.'])
                    ->withInput();            }
        } else {
            return redirect()->back()
                ->withErrors(['Youtube url is wrong format.'])
                ->withInput();
        }
        // Output title
        return redirect()->back()->with('success', 'Movie success added!');
    }

    public function index()
    {

    }

    public function show()
    {

    }

    public function vote(Request $request)
    {
        try {
            Auth::user()->movieVoteToogle($request->post('movie_id'), $request->post('voted_status'));
        } catch (Exception $ex) {
            return response()->json(
                [
                    'message' => 'Vote error' . $ex->getMessage(),
                    'state' => 200
                ]
            );
        }
        return response()->json(
            [
                'message' => 'Vote success',
                'state' => 200
            ]
        );
    }

    private function getYoutubeId($url)
    {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        return $matches;
    }
}
