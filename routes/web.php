<?php

use App\Http\Controllers\AddmemberController;
use App\Http\Controllers\ChampController;
use App\Http\Controllers\HomeController;
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
    Route::get('/add/{team:identifier}/addmember', [AddmemberController::class, 'addMember'])->name('add.addmember');
    Route::patch('/add/{team:identifier}', [AddmemberController::class, 'editUser'])->name('add.edituser');
    Route::get('/edit/{team:identifier}/edit/team', [AddmemberController::class, 'editTeam'])->name('add.editteam');
    Route::patch('/edit/{team:identifier}/edit/team', [AddmemberController::class, 'editTeamed'])->name('add.editteamed');

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

});

// Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function(){
//     // user panel routing
//     Route::get('/panel-user/{user:identifier}/edit', [HomeController::class, 'edit'])->name('user.edit');
//     Route::get('/panel-user/{user:identifier}/editteam', [HomeController::class, 'editTeam'])->name('useredit.team');
//     Route::get('/panel-user/{user:identifier}/editteam/c-level', [HomeController::class, 'editTeamNoClevel'])->name('usereditnoclevel.team');
//     Route::patch('/panel-user/{user:identifier}/editteam/c-level', [HomeController::class, 'editTeamNoCleveled'])->name('usereditnoclevel.update');
//     Route::patch('/panel-user/{user:identifier}/editteam', [HomeController::class, 'editTeamed'])->name('useredit.update');
//     Route::patch('/panel-user/{user:identifier}', [HomeController::class, 'update'])->name('user.update');
//     Route::delete('/panel-user/{user:identifier}', [HomeController::class, 'destroy'])->name('user.destroy');
//     Route::get('/panel-user/{team:identifier}', [TeamController::class, 'showTeam'])->name('show.team');

//     // team panel 
//     Route::get('/make/team', [TeamController::class, 'show'])->name('team.show');
//     Route::post('/make/team', [TeamController::class, 'store'])->name('team.store');
//     Route::delete('/team/{team:identifier}', [TeamController::class, 'destroy'])->name('team.destroy');

//     // add and editted team and member added
//     Route::get('/admin/add/{team:identifier}/addmember', [AddmemberController::class, 'addMember'])->name('add.addmember');
//     Route::patch('/admin/add/{team:identifier}', [AddmemberController::class, 'editUser'])->name('add.edituser');
//     Route::get('/admin/edit/{team:identifier}/edit/team', [AddmemberController::class, 'editTeam'])->name('add.editteam');
//     Route::patch('/admin/edit/{team:identifier}/edit/team', [AddmemberController::class, 'editTeamed'])->name('add.editteamed');

//     // jago dalam sehari 
//     Route::get('/panel-jago-dalam-sehari', [WebinarController::class,'index'])->name('webinar.index');
//     Route::get('/panel-jago-dalam-sehari/buat-webinar', [WebinarController::class,'show'])->name('webinar.show');
//     Route::post('/panel-jago-dalam-sehari/buat-webinar', [WebinarController::class,'store'])->name('webinar.store');
//     Route::get('/panel-jago-dalam-sehari/{webinar:identifier}/edit', [WebinarController::class,'edit'])->name('webinar.edit');
//     Route::patch('/panel-jago-dalam-sehari/{webinar:identifier}', [WebinarController::class,'update'])->name('webinar.update');
//     Route::delete('/panel-jago-dalam-sehari/{webinar:identifier}', [WebinarController::class,'destroy'])->name('webinar.delete');
//     // jago dalam sehari view responded
//     Route::get('/panel-jago-dalam-sehari/responded/{webinar:identifier}', [WebinarController::class,'responded'])->name('webinar.responded');


//     // ajak jago champ
//     Route::get('/panel-jago-champ', [ChampController::class,'index'])->name('champ.index');
//     Route::get('/panel-jago-champ/buat-bootcamps', [ChampController::class,'show'])->name('champ.show');
//     Route::post('/panel-jago-champ/buat-bootcamps', [ChampController::class,'store'])->name('champ.store');
//     Route::get('/panel-jago-champ/buat-bootcamps/{bootcamp:identifier}/edit', [ChampController::class,'edit'])->name('champ.edit');
//     Route::patch('/panel-jago-champ/buat-bootcamps/{bootcamp:identifier}', [ChampController::class,'update'])->name('champ.update');
//     Route::delete('/panel-jago-champ/buat-bootcamps/{bootcamp:identifier}', [ChampController::class,'destroy'])->name('champ.destroy');
//     // jago champ view responded
//     // Route::get('/panel-jago-champ/buat-bootcamps/{bootcamp:identifier}', [ChampController::class,'responded'])->name('champ.responded');




// });








// // Main Page Route
// // Route::get('/', $controller_path . '\dashboard\Analytics@index')->name('dashboard-analytics');

// // layout
// Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
// Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
// Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
// Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
// Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

// // pages
// Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
// Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
// Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
// Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
// Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

// // authentication
// Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
// Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
// Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

// // cards
// Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');

// // User Interface
// Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
// Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
// Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
// Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
// Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
// Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
// Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
// Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
// Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
// Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
// Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
// Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
// Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
// Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
// Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
// Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
// Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
// Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
// Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

// // extended ui
// Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
// Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

// // icons
// Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

// // form elements
// Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
// Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

// // form layouts
// Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');
// Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

// // tables
// Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');

