<?php

use Illuminate\Support\Facades\Route;
use Propaganistas\LaravelPhone\PhoneNumber;
use App\Models\TemporaryFile;
use Illuminate\Support\Facades\Storage;


function PageName(bool $uri = false)
{
    if ($uri)
        return request()->path();
    else
        return Route::currentRouteName();
}

function formatDocumentName($document)
{
    // Replace underscores with spaces, capitalize each word, then remove spaces
    return str_replace(' ', ' ', ucwords(str_replace('_', ' ', $document)));
}

function formatPhone($phone)
{

    $formattedPhone = new PhoneNumber($phone);

    return $formattedPhone->formatInternational();
}


function toCamelCase($str)
{
    return str_replace('_', '', ucwords($str, '_'));
}

function clearTemporaryFiles()
{
    $temporaryImages = TemporaryFile::all();

    foreach ($temporaryImages as $temporaryImage) {
        storage::deleteDirectory('images/tmp' . $temporaryImage->folder);
        $temporaryImage->delete();
    }
}
