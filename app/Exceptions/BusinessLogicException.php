<?php

declare(strict_types=1);

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class BusinessLogicException extends MindShareException
{
    protected $code = Response::HTTP_FORBIDDEN;
}
