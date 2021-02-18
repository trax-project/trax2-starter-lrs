<?php

use Illuminate\Support\Facades\Route;
use Trax\Auth\TraxAuth;
use Trax\Lrs\BasicClients\BasicClientController;

Route::view('/lrs/{any?}', 'trax-front-lrs::app')->where('any', '.*');

TraxAuth::userCrudRoutes('trax/api', 'basic-clients', BasicClientController::class);
