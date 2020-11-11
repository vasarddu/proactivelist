<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function root()
    {
        $items = Item::query()->inRandomOrder()->take(7)->get()->pluck('name')->toArray();
        $items = json_encode($items);

        return view('pages.root', compact('items'));
    }
}
