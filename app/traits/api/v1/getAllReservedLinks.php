<?php

namespace App\traits\api\v1;

use App\Models\api\v1\DigitalMenu\DigitalMenu;
use App\Models\Profile;
use App\Models\UrlRedirector;
use Route;

trait getAllReservedLinks
{
    public $reservedLink;
    public $profileUrl;

    public function getAllReservedLinks() {
        $routes = Route::getRoutes()
                       ->getRoutes();

        $nr  = [];
        $nr2 = [];

        foreach ($routes as $route) {
            $nr[] = explode('/', $route->uri);
        }
        foreach ($nr as $item) {
            foreach ($item as $i) {
                $nr2[] = $i;
            }
        }

        $nr2 = array_unique($nr2);
        $nr2 = array_filter($nr2);


        $reservedProfiles = Profile::query()
                                   ->get()
                                   ->pluck('link');
        foreach ($reservedProfiles as $reservedProfile) {
            array_push($nr2, $reservedProfile);
        }

        $reservedProfiles = DigitalMenu::query()
                                       ->get()
                                       ->pluck('link');
        foreach ($reservedProfiles as $reservedProfile) {
            array_push($nr2, $reservedProfile);
        }

        $reservedProfiles = UrlRedirector::query()
                                         ->get()
                                         ->pluck('url');
        foreach ($reservedProfiles as $reservedProfile) {
            array_push($nr2, $reservedProfile);
        }
        $this->reservedLink = array_search($this->profileUrl, $nr2);

        $nr2 = array_values($nr2);
        return response()->json($nr2);
    }
}
