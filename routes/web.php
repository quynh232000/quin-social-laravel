<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Components\CreateGroup;
use App\Livewire\Components\CreatePage;
use App\Livewire\Components\CreateStory;
use App\Livewire\Group;
use App\Livewire\Groups;
use App\Livewire\Page;
use App\Livewire\Pages;
use App\Livewire\Peoples;

use App\Livewire\Settings;
use App\Livewire\Settings\Account;
use App\Livewire\Settings\AccountSocial;
use App\Livewire\Settings\Address;
use App\Livewire\Settings\Help;
use App\Livewire\Settings\Notification;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\SavePost;
use App\Livewire\SinglePost;
use App\Livewire\VideoPosts;
use Illuminate\Support\Facades\Route;
use App\Livewire\Home;
use App\Livewire\User;



// Route::get('/home', Home::class)->middleware(['auth', 'verified'])->name('dashboard');
// Route::get('/', Home::class)->name('home');
Route::middleware(['auth','verified','verifiedUser'])->group(function () {
// Route::middleware(['verified', 'verifiedUser'])->group(function () {

    Route::get('/', Home::class)->name('home');
    Route::get('/explore', Peoples::class)->name('explore');

    Route::get('/pages', Pages::class)->name('pages');
    Route::get('/page/{uuid}', Page::class)->name('page');
    Route::get('/pages/create', CreatePage::class)->name('create-page');

    Route::get('/groups', Groups::class)->name('groups');
    Route::get('/group/{uuid}', Group::class)->name('group');
    Route::get('/groups/create', CreateGroup::class)->name('create-group');

    // Route::get('/video', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/user/{uuid}', User::class)->name('user');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/post/{useruuid}/{postuuid}', SinglePost::class)->name('single-post');

    Route::get('/stories/create', CreateStory::class)->name('create-story');

    Route::get('/videos', VideoPosts::class)->name('videos');
    Route::prefix('/settings')->group(function () {
        Route::get('/', Settings::class)->name('settings');
        Route::get('/account', Account::class)->name('settings.account');
        Route::get('/address', Address::class)->name('settings.address');
        Route::get('/accountsocial', AccountSocial::class)->name('settings.accountsocial');
        Route::get('/password', Password::class)->name('settings.password');
        Route::get('/notifications', Notification::class)->name('settings.notifications');
        Route::get('/card', Notification::class)->name('settings.card');
        Route::get('/help', Help::class)->name('settings.help');
        Route::get('/save-post', SavePost::class)->name('settings.savepost');

    });




});

require __DIR__ . '/auth.php';
