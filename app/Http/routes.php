<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/demo', function () {
    return 'Đây là demo đầu tiên';
});
Route::controller('/controller', 'HomeController', ['getFirst' => 'first', 'getSecond' => 'second', 'postThird' => 'third']);

Route::get('thongtin', 'HomeController@showInfor');

Route::get('khoa-hoc/{ten}/{tg?}', function ($ten, $tg = 34) {
    return "xin chao " . $ten . $tg;
})->where(['ten' => "[a-zA-Z]+", 'tg' => "[0-9]{1,10}"]);
Route::get('thong-tin-rat-dai', [
    'as' => 'tt',
    function () {
        return "thong tin rat dai";
    }
]);

Route::group(
    ["prefix" => "group"],
    function () {
        Route::get('group1', function () {
            echo "1";
        });
        Route::get('group2', function () {
            echo "2";
        });
        Route::get('group3', function () {
            echo "3";
        });
    }
);

Route::get('goi-view', function () {
    return view("layout.sub.view");
});

View::share('title', 'giangnd');
View::composer('layout.sub.view', function ($view) {
    return $view->with('name', 'giang nguyen ptit');
});

Route::get('check-view', function () {
    if (view()->exists('layout.sub.view')) {
        echo 'ton tai view';
        echo 'ton tai view';
    } else {
        echo 'khong ton tai view';
    }
});

Route::get('goi-master', function () {
    return view("layout");
});
Route::get('url/full', function () {
    return URL::full();
});
Route::get('url/to', function () {
    return URL::to('goi-view', ['giang', 123]);
});
Route::get('schema/create', function () {
    Schema::create('vidu', function ($table) {
        $table->increments('id');
        $table->string('tenmon');
        $table->integer('gia');
        $table->text('ghichu')->nullable();
        $table->timestamps();
    });
});
Route::get('schema/rename', function () {
    Schema::rename('vidu', "giang");
});
Route::get('schema/drop', function () {
    Schema::drop('giang');
});
Route::get('schema/category', function () {
    Schema::create('category', function ($table) {
        $table->increments('id');
        $table->string('tenmon');
    });
});
Route::get('schema/products', function () {
    Schema::create('products', function ($table) {
        $table->increments('id');
        $table->string('name');
        $table->integer('idcategory')->unsigned();
        $table->foreign('idcategory')->references('id')->on('category')->onDelete('cascade');
    });
});
Route::get('db/select-all', function () {
    $a = DB::table('products')->get();
    echo "<pre>";
    print_r($a);
    echo "</pre>";
});
Route::get('db/select-name', function () {
    $a = DB::table('products')
        ->select('name')
        ->where('id', 2)
        ->orWhere('id', 1)
        ->get();
    echo "<pre>";
    print_r($a);
    echo "</pre>";
});
Route::get('db/select-orderby', function () {
    $a = DB::table('products')->orderBy('id', 'DESC')->get();
    echo "<pre>";
    print_r($a);
    echo "</pre>";
});
Route::get('db/select-limit', function () {
    $a = DB::table('products')
        ->skip(0)
        ->take(1)
        ->orderBy('id', 'DESC')
        ->get();
    echo "<pre>";
    print_r($a);
    echo "</pre>";
});
Route::get('db/select-between', function () {
    $a = DB::table('products')
        ->whereBetween('id', [1, 2])
        ->get();
    echo "<pre>";
    print_r($a);
    echo "</pre>";
});
Route::get('db/select-not-between', function () {
    $a = DB::table('products')
        ->whereNotBetween('id', [1, 2])
        ->get();
    echo "<pre>";
    print_r($a);
    echo "</pre>";
});
Route::get('db/select-where-in', function () {
    $a = DB::table('products')
        ->whereIn('id', [2, 1])
        ->get();
    echo "<pre>";
    print_r($a);
    echo "</pre>";
});
Route::get('db/select-not-where-in', function () {
    $a = DB::table('products')
        ->whereNotIn('id', [2, 1])
        ->get();
    echo "<pre>";
    print_r($a);
    echo "</pre>";
});
Route::get('db/count', function () {
    $a = DB::table('products')->count();
    echo $a;
});
Route::get('db/join', function () {
    $a = DB::table('products')
        ->join('category', 'category.id', '=', 'products.idcategory')
        ->get();
    echo "<pre>";
    print_r($a);
    echo "</pre>";
});
Route::get('db/model-all', function () {
    $data = App\Products::all()->toArray();
    return $data;
});
Route::get('db/model-find', function () {
    $data = App\Products::findOrFail(1);
    //$data = App\Product::where('id','>',2)->get();
    return $data;
});
Route::get('db/model-where', function () {
    $data = App\Products::where('id', '<=', 2)->firstOrFail()->get();
    return $data;
});
Route::get('db/model-limit', function () {
    $data = App\Products::all()->take(1);
    return $data;
});
Route::get('db/model-add', function () {
//    $data = new App\Products;
//    $data->name = 'data1';
//    $data->idcategory = '1';
//    $data->save();
    App\Products::create(
        ['name'=>'name','idcategory'=>1]
    );
    echo "success";
});