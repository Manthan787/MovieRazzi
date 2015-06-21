<?php

Route::get('/', function(){
   return 'HI!';
});

Route::get('/api/detect', function() {
   $detector = new MovieRazzi\Services\FaceRecognition\Detector("6d46f8babc494ad293d8501a8d4cd099","af3a4243153e475a9ff95a6b186b67b3");
   $detector->fun();
});

Route::get('api/recognize', 'RecognitionController@getRecognize');
Route::post('api/recognize', 'RecognitionController@postRecognize');

Route::get('admin','Admin\AdminController@getIndex');
Route::get('admin/tags/save', 'Admin\AdminController@getSaveTag');
Route::post('admin/tags/save', 'Admin\AdminController@postSaveTag');

Route::get('demo', function() {
    $name = 'Alia-Bhatt@CELEBS';
    $name = explode('@',$name);
    $final = explode('-', $name[0]);
    return $final;
});