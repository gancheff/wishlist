<?php

namespace App\Http\Controllers\Wishlist;

use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function create()
    {
        return view('wishlist.search');
    }
}
