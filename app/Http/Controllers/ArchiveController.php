<?php

namespace App\Http\Controllers;

use App\Models\Paste;

class ArchiveController extends Controller
{
    public function index()
    {
        $pastes = Paste::where('privacy', '!=', 'link')
                        ->where('privacy', '!=', 'private')
                        ->orderBy('created_at', 'desc')
                        ->paginate(50);

        return view('archive', [
            'pastes' => $pastes,
        ]);
    }

    public function archiveTag($syntax)
    {
        $pastes = Paste::where('syntax', $syntax)
                        ->where('privacy', '!=', 'link')
                        ->where('privacy', '!=', 'private')
                        ->orderBy('created_at', 'desc')
                        ->paginate(50);

        return view('archive-tag', [
            'pastes' => $pastes,
        ]);
    }
}
