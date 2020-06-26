<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HashLink;
use Illuminate\Support\Str;

class HashLinkController extends Controller
{
    public function index()
    {
        $hashLinks = HashLink::latest()->get();
   
        return view('hashedLink', compact('hashLinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
           'link' => 'required|url'
        ]);

        if (HashLink::where('link', '=', $request->link)->exists()) {
        	return redirect('home')
             ->with('warning', 'This link is already available in the system!');
		}
   
        $hashlink['link'] = $request->link;
        
        do
	    {
	        $code = Str::random($length = 6);
	        $duplicate = HashLink::where('code', $code)->get();
	    }
	    while(!$duplicate->isEmpty());

	    $hashlink['code'] = $code;
        $hashlink['counter'] = 0;
   
        HashLink::create($hashlink);
  
        return redirect('home')
             ->with('success', 'Hashed Link Generated Successfully!');
    }

    public function hashedLink($code)
    {
        $hashlink = HashLink::where('code', $code)->first();
   		$hashlink->counter = $hashlink->counter+1;
   		$hashlink->save();
        return redirect($hashlink->link);
    }
}
