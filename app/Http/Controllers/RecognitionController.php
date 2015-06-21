<?php
namespace App\Http\Controllers;
use MovieRazzi\Services\FaceRecognition\Detector as Detector;
use MovieRazzi\Services\TMDb\TMDb as TMDb;


class RecognitionController extends Controller {
    private $detector;
    private $tmdb;
    private $response;
    public function __construct() {
        $this->detector = new Detector("6d46f8babc494ad293d8501a8d4cd099","af3a4243153e475a9ff95a6b186b67b3");
        $this->tmdb = new TMDb('c313e35820484aa52261385dcd3a2a94');
    }

    public function getRecognize() {
        return view('recognize');
    }

    public function postRecognize() {
        $url = \Input::get('url');
        $image = \Input::file('img');
        $filename = $this->upload($image);
        //$result = $this->detector->faces_recognize($url, 'all', 'CELEBS');
        $filename = public_path().'/recognize/'.$filename;
        $result = $this->detector->faces_recognize(null, 'all','CELEBS', $filename);
        if(($result->status == 'success')) {
            $actorName = $this->sanitizeName($this->extractName($result));
            $movies = $this->fetchMovies($actorName);
            $response = array(
                'name' => $actorName,
                'movies' => $movies
            );
            return json_encode($response);

        }
        else {
            return \Response::json(['msg'=>'We were unable to recognize this face. Please Try Again Later.'],500);
        }
    }

    private function extractName($result) {
        $uids = $result->photos[0]->tags[0]->uids;
        if(empty($uids)) {
            return Response::json(['msg'=>"We were unable to recognize the face. Please Try Again Later."],500);
        }
        else {
            $mostConfident = 0;
            foreach($uids as $uid)
            {
                if($uid->confidence > $mostConfident) {
                    $mostConfident = $uid->confidence;
                    $finalUID = $uid->uid;
                }
            }

            return $finalUID;
        }
    }

    private function fetchMovies($name) {
        $person_details = $this->tmdb->searchPerson($name);
        $movies = $this->tmdb->getPersonCredits($person_details['results'][0]['id']);
        return $movies;
    }

    private function sanitizeName($name) {
        $name = explode('@',$name);
        $final = explode('-', $name[0]);
        return $final[0].' '.$final[1];
    }

    private function upload($image) {
        $filename = $image->getClientOriginalName();
        $image->move('recognize',$filename);
        return $filename;
    }
}