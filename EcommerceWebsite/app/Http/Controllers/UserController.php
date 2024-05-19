<?php

namespace App\Http\Controllers;

use App\Models\Best_product;
use App\Models\Category;
use App\Models\Child_category;
use App\Models\Message;
use App\Models\Pane;
use App\Models\Product;
use App\Models\Statics_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Home()
    {
        $products = Best_product::with(['product' => function ($query) {
             $query->with('images');
             $query->with('pane');
        }])->get()->all();
        return view('welcome', compact('products'));
    }

    public function messagepage()
    {
        return view('user.message');
    }

    public function sendmessage(Request $req)
    {

        $message = Message::create([
            'subject' => $req->Sujet,
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->tele,
            'message' => $req->message,
            'file' => '',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        if ($req->file('file') != null) {
            $file = $req->file('file');
            $imagename = $message->id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/messafefiles/', $imagename);
            Message::where('id', $message->id)->update(['file' => $imagename]);
        }
        return redirect('/message')->with('statut', 'added');
    }


    public function product($id)
    {
        $product = Product::with(['images', 'company', 'colors', 'childcategory' => function ($query) {
            return $query->with('Category');
        }])->where('id', $id)->first();
        $ifalreadyinpane = Pane::where([
            ['client_id', Auth::guard('client')->id()],
            ['product_id', $product->id]
        ])->get()->all();
        $relatedproducts = Product::where('child_category_id', $product->child_category_id)->with(['images'])->limit(8)->get();
        return view('products.product', compact(['product', 'relatedproducts', 'ifalreadyinpane']));
    }

    public function getproductinfo(Request $req)
    {
        $nb = Pane::where('client_id', Auth::guard('client')->id())->get()->all();
        $product = Product::with(['images', 'company', 'colors', 'pane'])->where('id', $req->productid)->first();
       $already=Pane::where([['client_id',Auth::guard('client')->id()],['product_id',$req->productid]])->get()->first();
       $total=0;
       if($already){
           $already=1;
       }else{
           $already=0;
       }
       foreach ($nb as $pane){
           $total+=$pane->quantity*$pane->product->price;
       }
        return array('nb' => $nb, 'product' => $product,'total'=>$total,'already'=>$already);
    }

    /*****Categories******/
    public function categoryproductd($id)
    {
        $products = Product::wherehas('childcategory', function ($query) use ($id) {
            $query->wherehas('Category', function ($q) use ($id) {
                return $q->where('id', $id);
            });
        })->with('images')->get()->all();
        $title = Category::where('id', $id)->first();
        $type = 'categorie';
        $url = $id . '/categorie';
        if ($title) {
            $title = $title->name;
        }
        return view('products.products', compact(['products', 'title', 'type', 'url']));

    }

    public function childCategory($id)
    {
        Statics_category::create(['child_category'=>$id]);
        $products = Product::where('child_category_id', $id)->with('images')->get()->all();
        $title = Child_category::where('id', $id)->first();
        if ($title) {
            $title = $title->name;
        }
        $type = 'childcategorie';
        $url = $id . '/souscategory';
        return view('products.products', compact(['products', 'title', 'type', 'id', 'url']));
    }

    public function bystatutproducts($name)
    {
        $products = Product::where('statut', $name)->with(['images','colors','pane'])->get()->all();
        $title = $name;
        $type = 'statut';
        $url = '1/' . $name;
        return view('products.products', compact(['products', 'title', 'type', 'url']));
    }

    public function meilleures_ventes()
    {
        $products = Product::wherehas('topproducts')->with('images')->get()->all();
        $title = 'Meilleures ventes';
        $type = 'bestproducts';
        $url = '1/meilleures_ventes';
        return view('products.products', compact(['products', 'title', 'type', 'url']));
    }

    public function filterproductbytype(Request $req, $id, $name)
    {
        if ($req->type == 'categorie') {
            if ($req->filtertype == 'atoz') {
                $products = Product::wherehas('childcategory', function ($query) use ($id) {
                    $query->wherehas('Category', function ($q) use ($id) {
                        return $q->where('id', $id);
                    });
                })->orderBy('title', 'asc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'ztoa') {
                $products = Product::wherehas('childcategory', function ($query) use ($id) {
                    $query->wherehas('Category', function ($q) use ($id) {
                        return $q->where('id', $id);
                    });
                })->orderBy('title', 'desc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'croissant') {
                $products = Product::wherehas('childcategory', function ($query) use ($id) {
                    $query->wherehas('Category', function ($q) use ($id) {
                        return $q->where('id', $id);
                    });
                })->orderBy('price', 'asc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'decroissant') {
                $products = Product::wherehas('childcategory', function ($query) use ($id) {
                    $query->wherehas('Category', function ($q) use ($id) {
                        return $q->where('id', $id);
                    });
                })->orderBy('price', 'desc')->with(['images','pane','colors'])->get()->all();
            }
        } else if ($req->type == 'childcategorie') {
            if ($req->filtertype == 'atoz') {
                $products = Product::where('child_category_id', $id)->orderBy('title', 'asc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'ztoa') {
                $products = Product::where('child_category_id', $id)->orderBy('title', 'desc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'croissant') {
                $products = Product::where('child_category_id', $id)->orderBy('price', 'asc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'decroissant') {
                $products = Product::where('child_category_id', $id)->orderBy('price', 'desc')->with(['images','pane','colors'])->get()->all();
            }
        } else if ($req->type == 'statut') {
            if ($req->filtertype == 'atoz') {
                $products = Product::where('statut', $name)->orderBy('title', 'asc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'ztoa') {
                $products = Product::where('statut', $name)->orderBy('title', 'desc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'croissant') {
                $products = Product::where('statut', $name)->orderBy('price', 'asc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'decroissant') {
                $products = Product::where('statut', $name)->orderBy('price', 'desc')->with(['images','pane','colors'])->get()->all();
            }
        } else if ($req->type == 'bestproducts') {
            if ($req->filtertype == 'atoz') {
                $products = Product::wherehas('topproducts')->orderBy('title', 'asc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'ztoa') {
                $products = Product::wherehas('topproducts')->orderBy('title', 'desc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'croissant') {
                $products = Product::wherehas('topproducts')->orderBy('price', 'asc')->with(['images','pane','colors'])->get()->all();
            } else if ($req->filtertype == 'decroissant') {
                $products = Product::wherehas('topproducts')->orderBy('price', 'desc')->with(['images','pane','colors'])->get()->all();
            }
        }

        return $products;
    }

    public function searchsuggestion(Request $req)
    {
        $products = Product::where('title', 'like', '%' . $req->inputdata . '%')->limit(5)->get();
        return $products;
    }

    public function search(Request $req)
    {
        $products = Product::with(['images','pane','colors'])->where('title', 'like', '%' . $req->inputdata . '%')
            ->orwhere('presentation', 'like', '%' . $req->inputdata . '%')
            ->orwherehas('company', function ($q) use ($req) {
                return $q->where('name', 'like', '%' . $req->inputdata . '%');
            })->orwhere('specification', 'like', '%' . $req->inputdata . '%')
            ->orwhere('Technical_sheet', 'like', '%' . $req->inputdata . '%')->limit(5)->get();
        $title = 'resulte de Recherche :' . $req->inputdata;
        $datatype = $req->inputdata;
        return view('products.search', compact(['products', 'title', 'datatype']));
    }

    public function filtersearch(Request $req)
    {
        if ($req->filtertype == 'atoz') {
            $products = Product::with(['images','colors','pane'])->where('title', 'like', '%' . $req->inputdata . '%')
                ->orwhere('presentation', 'like', '%' . $req->inputdata . '%')
                ->orwherehas('company', function ($q) use ($req) {
                    return $q->where('name', 'like', '%' . $req->inputdata . '%');
                })->orwhere('specification', 'like', '%' . $req->inputdata . '%')
                ->orwhere('Technical_sheet', 'like', '%' . $req->inputdata . '%')->orderBy('title', 'asc')->limit(5)->get();
        } else if ($req->filtertype == 'ztoa') {
            $products = Product::with(['images','colors','pane'])->where('title', 'like', '%' . $req->inputdata . '%')
                ->orwhere('presentation', 'like', '%' . $req->inputdata . '%')
                ->orwherehas('company', function ($q) use ($req) {
                    return $q->where('name', 'like', '%' . $req->inputdata . '%');
                })->orwhere('specification', 'like', '%' . $req->inputdata . '%')
                ->orwhere('Technical_sheet', 'like', '%' . $req->inputdata . '%')->orderBy('title', 'desc')->limit(5)->get();
        }
        if ($req->filtertype == 'croissant') {
            $products = Product::with(['images','colors','pane'])->where('title', 'like', '%' . $req->inputdata . '%')
                ->orwhere('presentation', 'like', '%' . $req->inputdata . '%')
                ->orwherehas('company', function ($q) use ($req) {
                    return $q->where('name', 'like', '%' . $req->inputdata . '%');
                })->orwhere('specification', 'like', '%' . $req->inputdata . '%')
                ->orwhere('Technical_sheet', 'like', '%' . $req->inputdata . '%')->orderBy('price', 'asc')->limit(5)->get();
        }
        if ($req->filtertype == 'decroissant') {
            $products = Product::with(['images','colors','pane'])->where('title', 'like', '%' . $req->inputdata . '%')
                ->orwhere('presentation', 'like', '%' . $req->inputdata . '%')
                ->orwherehas('company', function ($q) use ($req) {
                    return $q->where('name', 'like', '%' . $req->inputdata . '%');
                })->orwhere('specification', 'like', '%' . $req->inputdata . '%')
                ->orwhere('Technical_sheet', 'like', '%' . $req->inputdata . '%')->orderBy('price', 'desc')->limit(5)->get();
        }
        return $products;
    }
}
