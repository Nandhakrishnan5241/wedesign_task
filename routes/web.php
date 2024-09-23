<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/funny', function () {
    return view('funny');
});

Route::post('/predictions', function (Request $request) {
    $name  = $request->input('name');
    $email = $request->input('email');
    $birthday = $request->input('birthday');
    // prediction curl
    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => "https://api.agify.io/?name=" . $name,
        CURLOPT_RETURNTRANSFER => true,
    );
    curl_setopt_array($ch, $curlConfig);
    $nameResult = curl_exec($ch);
    $nameResult = json_decode($nameResult, true);
    curl_close($ch);

    // joke curl 
    // $ch = curl_init();
    // $curlConfig = array(
    //     CURLOPT_URL            => "https://v2.jokeapi.dev/joke/Any",
    //     CURLOPT_RETURNTRANSFER => true,
    // );
    // curl_setopt_array($ch, $curlConfig);
    // $jokeResult = curl_exec($ch);
    // $jokeResult = json_decode($jokeResult, true);
    // $joke = $jokeResult['joke'];

    // advice curl 
    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => "https://api.adviceslip.com/advice",
        CURLOPT_RETURNTRANSFER => true,
    );
    curl_setopt_array($ch, $curlConfig);
    $adviceResult = curl_exec($ch);
    $adviceResult = json_decode($adviceResult, true);
    $advice = $adviceResult['slip']['advice'];
    
    // image curl
    $ch = curl_init();
    $curlConfig = array(
        CURLOPT_URL            => "https://dog.ceo/api/breeds/image/random",
        CURLOPT_RETURNTRANSFER => true,
    );
    curl_setopt_array($ch, $curlConfig);
    $imageResult = curl_exec($ch);
    $imageResult = json_decode($imageResult, true);

    curl_close($ch);
    $name = $nameResult['name'];
    $age = $nameResult['age'];
    $image = $imageResult['message'];

    return view('predictions', compact(['name', 'age', 'image','advice']));
});

Route::get('/array', function () {
    $originalArray = [88, 24, 34, 88, 59, 5, 1, 145, 2, 12, 1];
    $array = $originalArray;
    $count = count($array);
    $assc = [];
    $desc = [];
    $dublicateArray = [];
    $uniqueArray = [];
    // ascending order
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count - $i - 1; $j++) {
            if ($array[$j] > $array[$j + 1]) {
                // dd($array[$j], $array[$j+1]);
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
    $assc = $array;
    // descending order
    for ($i = 0; $i < $count; $i++) {
        for ($j = 0; $j < $count - $i - 1; $j++) {
            if ($array[$j] < $array[$j + 1]) {
                // dd($array[$j], $array[$j+1]);
                $temp = $array[$j];
                $array[$j] = $array[$j + 1];
                $array[$j + 1] = $temp;
            }
        }
    }
    $desc = $array;

    //  remove dublicate value
    foreach ($originalArray as $data) {
        if (!in_array($data, $uniqueArray)) {
            array_push($uniqueArray, $data);
        } else {
            array_push($dublicateArray, $data);
        }
    }

    // dd($uniqueArray,$dublicateArray);


    return view('array', compact(['assc', 'desc', 'uniqueArray', 'dublicateArray', 'originalArray']));
});


Route::get('/',function(){
    return view('login');
});
Route::post('/validate',[UserController::class,'validateUser']);

Route::get('/manage',[UserController::class,'getUsers']);

Route::get('adduser',function(){
    return view('add');
});
Route::post('/saveuser',[UserController::class,'saveUserData']);

Route::post('/uploadimage',[UserController::class,'uploadImage']);

Route::get('/edit/{id}',[UserController::class,'edit']);
Route::post('/update/{id}',[UserController::class,'updateUser']);
Route::get("/delete/{id}",[UserController::class,'delete']);
