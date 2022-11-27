<?php

namespace App\Handlers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LfmConfigHandler extends \UniSharp\LaravelFilemanager\Handlers\ConfigHandler
{
    public function userField()
    {
        return Session::get('fileManagerConfig');
    }
}
