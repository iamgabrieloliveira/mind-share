<?php

arch('avoid debug statements')
    ->expect([
        'dd',
        'dump',
        'ray',
    ])
    ->not
    ->toBeUsed();

arch('strict types')
    ->expect('App')
    ->toUseStrictTypes();
