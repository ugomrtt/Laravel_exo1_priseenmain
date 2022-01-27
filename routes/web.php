<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Livre;
use App\Models\Categorie;


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

Route::get('/', function () {
    return view('index');
});

Route::get('/accueil', function () {
    return view('accueil');
});

Route::get('/liste', function () {
    //=== Requete SQL ===//
    // $livres = DB::select('select * from ltp1livres');
    // $livreId1 = DB::select('select * from ltp1livres where id="1"');
    // $livreTom = DB::select('select titre, prix from ltp1livres where titre like "%Tom%"');

    //=== Requete Query Builder ===//
    // $livres = DB::table('livres')
    //         -> select('*')
    //         -> get();
    // $livreId1 = DB::table('livres')
    //         -> select('*')
    //         -> where('id','=','1')
    //         -> get();
    // $livreTom = DB::table('livres')
    //         -> select('titre','prix')
    //         -> where('titre','like','%Tom%')
    //         -> get();
    
    // dump($livres, $livreId1, $livreTom);

    
    //=== Requete ORM ===//
    $livres = Livre::join('categories', 'categories.id', '=', 'livres.categorie_id')->select('livres.id','livres.titre', 'livres.resume','livres.prix', 'categories.libelle')->get();

    return view('liste', ["livres"=>$livres]);
});

Route::get('/meslivres', function () {
    $livres = Livre::join('categories', 'categories.id', '=', 'livres.categorie_id')->where('user_id','=',Auth::user()->id)->select('livres.id','livres.titre', 'livres.resume','livres.prix', 'categories.libelle')->get();

    return view('meslivres', ["livres"=>$livres]);
});

Route::get('/ajouter', function () {

    $categories = Categorie::get();

    return view('ajouter', ["categories"=>$categories]);
});

Route::get('/ajout', function (Request $request) {

    $livre = new Livre;
    $livre->titre = $request->input('titre');
    $livre->resume = $request->input('resume');
    $livre->prix = $request->input('prix');
    $livre->user_id = Auth::user()->id;
    $livre->categorie_id = $request->input('categorie_id');
    $livre->save();

    if($livre->save()==true){
        $message = "Livre ajouté";
    }
    
    return view('index', ["message"=>$message]);
});

Route::get('/modifier', function (Request $request) {
    $livre = Livre::find($request->input('id'));
    $categories = Categorie::get();

    return view('modifier', ['livre' => $livre, 'categories'=>$categories]);
});

Route::get('/modif', function (Request $request) {

    dump($request);


    $livre = Livre::find($request->input('id'));
    $livre->categorie_id = $request->input('categorie_id');
    $livre->titre = $request->input('titre');
    $livre->resume = $request->input('resume');
    $livre->prix = $request->input('prix');
    $livre->save();
    

    if($livre->save()==true){
        $message = "Livre modifié";
    }
    
    return view('index', ["message"=>$message]);
});

Route::get('/delete', function (Request $request) {

    $livre = Livre::find($request->input('id'));
    $livre->delete();

    if($livre->delete()){
        $message = "Livre supprimé";
    }
    
    return view('index', ["message"=>$message]);
});

Route::get('/recherche', function (Request $request) {
    $livres = Livre::where('titre','like','%'.$request->input('recherche').'%')->get();

    return view('recherche', ["livres"=>$livres]);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
