<?php

namespace App\Http\Controllers\backend;

use anlutro\LaravelSettings\Facade as Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view-activity-log', ['only' => ['activity']]);
    }


    public function activity(Request $request)
    {
        $activities = Activity::paginate(setting('record_per_page', 15));
        return view('backend.settings.activity', compact('activities'));
    }
}
