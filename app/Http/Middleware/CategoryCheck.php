<?php

namespace App\Http\Middleware;

use Closure;
use App\Category;
use Illuminate\Support\Facades\Session;

class CategoryCheck
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
        // Session::
        if(Category::all()->count() === 0)
        {
            session()->flash('fail','No category found please add.');
            return redirect()->route('categories.create');
        }
        return $next($request);
    }
}
