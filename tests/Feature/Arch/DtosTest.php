<?php

arch('data transfer objects')
    ->expect('App\DataTransferObjects')
    ->toExtendNothing()
    ->toBeReadonly();
