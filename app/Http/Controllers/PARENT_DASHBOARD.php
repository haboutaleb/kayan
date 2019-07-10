<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PARENT_DASHBOARD extends Controller
{
    public $locale;

    public function __construct()
    {
        $this->locale = app()->getLocale();
    }
}
