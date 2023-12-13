<?php

uses()->group(
    'arch',
);

test('globals')
    ->expect(['dd', 'dump'])
    ->not
    ->toBeUsed();

test('strict types')
    ->expect('App')
    ->toUseStrictTypes();

test('data transfer objects')
    ->expect('App\DataTransferObjects')
    ->toExtendNothing()
    ->toBeReadonly();

test('no requests objects in service layer')
    ->expect('App\Services')
    ->not
    ->toUse('request');
