<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

Route::get('vue/{any?}', function () {
    return view('vue.index');
})->where("any", ".*");

Route::redirect('/', 'home');
Route::view('home', 'pages.home');

Route::get('hi', function () {
    return 'Hello World';
});

Route::match(['get', 'post'], 'url-match', function (Request $request) {

    if ($request->isMethod('post')) :
        return 'POST';
    endif;

    return 'Route GET';
});

Route::any('url-any', function (Request $request) {
    $method = $request->method();
    return $method;
});

Route::get('about/{name?}', function (Request $request, $name = 'baledemia') {
    $score = rand(0, 4);
    $day = date("N", time());
    $title = 'About';

    return View::make('pages.about', [
        'name'  => $name,
        'auth'  => false,
        'score' => $score,
        'day'   => $day,
        'title' => $title
    ])->with('image', '');
})->whereAlpha('name')->name('profile');

Route::prefix('products')->group(function () {
    Route::get('/', function (Request $request) {
        $products = [
            [
                "title" => "Brown eggs",
                "type" => "dairy",
                "description" => "Raw organic brown eggs in a basket",
                "filename" => "0.jpg",
                "price" => 28.1,
                "rating" => 4
            ], [
                "title" => "Sweet fresh stawberry",
                "type" => "fruit",
                "description" => "Sweet fresh stawberry on the wooden table",
                "filename" => "1.jpg",
                "price" => 29.45,
                "rating" => 4
            ], [
                "title" => "Asparagus",
                "type" => "vegetable",
                "description" => "Asparagus with ham on the wooden table",
                "filename" => "2.jpg",
                "price" => 18.95,
                "rating" => 3
            ]
        ];

        if (View::exists('pages.product')) :
            return view('pages.product', ['products' => $products]);
        endif;
    });

    Route::get('{id}', function ($id) {
        return 'Product ' . $id;
    })->where('id', '[0-9]+');
});

Route::get('form-submit', function () {
    $message = 'Menjadi Member Berlangganan';
    $user = [
        'remember' => true
    ];

    return View::make('examples.formulir', [
        'user' => $user,
        'message' => $message
    ]);
});

Route::get('getbootstrap/index', function () {
    return View::make('getbootstrap.index');
});

Route::get('getbootstrap/blog', function () {
    return View::make('getbootstrap.blog');
});

Route::get('react/{any?}', function () {
    return view('react.index');
})->where("any", ".*");

Route::get('svelte', function () {
    return view('svelte.index');
});

Route::get('contacts', function () {

    $contact = DB::table('products')->max('price');
    return $contact;
});

Route::get('get-request', function (Request $request) {
    $uri = $request->path();
    $url = $request->url();

    $urlWithQueryString = $request->fullUrl();
    $fullUrl = $request->fullUrlWithQuery(['role' => 'admin']);

    $host = $request->host();
    $httpHost = $request->httpHost();
    $schemaHttpHost = $request->schemeAndHttpHost();

    $headerName = $request->header('X-Header-Name', 'Default Header');
    $ipAddress = $request->ip();

    return $headerName;
});

Route::post('post-request', function (Request $request) {
    $input = $request->all();
    $collection = $request->collect();
    $name = $request->input('name');
    $token = $request->query('token');
    $phone = $request->phone;

    $address = $request->input('address.street');
    $inputExcept = $request->except(['address', 'company']);
    $emailAndWebsite = $request->only('email', 'website');

    $key = csrf_token();

    if ($request->hasFile('photo')) :
        $file = $request->photo->getClientOriginalName();
    endif;

    $request->merge(['votes' => 0]);
    return $request;
});

Route::resource('users', UserController::class);
