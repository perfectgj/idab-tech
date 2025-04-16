<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\SiteView;

class CountSiteViews
{
    public function handle($request, Closure $next)
    {
        if (!session()->has('site_viewed')) {
            $siteView = SiteView::first();

            if (!$siteView) {
                SiteView::create(['views' => 1]);
            } else {
                $siteView->increment('views');
            }

            session(['site_viewed' => true]);
        }

        if (auth()->check()) {
            activity()->causedBy(auth()->user())->log('Viewed site');
        }

        return $next($request);
    }
}
