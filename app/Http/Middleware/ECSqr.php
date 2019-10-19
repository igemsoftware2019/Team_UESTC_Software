<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Closure;

class ECSqr
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
            'regex'=>'Enter the one-letter Amino Acid Sequence in CAPITAL letters.',
            'min'=>'The sequence should be no less than :min characters.',
        ];
        // 验证逻辑
        $validator = Validator::make($request->all(), [
            'query' => [
                'required',
                'min:41',
				'regex:/^[GAVLIPFYWSTCMNQDEKRH\n\r]+$/x',
            ],
        ],$message)->validate();

        return $next($request);
    }
}
