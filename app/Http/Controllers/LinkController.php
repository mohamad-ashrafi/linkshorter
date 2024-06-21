<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkRequest;
use App\Models\Link;
use App\Models\User;
use App\Services\FilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function generateCode() :string
    {
        $code = Str::random(5);
        if (Link::where('short_url',$code)->exists()) {
            $this->generateCode();
        }
        return $code;
    }

    public function create(LinkRequest $request)
    {
       try {
            $user = Auth::user();
            $code = $this->generateCode();
            Link::create([
                'user_id' => $user->id,
                'short_url' =>$code,
            ]);
        Redis::set( $code , $request->original_url );
        }catch (\Exception $e){
            return back()->with('error', 'You Have an error.');
        }
        return redirect()->route('dashboard')->with('success', 'This URL has been registered.');
    }

    public function search(Request $request)
    {
        $query = Link::query();
        if ($request->filled('search')) {
            (new FilterService($request , $query))->search($request);
        }
        if ($request->filled('users')) {
            $query->where('user_id', $request->users);
        }
        if ($request->filled('sort')) {
            if ($request->sort == 'most') {
                $query->orderBy('clicks', 'desc');
            } elseif ($request->sort == 'fewest') {
                $query->orderBy('clicks', 'asc');
            }
        }
        $links = $query->with('user')->get();
        $users = User::all();
        return view('dashboard', compact('links', 'users'));
    }

    public function redirect($short_url)
    {
        $url = Redis::get($short_url);
        $link = Link::where('short_url' , $short_url)->firstOrFail();
        $link->incrementClicks();
        return redirect()->away($url);
    }

}
