<?php

namespace App\Exceptions;

use Exception;
use App\Exceptions\ExtractFileException;
use App\Exceptions\OpenFileException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Debugbar;

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
        switch ($exception){
            case ($exception instanceof ExtractFileException):
                return redirect()->back()->with('success', 'Ошибка в архиве!');
                break;
            case ($exception instanceof OpenFileException):
                return redirect()->back()->with('success', 'невозможно открыть архив!');
                break;
            default:
                return parent::render($request, $exception);
        }
    }

    /**
     *
     * @param Exception $exception
     * @return mixed
     */
    protected function renderException(Request $request, Exception $exception){//TODO можно удлаить
        switch ($exception){
            case ($exception instanceof ExtractFileException):
                Debugbar::info("ERROR: ExtractFileException");

                return redirect()->back()->with('success', 'Ошибка в архиве!');
                break;
            case ($exception instanceof OpenFileException):
                Debugbar::info("ERROR: OpenFileException");

                return redirect()->back()->with('success', 'невозможно открыть архив!');
                break;
        }
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
