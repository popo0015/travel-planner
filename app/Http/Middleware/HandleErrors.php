<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HandleErrors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     * inspiration: https://stackoverflow.com/questions/77060556/handle-exceptions-and-fatal-errors-into-laravel-middleware
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (\Throwable $exception) {
            if ($exception->getStatusCode() == 404) {
                return response()->view('errors.404', [], 404);
            }

            if ($exception instanceof \Exception || $exception->getStatusCode() == 500) {
                return response()->view('errors.500', [], 500);
            }

            return parent::render($request, $exception);
        }
    }
}
