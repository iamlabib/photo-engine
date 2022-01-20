<?php

use Labib\PhotoEngine\PhotoEngineController;

Route::get('photo-engine', [PhotoEngineController::class, 'index']);