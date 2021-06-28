<?php

use Illuminate\Support\Facades\Route;
use Trax\Auth\TraxRouting;
use Trax\Lrs\BasicClients\BasicClientController;

Route::view('/lrs/{any?}', 'trax-front-lrs::app')->where('any', '.*')->middleware('web');

TraxRouting::userCrudRoutes('trax/api', 'basic-clients', BasicClientController::class);
