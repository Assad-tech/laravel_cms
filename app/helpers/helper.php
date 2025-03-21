<?php

use Illuminate\Support\Facades\Cache;
use App\Models\SiteContent;
use App\Models\SocialLink;

if (!function_exists('getSiteContent')) {
    /**
     * Fetch site content from the SiteContent table.
     *
     * @return mixed
     */
    function getSiteContent($column)
    {
        return SiteContent::select($column)->first();
    }
}

if (!function_exists('getSocialLinks')) {
    /**
     * Fetch social links from the SocialLinks table.
     *
     * @return mixed
     */
    function getSocialLinks($column)
    {

        return SocialLink::select($column)->first();
    }
}
