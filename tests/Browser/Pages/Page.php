<?php

namespace Tests\Browser\Pages;

use Laravel\Dusk\Page as BasePage;

abstract class Page extends BasePage
{
    /**
     * Get the global elements shortcuts for the site.
     *
     * @return array
     */
    public static function siteElements()
    {
        return [
            '@elements' => '#selector',
        ];
    }
}
