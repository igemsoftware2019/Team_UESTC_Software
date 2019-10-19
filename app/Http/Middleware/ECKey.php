<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Closure;

class ECKey
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
            'exists'=>'The key of your input does not exist in our database. Please confirm that you have made the correct prediction.',
        ];
        // 验证逻辑
        $validator = Validator::make($request->all(), [
            'key' => [
                'exists:ec_result,key',
            ],
        ],$message)->validate();
        return $next($request);
    }
}
