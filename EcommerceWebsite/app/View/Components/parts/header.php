<?php

namespace App\View\Components\parts;

use App\Models\Pane;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $categories = \App\Models\Category::with('child_categories')->get()->all();
        $nbpane = count(Pane::where('client_id', Auth::guard('client')->id())->get()->all());


        $nb = Pane::where('client_id', Auth::guard('client')->id())->get()->all();
        $total=0;
        foreach ($nb as $pane){
            $total+=$pane->quantity*$pane->product->price;
        }
        return view('components.parts.header', compact(['categories','nbpane','total']));
    }
}
