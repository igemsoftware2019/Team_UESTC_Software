<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use Closure;

class WriteComment
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
            'required'=>'Comment cannot be empty.',
            'min'=>'Please enter a comment of at least 15 words.',
            'max'=>'Please enter a comment of no more than 300 words.',
        ];
        // 验证逻辑
        $validator = Validator::make($request->all(), [
            'comment' => [
                'required',
                'min:15',
                'max:300',
            ],
        ],$message)->validate();

        return $next($request);
    }
}
