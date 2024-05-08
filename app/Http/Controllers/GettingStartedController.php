<?php


namespace App\Http\Controllers;


use Auth;
use db;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;


class GettingStartedController extends Controller
{
    public function getGettingStarted()     
    {
    return view('custom.gettingstarted');     
    }


    public function getGettingStartedAdmin() 
    {
    return view('custom.gettingstartedadmin', [ 
    'page' => SitePage::where('key', 'gettingstarted')->first()
        ]);
    }
}
