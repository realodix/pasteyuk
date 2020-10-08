<?php

namespace App\Http\Controllers;

// use App\Http\Requests;
use App\Models\Paste;
// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function deletePaste($link)
    {
        $userPaste = Paste::where('link', $link)->firstOrFail();

        if ($userPaste->userId != Auth::user()->id) {
            return redirect('/login');
        }

        $userPaste->forceDelete();

        return redirect('/');
    }
}
