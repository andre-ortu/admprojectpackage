<?php

namespace AndreaOrtu\AdmProject\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    public function register()
    {
        $this->renderable(function (Throwable $e) {
            if ($e instanceof NotFoundHttpException) {
                return response()->json([
                    'error' => 'People Not Found'
                ], 404);
            }

            if(! App::environment('production')) {
                return response()->json([
                    'error' => $e->getMessage(),
                    'line' => $e->getLine(),
                    'file' => $e->getFile(),
                    'code' => $e->getCode()
                ], 500);
            }

            return response()->json([
                'error' => 'Something Went Wrong',
            ], 500);

        });

    }
}
