<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\TokenMismatchException;

class VerifyCsrfToken extends \Illuminate\Foundation\Http\Middleware\VerifyCsrfToken {


    private $openRoutes = ['login_api','content'];

    public function handle($request, Closure $next)
    {
        if(in_array($request->path(), $this->openRoutes)){
            return $next($request);
        }else{
            return parent::handle($request, $next);
        }
    }
}
