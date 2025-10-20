<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class TrackBreadcrumbs
{
    public function handle($request, Closure $next)
    {
        $breadcrumbs = session('breadcrumbs', []);

        $currentUrl = $request->url();
        $currentRouteName = $request->route()->getName();

        // Route name to label mapping
        $routeLabels = [
            'user.home' => 'Home',
            'doctors.by.location' => 'Specializations',
            'doctors.by.location.specialization' => 'Doctors List',
            'doctors.details' => 'Doctors chamber',
            'hospitals.by.location' => 'Hospitals',
        ];

        // Skip breadcrumb logic on home
        if ($currentRouteName === 'user.home') {
            session()->forget('breadcrumbs');
            return $next($request);
        }

        // Prepare label
        $label = $routeLabels[$currentRouteName] ?? ucfirst(str_replace(['.', '-'], ' ', $currentRouteName ?? 'Page'));

        // If Home not in list, add it at beginning
        $homeUrl = route('user.home');
        if (!collect($breadcrumbs)->pluck('url')->contains($homeUrl)) {
            $breadcrumbs[] = [
                'label' => 'Home',
                'url' => $homeUrl,
            ];
        }

        // ✅ Remove duplicates based on label
        $exists = collect($breadcrumbs)->pluck('label')->contains($label);
        if (!$exists) {
            $breadcrumbs[] = [
                'label' => $label,
                'url' => $currentUrl,
            ];
        }

        // Limit to last 4 items
        $breadcrumbs = array_slice($breadcrumbs, -4);

        session(['breadcrumbs' => $breadcrumbs]);

        return $next($request);
    }



}

