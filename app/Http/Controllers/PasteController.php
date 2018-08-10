<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Paste;
use App\PastesSyntax;
use App\User;
use Carbon\Carbon;
use Hashids\Hashids;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;

class PasteController extends Controller
{
    protected $watchTime = 10;
    protected $expWatchTime = 3;

    public function submit(Requests\StorePaste $request)
    {
        $title = (empty(trim(Input::get('pasteTitle')))) ? 'Untitled' : Input::get('pasteTitle');

        $expiration = Input::get('expire');
        $privacy = Input::get('privacy');

        // Jika user memilih ingin dilindungi dengan password, password akan disimpan, jika tidak akan ditandai 'disabled'
        if ($privacy == 'password') {
            $password = Hash::make(Input::get('pastePassword'));
        } else {
            $password = 'disabled';
        }

        $burnAfter = 0;
        // Menghasilkan timestamp kedaluwarsa
        switch ($expiration) {
            case 'never':
                $timestampExp = 0;
                break;
            case 'burn':
                $timestampExp = date('Y-m-d H:i:s', time());
                $burnAfter = 1;
                break;
            case '10m':
                $timestampExp = date('Y-m-d H:i:s', time() + (60 * 10));
                break;
            case '1h':
                $timestampExp = date('Y-m-d H:i:s', time() + (60 * 60));
                break;
            case '1d':
                $timestampExp = date('Y-m-d H:i:s', time() + (60 * 60 * 24));
                break;
            case '1w':
                $timestampExp = date('Y-m-d H:i:s', time() + (60 * 60 * 24 * 7));
                break;
            default:
                die('User input error.');
                break;
        }

        // URL dibuat dari id paste, lalu digenerate ke dalam 6 (huruf kecil & angka)
        // https://github.com/ivanakimov/hashids.php
        $hashids = new Hashids('', 6);
        $paste_id = Paste::latest()->first();
        $generatedLink = empty($paste_id) ? $hashids->encode(1) : $hashids->encode($paste_id->id + 1);

        Paste::create([
            'userId'     => (Auth::check()) ? Auth::id() : 0,
            'title'      => $title,
            'content'    => Input::get('pasteContent'),
            'link'       => $generatedLink,
            'views'      => '0',
            'ip'         => $request->ip(),
            'syntax'     => Input::get('syntaxhighlighting'),
            'expiration' => $timestampExp,
            'privacy'    => $privacy,
            'password'   => $password,
            'burnAfter'  => $burnAfter,
        ]);

        return redirect('/'.$generatedLink);
    }

    public function view($link, Request $request)
    {
        $paste = Paste::where('link', 'LIKE BINARY', $link)->firstOrFail();

        // Apakah user yang terhubung adalah orang yang membuat post paste?
        $isSameUser = ((Auth::user() == $paste->user && $paste->userId != 0)) ? true : false;

        $expTime = $paste->expiration;
        $diffTimeCreated = time() - $paste->created_at->timestamp;
        $diffTimeUpdated = time() - $paste->updated_at->timestamp;

        // Paste kadaluarsa
        if ($expTime != 0) {
            if ($paste->burnAfter == 0) {
                if (time() > strtotime($expTime)) {
                    if ($isSameUser) {
                        $expiration = 'Expired';
                    } else {
                        abort('404');
                    }
                } else {
                    $expiration = Carbon::parse($expTime)->diffForHumans();
                }
            } else {
                // Peringatan burn after reading
                if (time() - strtotime($expTime) > $this->expWatchTime) {
                    $disableBurn = true;
                    $expiration = 'Burn after reading';
                } else {
                    $expiration = 'Burn after reading (next time)';
                }
            }
        } else {
            $expiration = 'Never';
        }

        // Mengurus opsi privasi paste (TODO password)
        // https://stackoverflow.com/questions/30212390/laravel-middleware-return-variable-to-controller
        if ($paste->privacy == 'private') {
            if ($isSameUser) {
                $privacy = 'Private';
            } else {
                abort('404');
            }
        } elseif ($paste->privacy == 'password') {
            // Tulisan status paste
            $privacy = 'password-protected';

            if ($request->isMethod('post')) {
                if (!Hash::check(Input::get('pastePassword'), $paste->password)) {
                    return view('paste/password', [
                        'title'         => $paste->title,
                        'link'          => url()->current(),
                        'wrongPassword' => true,
                    ]);
                }
                // Jika pengguna tidak sama dan paste dibuat lebih dari 3 detik yang lalu:
            } elseif (!$isSameUser && $diffTimeCreated > $this->expWatchTime) {
                return view('paste/password', [
                    'title' => $paste->title,
                    'link'  => url()->current(),
                ]);
            }
        } elseif ($paste->privacy == 0 || $paste->privacy == 'link') {
            $privacy = 'Public';
        }

        // Memeriksa apakah burnAfter harus dihapus (dilakukan setelah pemeriksaan password)
        if (isset($disableBurn)) {
            $paste->burnAfter = 0;
            $paste->save();
        }

        // Menambah angka view
        if ($diffTimeUpdated > $this->watchTime) {
            $paste->increment('views');
        }

        // Return view
        return view('paste/view', [
            'title'        => $paste->title,
            'content'      => $paste->content,
            'link'         => $link,
            'views'        => $paste->views,
            'syntax'       => $paste->pasteSyntax->syntax_name,
            'expiration'   => $expiration,
            'privacy'      => $privacy,
            'username'     => ($paste->userId != 0) ? $paste->user->username : 'Guest',
            'sameUser'     => $isSameUser,
            'date'         => $paste->created_at->format('M jS, Y'),
            'fulldate'     => $paste->created_at->format('d/m/Y - H:i:s'),
            'getPasteSize' => round(strlen($paste->content) / 1024, 2),
        ]);
    }

