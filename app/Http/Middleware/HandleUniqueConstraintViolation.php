<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class HandleUniqueConstraintViolation
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
        try {
            return $next($request);
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) { // Unique constraint violation
                return response()->json([
                    'error' => 'A record with the same unique values already exists.'
                ], 409);
            }
            throw $e; // Re-throw if it's not a unique constraint violation
        }
    }
}
