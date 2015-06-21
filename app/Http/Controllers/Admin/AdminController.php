<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use MovieRazzi\Services\FaceRecognition\Detector as Detector;

class AdminController extends Controller {
    private $detector;

    public function __construct() {
        $this->detector = new Detector("6d46f8babc494ad293d8501a8d4cd099","af3a4243153e475a9ff95a6b186b67b3");

    }

    public function getIndex() {
        $users = $this->detector->account_users(['CELEBS']);
        if($users->status == 'success')
        {
            $celebs = $users->users->CELEBS;
            return view('admin.index')->with('celebs', $celebs);
            print_r($celebs);
        }
       // print_r($users);
    }

    public function getSaveTag() {
        return view('admin.saveTag');
    }

    public function postSaveTag() {
        $urls = \Input::get('urls');
        $urls = explode("||", $urls);

        $result = $this->detector->faces_detect($urls);
        print_r(json_encode((array)$result));
    }
}