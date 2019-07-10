<?php

function SETTING_VALUE($key = false)
{
    return \App\Model\Setting::where('key', $key)->first()->value;
}





