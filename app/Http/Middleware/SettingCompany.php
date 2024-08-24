<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\company;
use App\Models\vouchers;
use App\Models\categories;

class SettingCompany
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
        $company = company::find(1);
        $categories = categories::all();
        $voucher = vouchers::where('berlaku_sampai', '<=', date('Y-m-d H:i:s'))->get();
        view()->share('companyMiddleware', $company);
        view()->share('voucherMiddleware', $voucher);
        view()->share('categoriesMiddleware', $categories);
        return $next($request);
    }
}
