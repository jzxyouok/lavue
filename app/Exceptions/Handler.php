<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Session\TokenMismatchException::class,
        \Illuminate\Validation\ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        ob_clean();
        if ($request->is('admin/*')) {
            if ($exception instanceof AuthenticationException) {
                if ($request->expectsJson()) {
                    return failJson('请重新登录', 401);
                } else {
                    return redirect('/admin');
                }
            } elseif ($exception instanceof NotFoundHttpException) {
                if ($request->expectsJson()) {
                    return failJson('Page not found.', 404);
                } else {
                    exit(view('admin.404'));
                }
            } else {
                if ($request->expectsJson()) {
                    return failJson($exception->getMessage(), 500);
                } else {
                    exit(view('admin.500'));
                }
            }
        } else {
            if ($exception instanceof NotFoundHttpException) {
                if ($request->expectsJson()) {
                    return failJson('Page not found.', 404);
                } else {
                    exit(view('404'));
                }
            }
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
