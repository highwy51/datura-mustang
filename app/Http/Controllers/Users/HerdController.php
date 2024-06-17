<?php


namespace App\Http\Controllers\Users;

use App\Facades\Settings;
use App\Http\Controllers\Controller;
use App\Models\Character\Character;
use App\Models\Character\CharacterClass;
use App\Models\Character\CharacterTransfer;
use App\Models\User\User;
use App\Services\CharacterManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HerdController extends Controller
{
    public function getHerd($name) {
        // Check if the user is authenticated
        if (Auth::check()) {
            $user = User::where('name', $name)->first();
            $characters = $user->characters->filter(function($character) {
                return !is_null($character->herd);
            });
    
            // Group the characters by the 'herd' attribute
            $groupedCharacters = $characters->groupBy('herd');
    
            return view('user.herds', [
                'user' => $user,
                'characters' => $characters,
                'name' => $name,
                'groupedCharacters' => $groupedCharacters
            ]);
        } 
    }
}