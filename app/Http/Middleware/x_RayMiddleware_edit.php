<?php

namespace App\Http\Middleware;

use App\Models\Rays\Ray;
use Closure;
use Illuminate\Http\Request;

class x_RayMiddleware_edit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $id=$request->route('id');
        $ray=Ray::find($id);
        if($ray->status==1){
            toastr()->error('هذا الطلب قد تم التعدل عليه');
             return back();
        }
        return $next($request);
    }
}
