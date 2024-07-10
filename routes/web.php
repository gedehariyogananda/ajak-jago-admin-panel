<?php

use App\Http\Controllers\AddmemberController;
use App\Http\Controllers\Api\BootcampController;
use App\Http\Controllers\ChampController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WebinarController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// route laravel ui
Auth::routes();
    
//default redirect
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){

    // add and editted team and member added
    Route::get('/add/{user:identifier}/addmember', [AddmemberController::class, 'addMember'])->name('add.addmember');
    Route::patch('/add/{user:identifier}', [AddmemberController::class, 'editUser'])->name('add.edituser');
    Route::get('/edit/{team:identifier}/edit/team', [AddmemberController::class, 'editTeam'])->name('add.editteam');
    Route::patch('/edit/{team:identifier}/edit/team', [AddmemberController::class, 'editTeamed'])->name('add.editteamed');

    //delete all tim in user
    Route::patch('/reset/team/in/user', [AddmemberController::class, 'resetTeam'])->name('reset');


    // user panel routing
    Route::prefix('panel-user')->group(function(){
        Route::get('/{user:identifier}/edit', [HomeController::class, 'edit'])->name('user.edit');
        Route::get('/{user:identifier}/editteam', [HomeController::class, 'editTeam'])->name('useredit.team');
        Route::get('/{user:identifier}/editteam/c-level', [HomeController::class, 'editTeamNoClevel'])->name('usereditnoclevel.team');
        Route::patch('/{user:identifier}/editteam/c-level', [HomeController::class, 'editTeamNoCleveled'])->name('usereditnoclevel.update');
        Route::patch('/{user:identifier}/editteam', [HomeController::class, 'editTeamed'])->name('useredit.update');
        Route::patch('/{user:identifier}', [HomeController::class, 'update'])->name('user.update');
        Route::delete('/{user:identifier}', [HomeController::class, 'destroy'])->name('user.destroy');
        Route::get('/{team:identifier}', [TeamController::class, 'showTeam'])->name('show.team');
    });

    // team panel 
    Route::prefix('make')->group(function(){
        Route::get('/team', [TeamController::class, 'show'])->name('team.show');
        Route::post('/team', [TeamController::class, 'store'])->name('team.store');
        Route::delete('/team/{team:identifier}', [TeamController::class, 'destroy'])->name('team.destroy');    
    });


    // jago dalam sehari 
    Route::prefix('panel-jago-dalam-sehari')->group(function(){
        Route::get('/', [WebinarController::class,'index'])->name('webinar.index');
        Route::get('/buat-webinar', [WebinarController::class,'show'])->name('webinar.show');
        Route::post('/buat-webinar', [WebinarController::class,'store'])->name('webinar.store');
        Route::get('/{webinar:identifier}/edit', [WebinarController::class,'edit'])->name('webinar.edit');
        Route::patch('/{webinar:identifier}', [WebinarController::class,'update'])->name('webinar.update');
        Route::delete('/{webinar:identifier}', [WebinarController::class,'destroy'])->name('webinar.delete');
        // jago dalam sehari view responded
        Route::get('/responded/{webinar:identifier}', [WebinarController::class,'responded'])->name('webinar.responded');
        //route donwload
        Route::post('download/file/{parameter1}/{parameter2}/download', [WebinarController::class,'downloader'])->name('webinar.download');
        Route::post('download/file/{parameter1}/{parameter2}', [WebinarController::class,'downloaderBukti'])->name('webinar.downloadBukti');
    });
   
    // ajak jago champ
    Route::prefix('panel-jago-champ')->group(function(){
        Route::get('/', [ChampController::class,'index'])->name('champ.index');
        Route::get('/buat-bootcamps', [ChampController::class,'show'])->name('champ.show');
        Route::post('/buat-bootcamps', [ChampController::class,'store'])->name('champ.store');
        Route::get('/buat-bootcamps/{bootcamp:identifier}/edit', [ChampController::class,'edit'])->name('champ.edit');
        Route::patch('/buat-bootcamps/{bootcamp:identifier}', [ChampController::class,'update'])->name('champ.update');
        Route::delete('/buat-bootcamps/{bootcamp:identifier}', [ChampController::class,'destroy'])->name('champ.destroy');
        // jago champ view responded
        Route::get('/responded/{bootcamp:identifier}', [ChampController::class,'responded'])->name('champ.responded');
        // route donwload
        Route::post('download/file/{parameter1}/{parameter2}/download', [ChampController::class,'downloader'])->name('champ.download');
        Route::post('download/file/{parameter1}/{parameter2}', [ChampController::class,'downloaderBukti'])->name('champ.downloadBukti');
        Route::post('download/file/{parameter1}/{parameter2}/cv', [ChampController::class,'downloaderCv'])->name('champ.downloadCv');
    }); 

    Route::get('/search/team', [SearchController::class, 'searchTeam'])->name('searchTeam');
    Route::get('/search/user', [SearchController::class, 'searchUser'])->name('searchUser');
    Route::get('/search/webinar', [SearchController::class, 'searchWebinar'])->name('searchWebinar');
    Route::get('/search/bootcamp', [SearchController::class, 'searchBootcamp'])->name('searchBootcamp');
    // Route::get('/search/users/add/team', [SearchController::class, 'searchUserToAddTeam'])->name('searchBootcamps');

    // export excel 
    Route::get('export/user/{webinar:identifier}/webinar', [WebinarController::class, 'export'])->name('exportWebinar');

    Route::get('export/user/{bootcamp:identifier}/bootcamp', [ChampController::class, 'exportBootcamp'])->name('exportBootcamp');

    
});
