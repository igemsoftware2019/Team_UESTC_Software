<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Closure;

class MainSearch
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
            'min'=>'Please enter a comment of at least 3 words.',
            'max'=>'Please enter a comment of no more than 3 words.',
        ];
        $url = $request->session()->get('_previous.url');
        // 验证逻辑
        $validator = Validator::make($request->all(), [
            'keyword' => [
                'required',
                'min:2',
                'max:30',
                'alpha_dash',
            ],
            'type'=>[
                'required',
            ]
        ],$message);

        if ($validator->fails()) {
            return redirect($url)
                        ->withErrors($validator)
                        ->withInput();
        }
        
        return $next($request);
    }
}
