<?php

namespace App\View\Components\parts;

use App\Models\Best_product;
use App\Models\Product;
use Illuminate\View\Component;

class clientnavbar extends Component
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
        $newproudcts = Product::with('images')->where('statut', 'Neuf')->limit(4)->get();
        $usedproudcts = Product::with('images')->where('statut', 'Occasion')->limit(4)->get();
        $bestproducts = Best_product::with(['product' => function ($query) {
            return $query->with('images');
        }])->limit(4)->get();
        return view('components.parts.clientnavbar', compact(['newproudcts', 'usedproudcts','bestproducts']));
    }
}
