<?php

namespace App\Exceptions;

use App\Helper;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {

    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof UnauthorizedException) {
            return Helper::SendReponse([], 'Unauthorized access', 403);
        }

        if ($e instanceof ModelNotFoundException) {
            return Helper::SendReponse([], 'Data not found', 404);
        }

        if ($e instanceof AuthenticationException) {
            return Helper::SendReponse([], $e->getMessage(), 401);
        }

        if ($e instanceof RouteNotFoundException){
            return Helper::SendReponse([], 'Route not found', 404);
        }

        if ($e instanceof NotFoundHttpException) {
            return Helper::SendReponse([], 'Not found', $e->getStatusCode());
        }

        if ($e instanceof ValidationException) {
            return Helper::SendReponse($e->errors(), $e->getMessage(), $e->status);
        }

        // Catch-all for other exceptions
        return Helper::SendReponse([], $e->getMessage()/*'An unexpected error occurred'*/, 500);
    }



    protected function unauthenticated($request, AuthenticationException $exception): \Illuminate\Http\Response|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        return $request->expectsJson()
            ? response()->json(['message' => 'Unauthenticated.'], 401)
            : redirect()->guest(route('login'));
    }

}
