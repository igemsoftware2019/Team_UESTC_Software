<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Closure;

class PromoterSqr
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
            'regex'=>'Enter the base sequence in "a,t,c,g".',
            'min'=>'The sequence should be no less than :min bases.',
        ];
        // 验证逻辑
        $validator = Validator::make($request->all(), [
            'species'=>[
                'required',
            ],
        ])->validate();

            if (in_array($request->input('species'),['Human','Mouse','Arabis'])){
                $validator = Validator::make($request->all(), [
                'query'=>[
                    'required',
					'regex:/^[agctATCG\n\r]+$/x',
                    'min:251',
                ],
            ],$message)->validate();
    
            }
            else{
                $validator = Validator::make($request->all(), [
                'query'=>[
                    'required',
					'regex:/^[agctATCG\n\r]+$/x',
                    'min:81',
                ],
            ],$message)->validate();
    
            }
		

        return $next($request);
    }
}
