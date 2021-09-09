<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Validation\ValidationException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (ModelNotFoundException $e, $request) {
            return response()->json([
                'message' => '404 not found'
            ], 404);
        });

        $this->renderable(function (MethodNotAllowedHttpException $e, $request) {
            return response(null, 404);
        });

        $this->renderable(function (NotFoundHttpException $e, $request) {
            return response(null, 404);
        });

        $this->renderable(function (QueryException $e, $request) {
            if ($e->getCode() == "23503") {
                return response("Không thể xóa, dữ liệu đang có thành phần phụ thuộc", 409);
            }
            return response(null, 409);
        });
    }

    public function render($request, Throwable $exception)
    {
        // Force to application/json rendering on API calls
        if ($request->is('api*')) {
            // set Accept request header to application/json
            $request->headers->set('Accept', 'application/json');
        }

        return parent::render($request, $exception);
    }
}
