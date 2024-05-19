<?php

namespace App\Http\Controllers;

use App\Models\Best_product;
use App\Models\Category;
use App\Models\Child_category;
use App\Models\Client;
use App\Models\Color;
use App\Models\Commande;
use App\Models\Commandeitem;
use App\Models\Company;
use App\Models\Message;
use App\Models\Product;
use App\Models\Products_image;
use App\Models\Statics_category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Psy\Util\Json;
use Symfony\Component\VarDumper\Cloner\Data;
use Yajra\Datatables\Datatables;


class AdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware(['auth']);
    }

    public function dashboard()
    {
//        return User::groupBy('created_at')->get();
        $categories = Statics_category::with('category')->select('child_category')
            ->selectRaw('count(id) as nb')->groupBy('child_category')->get();
        $categories = Child_category::with(['statics' => function ($q) {
            return $q->select('child_category')->selectRaw('count(id) as nb')->groupBy('child_category')->get();
        }])->get();
        $users = User::select(DB::raw('DATE_FORMAT(created_at, "%d %b %Y") as created_at2'))
            ->selectRaw('count(id) as nb ')->groupBy('created_at2')->get();

         $products=Commandeitem::with(['product'=>function($q){
            $q->select('title','id');
        }])->select(DB::raw('count(*) as nb,product_id'))->groupBy('product_id')->get();

        return view('admin.admin.dashboard', compact('categories', 'users','products'));

    }

    /**commandes**/
    public function commades()
    {
        return view('admin.commandes.commandes');
    }

    public function ajaxcommades()
    {
        $commendes = Commande::with('client')->orderBy('id', 'desc')->get()->all();
        return Datatables::of($commendes)->editColumn('created_at', function ($q) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $q->created_at)->format('d M Y');
        })->editColumn('total', function ($q) {
            return $q->total . ' Dh';
        })->addColumn('statut2', function ($commende) {
            $html = '';
            $html .= '<select class="form-select commandestatut" commandeid="' . $commende->id . '"
                                                            style="font-size: 14px;border-radius: 0">
                                                        <option value="En confirmation"';
            if ($commende->statut == 'En confirmation') {
                $html .= 'selected="selected"';
            }
            $html .= '>En confirmation</option> <option value="En livraison"';
            if ($commende->statut == 'En livraison') {
                $html .= 'selected = "selected"';
            }
            $html .= '>En livraison</option><option value="Livré"';
            if ($commende->statut == 'Livré') {
                $html .= 'selected = "selected"';
            }
            $html .= '>Livré</option></select>';
            return $html;

        })->addColumn('products', function ($user) {
            return url('eloquent/details-data/' . $user->id);
        })->rawColumns(['statut2'])->make(true);

    }

    public function getDetailsajaxcommades($id)
    {

//        $commandes = Commandeitem::find($id);
        $commandes = Commandeitem::with(['color', 'product' => function ($q) {
            $q->with(['childcategory', 'company', 'images']);
        }])->where('commade_id', $id)->
        get();

        return Datatables::of($commandes)
            ->addColumn('images', function ($q) {
                $images = '';
                foreach ($q->product->images as $key => $image) {
                    if ($key == 1 || $key == 2) {
                        $images .= '<img src="' . asset('storage/products/' . $image->name) . '" class="img-fluid" style="width:200px"/>';
                    }
                }
                return $images;
            })->addColumn('panecolor', function ($q) {
                if (isset($q->color->name)) {
                    $color = '';
                    $color .= '<div class="me-1" style="border-radius:100px;height: 25px;width: 25px;background-color:' . $q->color->name . ';"></div>';
                    return $color;
                } else {
                    return '';
                }

            })
            ->editColumn('pane.product.price', function ($q) {
                return $q->product->price . ' Dh';
            })->rawColumns(['images', 'panecolor'])
            ->make(true);
    }

    public function updatecommandestatut(Request $req)
    {
        Commande::where('id', $req->commande_id)->update([
            'statut' => $req->value
        ]);
    }

    /********category*******/
    public function categories()
    {
        return view('admin.categories.categories');
    }

    public function ajaxcategories()
    {
        $categories = Category::get();
        return Datatables::of($categories)->editColumn('created_at', function ($q) {
            return $q->created_at->format('d M Y');
        })->addColumn('action', function ($q) {
            return '<p class="btn btn-danger delete" categoriid="' . $q->id . '" style="border-radius: 0">Supprimer</p>';
        })->make();
    }

    public function addcategorypage()
    {
        return view('admin.categories.add');
    }

    public function addcategory(Request $req)
    {
        Category::create([
            'name' => $req->name,
            'created_at' => date('Y-m-d h:i:s')
        ]);
        $statut = 'good';
        return redirect('/admin/categories')->with('statut', 'added');
    }

    public function deletecategory(Request $req)
    {
        Category::where('id', $req->categoryid)->delete();
        return redirect('/admin/categories')->with('statut', 'deleted');
    }

    /********child category*******/

    public function souscategories()
    {
        return view('admin.sousCategories.categories');
    }

    public function ajaxsouscategories()
    {
        $childcategories = Child_category::with('Category')->get()->all();
        return Datatables::of($childcategories)->editColumn('created_at', function ($q) {
            return $q->created_at->format('d M Y');
        })->addColumn('category', function ($q) {
            return $q->Category->name;
        })->addColumn('action', function ($q) {
            return '<p class="btn btn-danger delete" childcategoriid="' . $q->id . '" style="border-radius: 0">Supprimer</p>';
        })->make();

    }

    public function addsouscategoriespage()
    {
        $categories = Category::get()->all();
        return view('admin.sousCategories.add', compact('categories'));
    }

    public function addsouscategories(Request $req)
    {
        Child_category::create([
            'name' => $req->name,
            'category_id' => $req->category,
            'created_at' => date('Y-m-d h:i:s')
        ]);
        $statut = 'good';
        return redirect('/admin/souscategories')->with('statut', 'added');
    }

    public function deletesouscategories(Request $req)
    {
        Child_category::where('id', $req->childcategoriid)->delete();
        return redirect('/admin/souscategories')->with('statut', 'deleted');
    }

    /********message*******/

    public function messages()
    {
        return view('admin.message.messages');
    }

    public function ajaxmessages()
    {
        $messages = Message::get();
        return Datatables::of($messages)->editColumn('created_at', function ($q) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $q->created_at)->format('d M Y');
        })->addColumn('downloadfile', function ($message) {
            return '<form method="post" action="' . url('admin/downlaodmessagefile') . '"> <input type="hidden" name="_token" value="' . csrf_token() . '"><input type="hidden" name="messagefileid" value="' . $message->file . '"/><button style="background-color: transparent;border: none"><img style="height:30px;cursor:pointer" src="' . asset('media/icons/download.svg') . '"/></button></form>';
        })->addColumn('action', function ($message) {
            return '<img style="height:30px;cursor:pointer" class="delete" messageid="' . $message->id . '" src="' . asset('media/icons/remove.svg') . '"/>';
        })->rawColumns(['downloadfile', 'action'])
            ->make(true);
    }

    public function downlaodmessagefile(Request $req)
    {

        return Storage::download('public/messafefiles/' . $req->messagefileid);
    }

    public function deletemessage(Request $req)
    {
        Message::where('id', $req->messageid)->delete();
        return redirect('admin/messages')->with('statut', 'deleted');
    }

    /********clients*******/

    public function clients()
    {
//        $users = Client::get()->all();
//        return view('admin.clients.clients', compact('users'));
        return view('admin.clients.clients');

    }

    public function ajaxclients()
    {
        $users = User::select(['id', 'name', 'email', 'created_at'])->get();
        return Datatables::of($users)->editColumn('created_at', function ($q) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $q->created_at)->format('d M Y');
        })->make(true);

    }

    /***company***/

    public function companies()
    {
        return view('admin.companies.companies');
    }

    public function ajaxcompanies()
    {
        $companies = Company::get();
        return Datatables::of($companies)->editColumn('created_at', function ($q) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $q->created_at)->format('d M Y');
        })->editColumn('logo', function ($q) {
            return '<img src="' . asset('storage/companies/' . $q->logo) . '" style="height: 40px"/>';
        })->addColumn('action', function ($company) {
            return '<a href="' . url('admin/modifycompanypage/' . $company->id) . '" class="btn text-light mt-0"companyid="' . $company->id . '" style="border-radius: 0;background-color: #204f8c">Modifier</a><p class="btn btn-danger delete mb-0" companyid="' . $company->id . '" style="border-radius: 0">Supprimer</p>';
        })->rawColumns(['logo', 'action'])->make(true);
    }

    public function addcompanypage()
    {
        return view('admin.companies.add');
    }

    public function addcompanies(Request $req)
    {
        $company = Company::create([
            'name' => $req->name,
            'logo' => 'logo',
            'created_at' => date('Y-m-d h:i:s')
        ]);
        $imagename = $company->id . '.' . $req->file('logo')->getClientOriginalExtension();
        $logo = $req->file('logo')->storeAs('public/companies', $imagename);
        $company->logo = $imagename;
        $company->save();

        $statut = 'good';
        return redirect('/admin/companies')->with('statut', 'added');
    }

    public function deletecompanies(Request $req)
    {
        $company = Company::where('id', $req->modalcompanyid)->first();
        Storage::delete('public/companies/' . $company->logo);
        $company->delete();
        return redirect('/admin/companies')->with('statut', 'deleted');
    }

    public function modifycompanypage($id)
    {
        $company = Company::where('id', $id)->first();
        return view('admin.companies.update', compact('company'));
    }

    public function modifycompanies(Request $req)
    {
        $company = Company::where('id', $req->comapnyid)->first();
        Storage::delete('public/companies/' . $company->logo);
        $company->update([
            'name' => $req->name,
            'logo' => $req->comapnyid . '.' . $req->file('logo')->getClientOriginalExtension(),
        ]);
        $imagename = $req->comapnyid . '.' . $req->file('logo')->getClientOriginalExtension();
        $logo = $req->file('logo')->storeAs('public/companies', $imagename);
        return redirect('/admin/companies')->with('statut', 'updated');
    }

    public function profile()
    {
        $admin = User::where('id', Auth::id())->first();
        return view('admin.admin.profile', compact('admin'));
    }

    public function updateprofile(Request $req)
    {
        $validator = $req->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'nepassword' => ['same:nepassword2'],

        ]);
        $user = User::where('id', Auth::id())->update([
            'name' => $req->name,
            'email' => $req->email,
        ]);

        if ($req->modifypasswpord) {
            if (Auth::attempt(['email' => $req->email, 'password' => $req->currentpasswpord])) {
                $user = User::where('id', Auth::id())->update([
                    'password' => Hash::make($req->nepassword),
                ]);
            }
        }
        return redirect('/admin/profile')->with('statut', 'updated');
    }

    /******products*******/
    public function products()
    {
        return view('admin.products.products');
    }

    public function ajaxproducts()
    {
        $products = Product::with(['childcategory', 'company', 'images', 'colors'])->get();
        return Datatables::of($products)->editColumn('created_at', function ($q) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $q->created_at)->format('d M Y');
        })->addColumn('images', function ($q) {
            $images = '';
            foreach ($q->images as $image) {
                $images .= '<img src="' . asset('storage/products/' . $image->name) . '" class="img-fluid"/>';
            }
            return $images;
        })->addColumn('colors', function ($q) {
            $colors = '';
            foreach ($q->colors as $color) {
                $colors .= '<div class="me-1" style="border-radius:100px;height: 25px;width: 25px;background-color:' . $color->name . ';"></div>';
            }
            return $colors;
        })->addColumn('action', function ($product) {
            return ' <a href="' . url('admin/modifyproductpage/' . $product->id) . '" class="btn btn-sm text-light update" productid="' . $product->id . '"
                                   style="background-color: #204f8c;border-radius: 0">Modifier</a> <button class="btn btn-sm btn-danger delete" productid="' . $product->id . '" style="border-radius: 0">Supprimer</button>';
        })->editColumn('child_category_id', function ($product) {
            return $product->childcategory->name;
        })->editColumn('company_id', function ($product) {
            return $product->company->name;
        })->editColumn('price', function ($product) {
            return $product->price . ' Dh';
        })->rawColumns(['images', 'colors', 'action', 'presentation', 'specification'])->make(true);

    }

    public function addproductpage()
    {
        $categoris = Category::get()->all();
        $childcategoris = Child_category::where('category_id', $categoris[0]->id)->get()->all();
        $companies = Company::get()->all();

        return view('admin.products.add', compact(['categoris', 'childcategoris', 'companies']));
    }

    public function filtercategory(Request $req)
    {
        $categories = Child_category::where('category_id', $req->category_id)->get()->all();
        return $categories;
    }

    public function addproduct(Request $req)
    {
        $validator = $req->validate([
            'title' => ['required'],
            'presentation' => ['required'],
            'childcategory' => ['required'],
            'Etat' => ['required'],
            'price' => ['required', 'Numeric'],
            'Quantite' => ['integer', 'min:1'],
            'images' => ['required'],
            'images.*' => ['image']
        ]);
        $product = Product::create([
            'child_category_id' => $req->childcategory,
            'statut' => $req->Etat,
            'title' => $req->title,
            'presentation' => $req->presentation,
            'company_id' => $req->company,
            'specification' => $req->Description,
            'Technical_sheet' => $req->technicalfile,
            'quantity' => $req->Quantite,
            'price' => $req->price,
            'created_at' => date('Y-m-d h:i:s'),

        ]);
        $index = 1;
        foreach ($req->file('images') as $image) {
            $imagename = $product->id . '_' . $index . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/products', $imagename);
            Products_image::create([
                'name' => $imagename,
                'article_id' => $product->id,
            ]);
            $index++;
        }
        $colors = explode('|', $req->selectedcolors);

        for ($i = 0; $i < (count($colors) - 1); $i++) {
            Color::create([
                'product_id' => $product->id,
                'name' => $colors[$i],
                'created_at' => date('Y-m-d h:i:s'),
            ]);
        }
        return redirect('admin/products')->with('statut', 'added');
    }

    public function deleteproduct(Request $req)
    {
        Color::where('product_id', $req->productid)->delete();
        $images = Products_image::where('article_id', $req->productid)->get()->all();
        foreach ($images as $image) {
            Storage::delete('public/products/' . $image->name);
        }
        Product::where('id', $req->productid)->delete();
        return redirect('admin/products')->with('statut', 'deleted');

    }

    public function modifyproductpage($id)
    {
        $product = Product::where('id', $id)->with('childcategory', 'images', 'company', 'colors')->first();
        $categoris = Category::get()->all();
        $childcategoris = Child_category::get()->all();
        $companies = Company::get()->all();

        return view('admin.products.modify', compact(['categoris', 'childcategoris', 'companies', 'product']));
    }

    public function modifyproduct(Request $req, $id)
    {
        $validator = $req->validate([
            'title' => ['required'],
            'presentation' => ['required'],
            'childcategory' => ['required'],
            'Etat' => ['required'],
            'price' => ['required', 'Numeric'],
            'Quantite' => ['integer', 'min:1'],
            'images.*' => ['image']
        ]);
        $product = Product::where('id', $id)->update([
            'child_category_id' => $req->childcategory,
            'statut' => $req->Etat,
            'title' => $req->title,
            'presentation' => $req->presentation,
            'company_id' => $req->company,
            'specification' => $req->Description,
            'Technical_sheet' => $req->technicalfile,
            'quantity' => $req->Quantite,
            'price' => $req->price,
            'created_at' => date('Y-m-d h:i:s'),

        ]);
        if ($req->file('images') !== null) {
            $oldimages = Products_image::where('article_id', $id)->get()->all();
            foreach ($oldimages as $oldimage) {
                Storage::delete('public/products/' . $oldimage->name);
            }
            Products_image::where('article_id', $id)->delete();
            $index = 1;
            foreach ($req->file('images') as $image) {
                $imagename = $product->id . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/products', $imagename);
                Products_image::create([
                    'name' => $imagename,
                    'article_id' => $product->id,
                ]);
                $index++;
            }
        }
        if ($req->selectedcolors != null) {
            Color::where('product_id', $id)->delete();
            $colors = explode('|', $req->selectedcolors);
            for ($i = 0; $i < (count($colors) - 1); $i++) {
                Color::create([
                    'product_id' => $id,
                    'name' => $colors[$i],
                    'created_at' => date('Y-m-d h:i:s'),
                ]);
            }
        }
        return redirect('admin/products')->with('statut', 'added');
    }

    public function bestproducts()
    {
        return view('admin.bestProducts.bestproducts');
    }

    public function ajaxbestproducts()
    {
//        $products = Product::with(['childcategory', 'company', 'images', 'colors'])->get();
//        return Datatables::of($products)->editColumn('created_at', function ($q) {
//            return Carbon::createFromFormat('Y-m-d H:i:s', $q->created_at)->format('d M Y');
//        })->addColumn('images',function ($q){
//            $images='';
//            foreach ($q->images as $image){
//                $images.='<img src="'.asset('storage/products/'.$image->name).'" class="img-fluid"/>';
//            }
//            return $images;
//        })->addColumn('colors',function ($q){
//            $colors='';
//            foreach ($q->colors as $color){
//                $colors.='<div class="me-1" style="border-radius:100px;height: 25px;width: 25px;background-color:'.$color->name.';"></div>';
//            }
//            return $colors;
//        })->addColumn('action', function ($product) {
//            return ' <a href="'.url('admin/modifyproductpage/'.$product->id).'" class="btn btn-sm text-light update" productid="'.$product->id.'"
//                                   style="background-color: #204f8c;border-radius: 0">Modifier</a> <button class="btn btn-sm btn-danger delete" productid="'.$product->id.'" style="border-radius: 0">Supprimer</button>';
//        })->editColumn('child_category_id', function ($product) {
//            return $product->childcategory->name;
//        })->editColumn('company_id', function ($product) {
//            return $product->company->name;
//        })->editColumn('price', function ($product) {
//            return $product->price.' Dh';
//        })->rawColumns(['images','colors','action','presentation','specification'])->make(true);


        $products = Best_product::with(['product' => function ($q) {
            $q->with(['childcategory', 'company', 'images', 'colors']);
        }])->get();
        return Datatables::of($products)->editColumn('product.created_at', function ($q) {
            return Carbon::createFromFormat('Y-m-d H:i:s', $q->created_at)->format('d M Y');
        })->addColumn('images', function ($q) {
            $images = '';
            foreach ($q->product->images as $image) {
                $images .= '<img src="' . asset('storage/products/' . $image->name) . '" class="img-fluid"/>';
            }
            return $images;
        })->addColumn('colors', function ($q) {
            $colors = '';
            foreach ($q->product->colors as $color) {
                $colors .= '<div class="me-1" style="border-radius:100px;height: 25px;width: 25px;background-color:' . $color->name . ';"></div>';
            }
            return $colors;
        })->addColumn('action', function ($product) {
            return '  <button class="btn btn-sm btn-danger delete" style="border-radius:0" bestproductid="' . $product->id . '">Supprimer</button>';
        })->editColumn('product.child_category_id', function ($product) {
            return $product->product->childcategory->name;
        })->editColumn('product.company_id', function ($product) {
            return $product->product->company->name;
        })->editColumn('product.price', function ($product) {
            return $product->product->price . ' Dh';
        })->rawColumns(['images', 'colors', 'action', 'product.presentation', 'product.specification'])->make(true);

    }

    public function addbestproductpage()
    {
        $products = Product::whereDoesntHave('topproducts')->get();
        return view('admin.bestProducts.add', compact('products'));
    }

    public function addbestproduct(Request $req)
    {
        Best_product::create([
            'products_id' => $req->product_id,
            'created_at' => date('Y-m-d h:i:s'),
        ]);
        return redirect('admin/bestproducts')->with('statut', 'added');
    }

    public function deletebestproduct(Request $req)
    {
        Best_product::where('id', $req->bestproductid)->delete();
        return redirect('admin/bestproducts')->with('statut', 'deleted');
    }
}
