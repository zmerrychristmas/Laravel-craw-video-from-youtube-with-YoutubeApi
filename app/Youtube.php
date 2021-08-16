<?php
namespace App;
class Youtube
{

    public function getYoutubeIDs($url)
    {
        preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $url, $matches);
        return $matches;
    }

    public function getVideoDetail($id)
    {
        $api_key = env('YOUTUBE_API_KEY');
        $url = "https://www.googleapis.com/youtube/v3/videos?id=" . $id . "&key=" . $api_key . "&part=snippet,contentDetails,statistics,status";
        $data = [];
        $json = file_get_contents($url);
        $getData = json_decode($json , true);
        foreach((array)$getData['items'] as $key => $gDat){
            $data['title'] = $gDat['snippet']['title'];
            $data['description'] = $gDat['snippet']['description'];
        }
        $data['youtube_id'] = $id;
        return $data;
    }
}