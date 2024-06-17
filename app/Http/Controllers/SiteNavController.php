<?php


namespace App\Http\Controllers;


use Auth;
use db;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;


class SiteNavController extends Controller
{
    public function getSiteNav()     
    {
    return view('custom.sitenav');     
    }
}
