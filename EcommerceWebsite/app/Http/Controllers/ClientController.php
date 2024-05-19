<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commande;
use App\Models\Commandeitem;
use App\Models\Company;
use App\Models\Pane;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth:client');
    }

    public function dashboard()
    {
        return view('client.dashboard');
    }

    public function addtopane(Request $req)
    {
        $ifalready = Pane::where([
            ['client_id', Auth::guard('client')->id()],
            ['product_id', $req->product_id]
        ])->get()->all();
        if ($ifalready) {
            Pane::where([
                ['client_id', Auth::guard('client')->id()],
                ['product_id', $req->product_id]
            ])->delete();
            return redirect()->back()->with(['statut' => 'deletedpane']);
        } else {
            Pane::create([
                'product_id' => $req->product_id,
                'client_id' => Auth::guard('client')->id(),
                'color_id' => $req->selectedcolor,
                'quantity' => $req->quantity,
                'created_at' => date('Y-m-d H:i:s')
            ]);
            return redirect()->back()->with(['statut' => 'addedtopane', 'productid' => $req->product_id, 'quantity' => $req->quantity]);
        }
    }

    public function pane()
    {
        $panes = Pane::where('client_id', Auth::guard('client')->id())->get()->all();
        $total = 0;
        foreach ($panes as $pane) {
            $total += ($pane->quantity * $pane->product->price);
        }
        return view('client.pane', compact(['panes', 'total']));
    }

    public function deletepanier(Request $req)
    {
        Pane::where([
            ['id', $req->pane_id],
            ['client_id', Auth::guard('client')->id()]
        ])->delete();
        return redirect()->back()->with('statut', 'deleted');
    }

    public function changepanequantity(Request $req)
    {
        if ($req->quantity >= 0) {
            Pane::where([['id', $req->pane_id], ['client_id', Auth::guard('client')->id()]])->update([
                'quantity' => $req->quantity
            ]);
        }
        $pane2 = Pane::where([['id', $req->pane_id], ['client_id', Auth::guard('client')->id()]])->first();
        $price = $pane2->quantity * $pane2->product->price;
        $panes = Pane::where('client_id', Auth::guard('client')->id())->get()->all();
        $total = 0;
        foreach ($panes as $pane) {
            $total += ($pane->quantity * $pane->product->price);
        }
        return array('total' => $total, 'price' => $price);
    }

    /***Commande**/
    public function Commande(Request $req)
    {
        $user = Client::where('id', Auth::guard('client')->id())->first();
        return view('client.validation', compact("user"));
    }

    public function Commandeclick(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|min:3|max:100',
            'email' => 'required|min:3|max:100',
            'telephone' => 'required|min:3|max:100',
            'adresse' => 'required|min:3|max:100',
            'city' => 'required|min:3|max:100',
            'zip' => 'Numeric|min:3|',
        ]);

        $user = Client::where('id', Auth::guard('client')->id())->update([
            'user_name' => $req->name,
            'email' => $req->email,
            'telephone' => $req->telephone,
            'adresse' => $req->adresse,
            'city' => $req->city,
            'zip' => $req->zip,
        ]);
        return redirect('/pay');
    }


    public function pay(Request $request)
    {
        $total = 0;
        $panes = Pane::with('product')->where('client_id', Auth::guard('client')->id())->get()->all();
        foreach ($panes as $pane) {
            $total += $pane->product->price * $pane->quantity;
        }
         $total =$total/10.5;
        $url = "https://eu-test.oppwa.com/v1/checkouts";
        $data = "entityId=8a8294174b7ecb28014b9699220015ca" .
            "&amount=".(int)$total .
            "&currency=EUR" .
            "&paymentType=DB";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData = json_decode($responseData, true);

        return view('client.payement', compact('responseData'));
    }

    function test($id)
    {
        $url = "https://eu-test.oppwa.com/v1/checkouts/" . $id . "/payment";
        $url .= "?entityId=8a8294174b7ecb28014b9699220015ca";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization:Bearer OGE4Mjk0MTc0YjdlY2IyODAxNGI5Njk5MjIwMDE1Y2N8c3k2S0pzVDg='));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);// this should be set to true in production
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $responseData = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch);
        }
        curl_close($ch);
        $responseData = json_decode($responseData, true);
        if ($responseData['result']['code'] == '000.100.110') {
            /*********/
            $commande = Commande::create([
                'client_id' => Auth::guard('client')->id(),
                'created_at' => date('Y-m-d h:i:s')
            ]);
            $total = 0;
             $panes = Pane::with('product')->where('client_id', Auth::guard('client')->id())->get()->all();
            foreach ($panes as $pane) {
                Commandeitem::create([
                    'commade_id'=>$commande->id,
                    'product_id' => $pane->product_id,
                    'color_id' => $pane->color_id,
                    'quantity' => $pane->quantity,
                ]);
                $total += $pane->product->price * $pane->quantity;
                $pane->delete();
            }
            $commande->total = $total;
            $commande->save();


            return redirect('/mescommande')->with('etat', 'success');
        } else {
            return $responseData;
            return redirect('/mescommande')->with('etat', 'failed');
        }
    }

    public function mescommande()
    {
        $commandes = Commande::with(['client', 'items' => function ($q) {
            $q->with(['pane' => function ($q2) {
                $q2->with(['color', 'product' => function ($q3) {
                    $q3->with('images');
                }]);
            }]);
        }])->where('client_id', Auth::guard('client')->id())->orderBy('id', 'desc')->get()->all();
        return view('client.Commande', compact('commandes'));
    }
}