    public function raw($link, Request $request)
    {
        header('Content-Type: text/plain');
        $paste = Paste::where('link', 'LIKE BINARY', $link)->firstOrFail();

        // Apakah user yang terhubung adalah orang yang menulis paste?
        $isSameUser = ((Auth::user() == $paste->user && $paste->userId != 0)) ? true : false;

        $expTime = $paste->expiration;
        $diffTimeCreated = time() - $paste->created_at->timestamp;
        $diffTimeUpdated = time() - $paste->updated_at->timestamp;

        if ($expTime != 0) {
            if ($paste->burnAfter == 0) {
                if (time() > strtotime($expTime)) {
                    if ($isSameUser) {
                        $expiration = 'Expired';
                    } else {
                        abort('404');
                    }
                } else {
                    $expiration = Carbon::parse($expTime)->diffForHumans();
                }
            }
        }

        if ($paste->privacy == 'private') {
            if ($isSameUser) {
                $privacy = 'Private';
            } else {
                abort('404');
            }
        } elseif ($paste->privacy == 'password') {
            if ($request->isMethod('post')) {
                if (!Hash::check(Input::get('pastePassword'), $paste->password)) {
                    return view('paste/password', [
                        'title'         => $paste->title,
                        'link'          => url()->current(),
                        'wrongPassword' => true,
                    ]);
                }

                // Jika pengguna tidak sama dan paste dibuat lebih dari 3 detik yang lalu:
            } elseif (!$isSameUser && $diffTimeCreated > $this->expWatchTime) {
                return view('paste/password', [
                    'title' => $paste->title,
                    'link'  => url()->current(),
                ]);
            }
        } elseif ($paste->privacy == 0 || $paste->privacy == 'link') {
            $privacy = 'Public';
        }

        // Memeriksa apakah burnAfter harus dihapus (dilakukan setelah pemeriksaan password)
        if (isset($disableBurn)) {
            $paste->burnAfter = 0;
            $paste->save();
        }

        // Menambah angka view
        if ($diffTimeUpdated > $this->watchTime) {
            $paste->increment('views');
        }

        return response($paste->content, 200)
                ->header('Content-Type', 'text/plain');
    }

    public function download($link, Request $request)
    {
        $paste = Paste::where('link', 'LIKE BINARY', $link)->firstOrFail();

        $isSameUser = ((Auth::user() == $paste->user && $paste->userId != 0)) ? true : false;
        $diffTimeCreated = time() - $paste->created_at->timestamp;

        if ($paste->privacy == 'password') {
            if ($request->isMethod('post')) {
                if (!Hash::check(Input::get('pastePassword'), $paste->password)) {
                    return view('paste/password', [
                        'title'         => $paste->title,
                        'link'          => url()->current(),
                        'wrongPassword' => true,
                    ]);
                }

                // Jika pengguna tidak sama dan paste dibuat lebih dari 3 detik yang lalu:
            } elseif (!$isSameUser && $diffTimeCreated > $this->expWatchTime) {
                return view('paste/password', [
                    'title' => $paste->title,
                    'link'  => url()->current(),
                ]);
            }
        }

        return response($paste->content, 200)
                ->header('Content-Type', 'text/plain')
                ->header('Content-disposition', 'attachment; filename="'.$paste->title.'.txt"');
    }

    public function syntaxDropdownList()
    {
        $pastes = PastesSyntax::all();

        // Text di database bernilai 0, tidak ditampilkan pada dropdown (karena sudah ada di value)
        $pastes->forget(0);

        return view('welcome', [
            'pastes' => $pastes,
        ]);
    }

    // public function password($link, Request $request)
    // {
    //     $paste = Paste::where('link', $link)->firstOrFail();
    //
    //     $messages = array(
    //         'pastePassword.required' => 'Please enter a password',
    //     );
    //
    //     $this->validate($request, [
    //         'pastePassword' => 'required',
    //     ], $messages);
    //
    //     if (Hash::check(Input::get('pastePassword'), $paste->password)) {
    //         Cookie::queue($paste->link, Input::get('pastePassword'), 15);
    //         return redirect('/'.$link);
    //     } else {
    //         return view('paste/password', [
    //             'title' => $paste->title,
    //             'link' => url()->current(),
    //             'wrongPassword' => true
    //         ]);
    //     }
    // }
}
