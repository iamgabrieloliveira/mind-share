<?php

arch('no requests objects in service layer')
    ->expect('App\Services')
    ->not
    ->toUse('request');
