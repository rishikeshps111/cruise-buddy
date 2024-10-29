<?php

use Illuminate\Support\Facades\Route;

function PageName(bool $uri = false)
{
    if ($uri)
        return request()->path();
    else
        return Route::currentRouteName();
}
