<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Closure;

class BlastResult
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $message = [
            'regex'=>'Please enter a sequence of four bases and newline characters that must be a, t, c, g.',
        ];
        $validator = Validator::make($request->all(), [
            'query'=>[
                'required',
                'min:10',
                'max:10000',
                'regex:/^[agct\n\r]+$/x',
            ],
        ],$message)->validate();
        return $next($request);
    }
}
