<?php

namespace App\Http\Controllers\Wishlist;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class MyController extends Controller
{
    public function create()
    {
        $user = Auth::user();

        $wishlist = $user->wishlist;

        return view('wishlist.my', [
            'items' => $wishlist,
        ]);
    }

    public function remove()
    {
        $user = Auth::user();

        $id = request()->get('id');

        $item = Wishlist::where('id', $id)->where('user_id', $user->id)->first();

        if ($item) {
            $item->delete();
            return redirect()->back()->with('success', 'Item deleted from your wishlist.');
        }

        return redirect()->back()->with('error', 'Item not found or you do not have permission to delete it.');
    }
}
