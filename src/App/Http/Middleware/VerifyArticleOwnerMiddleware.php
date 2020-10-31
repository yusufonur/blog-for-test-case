<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyArticleOwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $article = $request->route("article");
        $user = Auth::user();

        if ($user->hasRole(config("role.admin"))) {
            return $next($request);
        }

        if ($article->writer_id == $user->id) {
            return $next($request);
        }

        abort(401, __("Yetkisiz işlem yapmaya çalıştınız."));
    }
}
