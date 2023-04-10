<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class LinkController extends Controller
{
    public function create(Request $request) {
        $data = $request->validate(['url' => 'required|string|url|max:255']);

        $short = $this->makeShortUrl();
        if(Link::where('url', $data['url'])->get()->first()) {
            Link::where('url', $data['url'])->update([
                'short_url'  => $short
            ]);
        }else {
            $link = new Link();
            $link->url = $data['url'];
            $link->short_url = $short;
            $link->save();
        }

        $domain = $_SERVER['HTTP_HOST'];

        $newUrl = "http://" . $domain . '/' . $short;
        return response()->json(['new_url' => $newUrl]);
    }

    public function makeShortUrl() {

        return Str::random(5);

    }

    public function redirect($shortUrl) {
        $link = Link::where('short_url', $shortUrl)->firstOrFail();

        return redirect($link->url);


    }
}
