<?php

use App\Http\Controllers\Controller;

arch('Controllers')
    ->expect('App\Http\Controllers')
    ->toUseStrictTypes()
    ->toHaveSuffix('Controller')
    ->toBeClasses()
    ->not->toBeFinal()
    ->toExtend(Controller::class)
    ->toImplementNothing();
