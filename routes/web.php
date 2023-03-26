<?php
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');
Route::group(['middleware'=>['auth'] ],function(){
    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get("/posts/removeOld",[PostController::class, "removeOldPosts"]);
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('/posts/{post}', [PostController::class,"update"])->name("posts.update");
    Route::delete('/posts/{post}',[PostController::class,"destroy"])->name("posts.destroy");

});




// Route::resource('posts', PostController::class)->middleware('auth');



Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
});
 

Route::get('/auth/github/callback', function () {
    $githubUser= Socialite::driver('github')->user();

    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);
 
    Auth::login($user);
 
    return redirect('/posts');
 
    // $user->token
});




Route::get('/auth/google/redirect', function () {
    return Socialite::driver('google')->redirect();
});
Route::get('/auth/google/callback', function () {
    $googleUser= Socialite::driver('google')->user();

    $user = User::updateOrCreate([
        'github_id' => $googleUser->id,
    ], [
        'name' => $googleUser->name,
        'email' => $googleUser->email,
        'github_token' => $googleUser->token,
        'github_refresh_token' => $googleUser->refreshToken,
    ]);
 
    Auth::login($user);
 
    return redirect('/posts');
 
    // $user->token
});