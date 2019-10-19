<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Closure;

class AfterMatch
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
            'between'=>'Please enter an integer weight value between 1 and 10.',
        ];
        $url = $request->session()->get('_previous.url');
        // 验证逻辑
        $validator = Validator::make($request->all(), [
            'type' => [
                'required',
            ],
            'part_use' => [
                'required',
                'between:1,10',
            ],
            'word_amount' => [
                'required',
                'between:1,10',
            ],
            'reference_amount' => [
                'required',
                'between:1,10',
            ],
            'submit_time' => [
                'required',
                'between:1,10',
            ],
        ],$message);

        if ($validator->fails()) {
            return redirect($url)
                        ->withErrors($validator)
                        ->withInput();
        }
        return $next($request);
    }
}
