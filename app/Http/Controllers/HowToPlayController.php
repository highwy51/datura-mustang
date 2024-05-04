<?php


namespace App\Http\Controllers;


use Auth;
use db;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SitePage;


class HowToPlayController extends Controller
{
    public function getHowToPlay()     
    {
    return view('custom.howtoplay');     
    }


    public function getHTP() 
    {
    return view('custom.HTP', [ 
    'page' => SitePage::where('key', 'howtoplay')->first()
        ]);
    }
}
