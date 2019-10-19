<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Closure;

class PromoterFile
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
        $validator = Validator::make($request->all(), [
            'file' => [
                'mimes:fasta,txt,csv',
                'required',
            ],
            'species'=>[
                'required',
            ],
        ])->validate();
        
        return $next($request);
    }
}
