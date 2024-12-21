<?php

namespace App\Http\Middleware;

use App\Models\Laboratories\Laboratory;
use App\Models\Rays\Ray;
use Closure;
use Illuminate\Http\Request;

class LaboratoryMiddleware_edit
{

    public function handle(Request $request, Closure $next)
    {
        $id=$request->route('id');
        $laboratory=Laboratory::find($id);
        if($laboratory->status==1){
            toastr()->error('هذا الطلب قد تم التعدل عليه');
            return back();
        }
        return $next($request);
    }
}
