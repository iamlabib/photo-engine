<?php

use Labib\PhotoEngine\PhotoEngineController;

Route::get('photo-engine', [PhotoEngineController::class, 'index']);
Route::get('photo-engine/placeholder/{width}/{height}/{text?}', [PhotoEngineController::class, 'placeholder'])->where(['text'=> '[a-z]+']);
Route::get('photo-engine/render/{quality}', [PhotoEngineController::class, 'render']);