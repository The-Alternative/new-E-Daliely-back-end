<?php

use Illuminate\Support\Facades\Config;
use \Mcamara\LaravelLocalization\Traits\LoadsTranslatedCachedRoutes;
// use LaravelLocalization;



function get_languages(){
    \App\Models\Language::selectActiveValue()->Selection();
}
// function get_default_languages(){
//     return Config::get('laravellocalization.supportedLocales');
// }
function get_default_languages(){
    return Config::get('app.locale');
}

function uploadImage($folder, $image)
{
    $image->store('/', $folder);
    $filename = $image->hashName();
    $path = 'images/' . $folder . '/' . $filename;
    return $path;
}