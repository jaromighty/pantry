<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Response;

class SettingsController extends Controller
{
    public function edit(): Response
    {
        return inertia('Settings/Edit', []);
    }
}
