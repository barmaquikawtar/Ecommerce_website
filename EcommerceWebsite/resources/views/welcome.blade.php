<!
<html>
<head>

    <x-parts.files/>
    <title>Home</title>
    <style>
        * {
            font-family: 'Noto Sans', sans-serif;
        }

        .header-swiper-container {
            width: 100%;
            height: 65%;
        }

        .header-swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .header-swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


        .hoverbutton:hover {
            background-color: #204f8c !important;
            color: white !important;
        }

        .card {
            color: #6c6767;
            border: none !important;
            cursor: pointer;
        }

        .card:hover {
            border-radius: 0 !important;
            box-shadow: -1px 2px 17px 0px rgba(32, 79, 140, 0.65);
            -webkit-box-shadow: -1px 2px 17px 0px rgba(32, 79, 140, 0.65);
            -moz-box-shadow: -1px 2px 17px 0px rgba(32, 79, 140, 0.65);
        }

        .product-swiper-container {
            width: 100%;
            height: 100%;
        }

        .product-swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;

            /* Center slide text vertically */
            display: -webkit-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            -webkit-justify-content: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            -webkit-align-items: center;
            align-items: center;
        }

        .product-swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-swiper-container {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .product-swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .product-mySwiper2 {
            height: 80%;
            width: 100%;
        }

        .product-mySwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .product-mySwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .product-mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .product-swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }


    </style>

</head>
<body>
<header>
    <x-parts.header/>
    <div class="swiper-container header-swiper-container">
        <div class="swiper-wrapper header-swiper-wrapper">
            <div class="swiper-slide header-swiper-slide">
                <img src="{{asset('media/slider/image2.png')}}">
            </div>
            <div class="swiper-slide header-swiper-slide">
                <img src="{{asset('media/slider/image1.png')}}">
            </div>
            <div class="swiper-slide header-swiper-slide">
                <img src="{{asset('media/slider/image3.jpg')}}" class="img-fluid">

            </div>
            <div class="swiper-slide header-swiper-slide">
                <img src="{{asset('media/slider/image4.jpg')}}" class="img-fluid">

            </div>
        </div>
        <div class="swiper-button-next header-swiper-button-next" style="color: #204f8c"></div>
        <div class="swiper-button-prev header-swiper-button-prev" style="color: #204f8c"></div>
        <div class="swiper-pagination header-swiper-pagination"></div>
    </div>
</header>
<div class="container-fluid  ps-lg-5 ps-sm-3 ps-1 mt-2">
    <div class="row">
        <x-parts.clientnavbar/>
        <div class="col-12 col-md-8 mt-3">
            <p style="color: #204f8c;font-size: 22px;font-weight: 600">PRODUITS POPULAIRES</p>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6 card text-center mb-4 pb-2">
                        <div>
                            @foreach($product->product->images as $img)
                                @if($loop->first)
                                    <a href="{{url('product/'.$product->product->id)}}" class="articleimage">
                                        <img src="{{asset('storage/products/'.$img->name)}}"
                                             class="img-fluid" style="max-height: 40vh"/>
                                    </a>
                                @endif
                            @endforeach
                            <button class="btn btn-sm rapide" productid="{{$product->product->id}}"
                                    style="display:none;left:25%;z-index:100;top:20%;position:absolute;background-color:#f0f0f0;color:rgb(29,28,28);border-radius: 0;border: solid 1px #f0f0f0 ">
                                Aperçu rapide
                            </button>
                        </div>
                        <a href="{{url('product/'.$product->product->id)}}" class="mt-1"
                           style="font-size: 14px;text-decoration: none;color: #6c6767">
                            {{substr($product->product->title,0,20)}}
                        </a>
                        <span class="mt-1" style="color:#204f8c;font-size: 20px ">
                            {{$product->product->price}} MAD
                        </span>
                        @if($product->product->quantity>=1)

                            <span style="color: #559f45;font-size: 12.5px">
                            <img src="{{asset('media/icons/correct.svg')}}" style="width: 10px">
                                Produit en stock ({{$product->product->quantity}})
                        </span>
                        @else
                            <span class="text-danger" style="font-size: 12.5px">
                            <img src="{{asset('media/icons/wrong.svg')}}" style="width: 10px">
                            Produit n'est pas en stock
                            </span>
                        @endif
                        {{--                        @foreach($product->product->pane as $pane2)--}}
                        {{--                            @if($pane2->client_id==\Illuminate\Support\Facades\Auth::guard('client')->id())--}}
                        {{--                                @php--}}
                        {{--                                    $alreadyexist=True--}}
                        {{--                                @endphp--}}
                        {{--                            @else--}}
                        {{--                                @php--}}
                        {{--                                    $alreadyexist=False--}}
                        {{--                                @endphp--}}
                        {{--                            @endif--}}
                        {{--                        @endforeach--}}
                        @if($product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first())
                            <div class="d-flex">
                                <button class="btn btn-danger deletebutton addbuttontype2 addbutton3"
                                        paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                        style="border-radius: 0 !important;height: 38px;width: 20% ">
                                    <img src="{{asset('media/icons/wrong2.svg')}}" style="width: 18px">
                                </button>
                                <button class="btn text-danger deletebutton addbuttontype2 addbutton4 border-danger"
                                        paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                        style="border-radius: 0 !important;width: 80%">
                                    Supprimer
                                </button>
                            </div>
                        @else
                            <form method="post" action="{{url('/addtopane')}}" class="d-flex">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$product->product->id}}">
                                @foreach($product->product->colors as $color)
                                    @if($loop->first)
                                        <input type="hidden" name="selectedcolor" value="{{$color->id}}">
                                    @endif
                                @endforeach
                                <input type="hidden" name="quantity" value="1">
                                <button @if($product->product->quantity<=0) disabled="disabled"
                                        @endif class="btn addbutton addbutton1" productid="{{$product->product->id}}"
                                        style="border-radius: 0 !important;background-color:#204f8c;height: 38px;width: 20% ">
                                    <img src="{{asset('media/icons/plus.svg')}}" style="width: 18px">
                                </button>
                                <button @if($product->product->quantity<=0) disabled="disabled"
                                        @endif class="btn addbutton addbutton2" productid="{{$product->product->id}}"
                                        style="border-radius: 0 !important;border-color: #204f8c;color: #204f8c;width: 80%">
                                    Ajouter au panier
                                </button>
                            </form>

                        @endif
                    </div>
                @endforeach
                    @foreach($products as $product)
                        <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6 card text-center mb-4 pb-2">
                            <div>
                                @foreach($product->product->images as $img)
                                    @if($loop->first)
                                        <a href="{{url('product/'.$product->product->id)}}" class="articleimage">
                                            <img src="{{asset('storage/products/'.$img->name)}}"
                                                 class="img-fluid" style="max-height: 40vh"/>
                                        </a>
                                    @endif
                                @endforeach
                                <button class="btn btn-sm rapide" productid="{{$product->product->id}}"
                                        style="display:none;left:25%;z-index:100;top:20%;position:absolute;background-color:#f0f0f0;color:rgb(29,28,28);border-radius: 0;border: solid 1px #f0f0f0 ">
                                    Aperçu rapide
                                </button>
                            </div>
                            <a href="{{url('product/'.$product->product->id)}}" class="mt-1"
                               style="font-size: 14px;text-decoration: none;color: #6c6767">
                                {{substr($product->product->title,0,20)}}
                            </a>
                            <span class="mt-1" style="color:#204f8c;font-size: 20px ">
                            {{$product->product->price}} MAD
                        </span>
                            @if($product->product->quantity>=1)

                                <span style="color: #559f45;font-size: 12.5px">
                            <img src="{{asset('media/icons/correct.svg')}}" style="width: 10px">
                                Produit en stock ({{$product->product->quantity}})
                        </span>
                            @else
                                <span class="text-danger" style="font-size: 12.5px">
                            <img src="{{asset('media/icons/wrong.svg')}}" style="width: 10px">
                            Produit n'est pas en stock
                            </span>
                            @endif
                            {{--                        @foreach($product->product->pane as $pane2)--}}
                            {{--                            @if($pane2->client_id==\Illuminate\Support\Facades\Auth::guard('client')->id())--}}
                            {{--                                @php--}}
                            {{--                                    $alreadyexist=True--}}
                            {{--                                @endphp--}}
                            {{--                            @else--}}
                            {{--                                @php--}}
                            {{--                                    $alreadyexist=False--}}
                            {{--                                @endphp--}}
                            {{--                            @endif--}}
                            {{--                        @endforeach--}}
                            @if($product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first())
                                <div class="d-flex">
                                    <button class="btn btn-danger deletebutton addbuttontype2 addbutton3"
                                            paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/wrong2.svg')}}" style="width: 18px">
                                    </button>
                                    <button class="btn text-danger deletebutton addbuttontype2 addbutton4 border-danger"
                                            paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;width: 80%">
                                        Supprimer
                                    </button>
                                </div>
                            @else
                                <form method="post" action="{{url('/addtopane')}}" class="d-flex">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->product->id}}">
                                    @foreach($product->product->colors as $color)
                                        @if($loop->first)
                                            <input type="hidden" name="selectedcolor" value="{{$color->id}}">
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="quantity" value="1">
                                    <button @if($product->product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton1" productid="{{$product->product->id}}"
                                            style="border-radius: 0 !important;background-color:#204f8c;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/plus.svg')}}" style="width: 18px">
                                    </button>
                                    <button @if($product->product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton2" productid="{{$product->product->id}}"
                                            style="border-radius: 0 !important;border-color: #204f8c;color: #204f8c;width: 80%">
                                        Ajouter au panier
                                    </button>
                                </form>

                            @endif
                        </div>
                    @endforeach
                    @foreach($products as $product)
                        <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6 card text-center mb-4 pb-2">
                            <div>
                                @foreach($product->product->images as $img)
                                    @if($loop->first)
                                        <a href="{{url('product/'.$product->product->id)}}" class="articleimage">
                                            <img src="{{asset('storage/products/'.$img->name)}}"
                                                 class="img-fluid" style="max-height: 40vh"/>
                                        </a>
                                    @endif
                                @endforeach
                                <button class="btn btn-sm rapide" productid="{{$product->product->id}}"
                                        style="display:none;left:25%;z-index:100;top:20%;position:absolute;background-color:#f0f0f0;color:rgb(29,28,28);border-radius: 0;border: solid 1px #f0f0f0 ">
                                    Aperçu rapide
                                </button>
                            </div>
                            <a href="{{url('product/'.$product->product->id)}}" class="mt-1"
                               style="font-size: 14px;text-decoration: none;color: #6c6767">
                                {{substr($product->product->title,0,20)}}
                            </a>
                            <span class="mt-1" style="color:#204f8c;font-size: 20px ">
                            {{$product->product->price}} MAD
                        </span>
                            @if($product->product->quantity>=1)

                                <span style="color: #559f45;font-size: 12.5px">
                            <img src="{{asset('media/icons/correct.svg')}}" style="width: 10px">
                                Produit en stock ({{$product->product->quantity}})
                        </span>
                            @else
                                <span class="text-danger" style="font-size: 12.5px">
                            <img src="{{asset('media/icons/wrong.svg')}}" style="width: 10px">
                            Produit n'est pas en stock
                            </span>
                            @endif
                            {{--                        @foreach($product->product->pane as $pane2)--}}
                            {{--                            @if($pane2->client_id==\Illuminate\Support\Facades\Auth::guard('client')->id())--}}
                            {{--                                @php--}}
                            {{--                                    $alreadyexist=True--}}
                            {{--                                @endphp--}}
                            {{--                            @else--}}
                            {{--                                @php--}}
                            {{--                                    $alreadyexist=False--}}
                            {{--                                @endphp--}}
                            {{--                            @endif--}}
                            {{--                        @endforeach--}}
                            @if($product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first())
                                <div class="d-flex">
                                    <button class="btn btn-danger deletebutton addbuttontype2 addbutton3"
                                            paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/wrong2.svg')}}" style="width: 18px">
                                    </button>
                                    <button class="btn text-danger deletebutton addbuttontype2 addbutton4 border-danger"
                                            paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;width: 80%">
                                        Supprimer
                                    </button>
                                </div>
                            @else
                                <form method="post" action="{{url('/addtopane')}}" class="d-flex">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->product->id}}">
                                    @foreach($product->product->colors as $color)
                                        @if($loop->first)
                                            <input type="hidden" name="selectedcolor" value="{{$color->id}}">
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="quantity" value="1">
                                    <button @if($product->product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton1" productid="{{$product->product->id}}"
                                            style="border-radius: 0 !important;background-color:#204f8c;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/plus.svg')}}" style="width: 18px">
                                    </button>
                                    <button @if($product->product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton2" productid="{{$product->product->id}}"
                                            style="border-radius: 0 !important;border-color: #204f8c;color: #204f8c;width: 80%">
                                        Ajouter au panier
                                    </button>
                                </form>

                            @endif
                        </div>
                    @endforeach
                    @foreach($products as $product)
                        <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6 card text-center mb-4 pb-2">
                            <div>
                                @foreach($product->product->images as $img)
                                    @if($loop->first)
                                        <a href="{{url('product/'.$product->product->id)}}" class="articleimage">
                                            <img src="{{asset('storage/products/'.$img->name)}}"
                                                 class="img-fluid" style="max-height: 40vh"/>
                                        </a>
                                    @endif
                                @endforeach
                                <button class="btn btn-sm rapide" productid="{{$product->product->id}}"
                                        style="display:none;left:25%;z-index:100;top:20%;position:absolute;background-color:#f0f0f0;color:rgb(29,28,28);border-radius: 0;border: solid 1px #f0f0f0 ">
                                    Aperçu rapide
                                </button>
                            </div>
                            <a href="{{url('product/'.$product->product->id)}}" class="mt-1"
                               style="font-size: 14px;text-decoration: none;color: #6c6767">
                                {{substr($product->product->title,0,20)}}
                            </a>
                            <span class="mt-1" style="color:#204f8c;font-size: 20px ">
                            {{$product->product->price}} MAD
                        </span>
                            @if($product->product->quantity>=1)

                                <span style="color: #559f45;font-size: 12.5px">
                            <img src="{{asset('media/icons/correct.svg')}}" style="width: 10px">
                                Produit en stock ({{$product->product->quantity}})
                        </span>
                            @else
                                <span class="text-danger" style="font-size: 12.5px">
                            <img src="{{asset('media/icons/wrong.svg')}}" style="width: 10px">
                            Produit n'est pas en stock
                            </span>
                            @endif
                            {{--                        @foreach($product->product->pane as $pane2)--}}
                            {{--                            @if($pane2->client_id==\Illuminate\Support\Facades\Auth::guard('client')->id())--}}
                            {{--                                @php--}}
                            {{--                                    $alreadyexist=True--}}
                            {{--                                @endphp--}}
                            {{--                            @else--}}
                            {{--                                @php--}}
                            {{--                                    $alreadyexist=False--}}
                            {{--                                @endphp--}}
                            {{--                            @endif--}}
                            {{--                        @endforeach--}}
                            @if($product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first())
                                <div class="d-flex">
                                    <button class="btn btn-danger deletebutton addbuttontype2 addbutton3"
                                            paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/wrong2.svg')}}" style="width: 18px">
                                    </button>
                                    <button class="btn text-danger deletebutton addbuttontype2 addbutton4 border-danger"
                                            paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;width: 80%">
                                        Supprimer
                                    </button>
                                </div>
                            @else
                                <form method="post" action="{{url('/addtopane')}}" class="d-flex">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->product->id}}">
                                    @foreach($product->product->colors as $color)
                                        @if($loop->first)
                                            <input type="hidden" name="selectedcolor" value="{{$color->id}}">
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="quantity" value="1">
                                    <button @if($product->product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton1" productid="{{$product->product->id}}"
                                            style="border-radius: 0 !important;background-color:#204f8c;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/plus.svg')}}" style="width: 18px">
                                    </button>
                                    <button @if($product->product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton2" productid="{{$product->product->id}}"
                                            style="border-radius: 0 !important;border-color: #204f8c;color: #204f8c;width: 80%">
                                        Ajouter au panier
                                    </button>
                                </form>

                            @endif
                        </div>
                    @endforeach
                    @foreach($products as $product)
                        <div class="col-xxl-2 col-xl-3 col-lg-4 col-md-6 col-sm-6 col-6 card text-center mb-4 pb-2">
                            <div>
                                @foreach($product->product->images as $img)
                                    @if($loop->first)
                                        <a href="{{url('product/'.$product->product->id)}}" class="articleimage">
                                            <img src="{{asset('storage/products/'.$img->name)}}"
                                                 class="img-fluid" style="max-height: 40vh"/>
                                        </a>
                                    @endif
                                @endforeach
                                <button class="btn btn-sm rapide" productid="{{$product->product->id}}"
                                        style="display:none;left:25%;z-index:100;top:20%;position:absolute;background-color:#f0f0f0;color:rgb(29,28,28);border-radius: 0;border: solid 1px #f0f0f0 ">
                                    Aperçu rapide
                                </button>
                            </div>
                            <a href="{{url('product/'.$product->product->id)}}" class="mt-1"
                               style="font-size: 14px;text-decoration: none;color: #6c6767">
                                {{substr($product->product->title,0,20)}}
                            </a>
                            <span class="mt-1" style="color:#204f8c;font-size: 20px ">
                            {{$product->product->price}} MAD
                        </span>
                            @if($product->product->quantity>=1)

                                <span style="color: #559f45;font-size: 12.5px">
                            <img src="{{asset('media/icons/correct.svg')}}" style="width: 10px">
                                Produit en stock ({{$product->product->quantity}})
                        </span>
                            @else
                                <span class="text-danger" style="font-size: 12.5px">
                            <img src="{{asset('media/icons/wrong.svg')}}" style="width: 10px">
                            Produit n'est pas en stock
                            </span>
                            @endif
                            {{--                        @foreach($product->product->pane as $pane2)--}}
                            {{--                            @if($pane2->client_id==\Illuminate\Support\Facades\Auth::guard('client')->id())--}}
                            {{--                                @php--}}
                            {{--                                    $alreadyexist=True--}}
                            {{--                                @endphp--}}
                            {{--                            @else--}}
                            {{--                                @php--}}
                            {{--                                    $alreadyexist=False--}}
                            {{--                                @endphp--}}
                            {{--                            @endif--}}
                            {{--                        @endforeach--}}
                            @if($product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first())
                                <div class="d-flex">
                                    <button class="btn btn-danger deletebutton addbuttontype2 addbutton3"
                                            paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/wrong2.svg')}}" style="width: 18px">
                                    </button>
                                    <button class="btn text-danger deletebutton addbuttontype2 addbutton4 border-danger"
                                            paneid="{{$product->product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;width: 80%">
                                        Supprimer
                                    </button>
                                </div>
                            @else
                                <form method="post" action="{{url('/addtopane')}}" class="d-flex">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->product->id}}">
                                    @foreach($product->product->colors as $color)
                                        @if($loop->first)
                                            <input type="hidden" name="selectedcolor" value="{{$color->id}}">
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="quantity" value="1">
                                    <button @if($product->product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton1" productid="{{$product->product->id}}"
                                            style="border-radius: 0 !important;background-color:#204f8c;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/plus.svg')}}" style="width: 18px">
                                    </button>
                                    <button @if($product->product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton2" productid="{{$product->product->id}}"
                                            style="border-radius: 0 !important;border-color: #204f8c;color: #204f8c;width: 80%">
                                        Ajouter au panier
                                    </button>
                                </form>

                            @endif
                        </div>
                    @endforeach

            </div>
        </div>
    </div>
</div>
<x-parts.footer/>


<!-- Modal -->
<div class="modal fade" id="addedtopanesuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content " style="border-radius: 0">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-5">
                        <img src="{{asset('media/products/product1.jpg')}}" class="img-fluid addedtopanesuccessimage"/>
                    </div>
                    <div class="col-lg-7">
                        <div class="d-flex align-items-center mb-5 mt-3 mt-lg-0">
                            <img src="{{asset('media/icons/correct3.svg')}}" style="height: 20px">
                            <p style="color: #f69c14" class="mb-0 ms-2">Produit ajouté au panier avec succès</p>
                        </div>
                        <p class="mb-1 addedtopanesuccesstitle" style="color: #204f8c;font-size: 17px;font-weight: 600">
                            PC Gamer UltraPC Ryzen5
                            GEN5-III</p>
                        <p class="mb-1" style="color: #f69c14;font-size: 18px;font-weight: 550"><span
                                class="addedtopanesuccessprice">1800</span> MAD</p>
                        <p style="color: #6c6767;font-size: 18px;font-weight: 400">Quantité :<span
                                class="addedtopanesuccessquantity"></span></p>
                        <div class="alert mt-5"
                             style="background-color:rgb(246,156,20,0.3);border-radius: 0;color: #f69c14 ">
                            <p class="mb-1">Il y a <span class="addedsuccessmodalnbarticl"></span> articles dans votre
                                panier.</p>
                            <p class="mb-1"><b>Total :</b> <span class="addedsuccessmodaltotalprice">50005</span> MAD
                            </p>
                            <div class="d-flex">
                                <button class="btn btn-sm hoverbutton mt-2 me-2" data-bs-dismiss="modal"
                                        style="border-color: #204f8c;color: #204f8c;border-radius: 0;background-color: rgb(32,79,140,0.2)">
                                    Continuer mes achats
                                </button>
                                <a href="{{url('/panier')}}" class="btn btn-sm mt-2 d-flex align-items-center"
                                        style="border-color: #f69c14;color: white;border-radius: 0;background-color: #f69c14">
                                    <img src="{{asset('media/icons/correct2.svg')}}" style="width: 20px">
                                    <span class="ms-2">Commander</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="articleinfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content " style="border-radius: 0">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{url('/addtopane')}}" class="row">
                    @csrf
                    <input type="hidden" name="product_id" id="articleinfo_productid" value="{{$product->product->id}}">
                    <input type="hidden" name="selectedcolor" id="articleinfo_selectedcolor"
                           value="{{$product->product->colors[0]->id}}">

                    <div class="col-5">
                        {{--                        <img src="{{asset('media/products/product1.jpg')}}" class="img-fluid"/>--}}
                        <div class="swiper-container product-swiper-container product-mySwiper2 mySwiper2"
                             style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff">
                            <div class="swiper-wrapper product-swiper-wrapper">
                                <div class="swiper-slide product-swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-1.jpg"/>
                                </div>
                                <div class="swiper-slide product-swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-2.jpg"/>
                                </div>
                                <div class="swiper-slide product-swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-3.jpg"/>
                                </div>
                            </div>
                            <div class="swiper-button-next product-swiper-button-next" style="color: #204f8c"></div>
                            <div class="swiper-button-prev product-swiper-button-prev" style="color: #204f8c"></div>
                        </div>
                        <div thumbsSlider=""
                             class="swiper-container product-swiper-container product-mySwiper mySwiper">
                            <div class="swiper-wrapper product-swiper-wrapper">
                                <div class="swiper-slide product-swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-1.jpg"/>
                                </div>
                                <div class="swiper-slide product-swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-2.jpg"/>
                                </div>
                                <div class="swiper-slide product-swiper-slide">
                                    <img src="https://swiperjs.com/demos/images/nature-3.jpg"/>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-7">
                        <p class="mb-1 modalproductitle" style="color: #204f8c;font-size: 22px;font-weight: 300">
                            PC Gamer UltraPC Ryzen5 GEN5-III
                        </p>
                        <p class="mb-1 modalproducprice" style="color: #f69c14;font-size: 18px;font-weight: 550">1800
                            MAD</p>
                        <p style="color: #6c6767;font-size: 18px;font-weight: 400">Quantité : <span
                                class="modalproducquantity1">1</span></p>
                        <p style="font-size: 13px" class="modalproducpresentation">
                            La carte mère MSI B450M-A PRO MAX qui embarque un chipset AMD B450 est conçue pour
                            accueillir les processeurs AMD Ryzen 1000/2000/3000 et Athlon GE sur socket AMD AM4. Elle
                            permettra l'assemblage d'une configuration multimédia, gaming ou bureautique à coût
                            raisonnable.
                        </p>
                        <p><b style="color: #204f8c">Etat : </b><span class="modalproducetat">Neuf</span></p>
                        <div class="d-flex ">
                            <b style="color: #204f8c">Coleurs :</b>
                            <div class="modalproductcoleurs d-flex"></div>
                        </div>
                        <div class="mt-1">
                            <p class="d-flex align-items-center justify-content-end modalproducquantity2"
                               style="color: #559f45;font-size: 13px">
                                <img src="{{asset('media/icons/clock.svg')}}" class="me-2" style="width: 12px">
                                Produit en stock <b> (1 article)</b>
                            </p>
                            <div class="justify-content-end infodeletepane" style="display: none !important;">
                                <button class="btn btn-danger addbuttontype2 addbutton3"
                                        paneid=""
                                        style="border-radius: 0 !important;height: 38px;width: 38px ">
                                    <img src="{{asset('media/icons/wrong2.svg')}}" style="width: 18px">
                                </button>
                                <button class="btn btn-danger addbuttontype2 addbutton4 border-danger pe-4 ps-4"
                                        paneid=""
                                        style="border-radius: 0 !important;">
                                    Supprimer
                                </button>
                            </div>
                            <div class="justify-content-end infoaddpane" style="display: none !important;">
                                <input type="number" class="form-control me-5 selectedquantity" min="1" value="1"
                                       name="quantity" style="width: 60px;height: 38px;border-radius: 0!important;">
                                <button class="btn addbuttontype2 addbutton3"
                                        style="border-radius: 0 !important;background-color:#204f8c;height: 38px;width: 38px ">
                                    <img src="{{asset('media/icons/plus.svg')}}" style="width: 18px">
                                </button>
                                <button class="btn addbuttontype2 addbutton4"
                                        style="border-radius: 0 !important;border-color: #204f8c;color: #204f8c">
                                    Ajouter au panier
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deletedpanesuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content " style="border-radius: 0">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <img src="{{asset('media/icons/wrong.svg')}}" style="width: 30px">
                <p class="ps-3 mb-0">Produit supprime du panier</p>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deletemodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <form method="post" action="{{url('/deletepanier')}}" class="modal-content" style="border-radius: 0">
            @csrf
            <div class="modal-header border-0 mb-0 pb-0">
                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <input type="hidden" name="pane_id" id="pane_id" value="">
                <img src="{{asset('media/icons/warning.svg')}}" class="img-fluid me-2" style="height: 30px">
                <p class="mb-0 text-danger">êtes-vous sûr de vouloir supprimer ce produit?</p>
            </div>
            <div class="modal-footer border-top-0">
                <button class="btn btn-danger" style="border-radius: 0">Supprimer</button>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.deletebutton').click(function () {
            $('#deletemodal').modal('show')
            $('#pane_id').val($(this).attr('paneid'))
        })


        @if(session()->get('statut')=='addedtopane')
        $.ajax({
            method: 'post',
            url: '/getproductinfo',
            data: {
                '_token': '{{csrf_token()}}',
                'productid': {{session()->get('productid')}}
            }, success: function (e) {
                console.log(e)
                $('.addedtopanesuccesstitle').text(e.product.title)
                $('.addedtopanesuccessprice').text(e.product.price)
                $('.addedtopanesuccessquantity').text('1')
                $('.addedtopanesuccessimage').attr('src', '{{asset('storage/products')}}/' + e.product.images[0].name)
                $('.addedsuccessmodalnbarticl').text(e.nb.length)
                $('.addedsuccessmodaltotalprice').text(e.total)
                for ($i = 0; $i < e.product.images.length; $i++) {
                    $('.product-swiper-wrapper').append('<div class="swiper-slide product-swiper-slide">' +
                        '<img src="{{url('storage/products')}}/' + e.product.images[$i].name + '"/>' +
                        ' </div>')

                }
                $('#articleinfo').modal('hide')
                $('#addedtopanesuccess').modal('show')

            }
        })

        @elseif(session()->get('statut')=='deletedpane')
        $('#deletedpanesuccess').modal('show')
        @endif

        $("#articleinfo").on('show.bs.modal', function () {
            setTimeout(function () {
                var swiper1 = new Swiper(".product-mySwiper", {
                    loop: true,
                    spaceBetween: 10,
                    slidesPerView: 4,
                    freeMode: true,
                    watchSlidesVisibility: true,
                    watchSlidesProgress: true,
                });
                var swiper2 = new Swiper(".product-mySwiper2", {
                    loop: true,
                    spaceBetween: 10,

                    navigation: {
                        nextEl: ".product-swiper-button-next",
                        prevEl: ".product-swiper-button-prev",
                    },
                    thumbs: {
                        swiper: swiper1,
                    },
                });
            }, 500);
        });


        $('.addbutton').hover(function () {
            $(this).parent().children('.addbutton2').hide()
            $(this).parent().children('.addbutton1').css('width', '100%')
        })
        $('.addbutton').mouseout(function () {
            $(this).parent().children('.addbutton2').show()
            $(this).parent().children('.addbutton1').css('width', '38px')
        })

        $('.addbuttontype2').hover(function () {
            $(this).parent().children('.addbutton4').hide()
            $width = $(this).parent().children('.addbutton3').outerWidth() + $(this).parent().children('.addbutton4').outerWidth() + 'px'
            $(this).parent().children('.addbutton3').css('width', $width)
        })
        $('.addbuttontype2').mouseout(function () {
            $(this).parent().children('.addbutton4').show()
            $(this).parent().children('.addbutton3').css('width', '38px')
        })
        $('.rapide,.articleimage').hover(function () {
            $(this).parent().children('.articleimage').css('filter', 'blur(1px)')
            $(this).parent().children('.rapide').show()
        })
        $('.rapide,.articleimage').mouseout(function () {
            $(this).parent().children('.articleimage').css('filter', 'blur(0)')
            $(this).parent().children('.rapide').hide()

        })

        $('.rapide').click(function () {
            $.ajax({
                method: 'post',
                url: '/getproductinfo',
                data: {
                    '_token': '{{csrf_token()}}',
                    'productid': $(this).attr('productid')
                }, success: function (e) {
                    $('.modalproductitle').text(e.product.title)
                    $('.modalproducprice').text(e.product.price + ' MAD')
                    $('.modalproducpresentation').html(e.product.presentation)
                    $('.modalproducetat').text(e.product.statut)
                    $('.modalproducquantity1').text(e.product.quantity)
                    $('#articleinfo_productid').val(e.product.id)
                    $('.selectedquantity').attr('max', e.product.quantity)
                    $('.modalproductcoleurs').html('')
                    console.log(e)
                    for ($i = 0; $i < e.product.colors.length; $i++) {
                        if ($i == 0) {
                            $('.modalproductcoleurs').append('<div colorid="'+e.product.colors[$i].id+'" class="ms-2 productinfocolor" style="cursor:pointer;background-color: ' + e.product.colors[$i].name + ';border-radius: 100px;height: 20px;width: 20px;box-shadow:rgb(68 168 227 / 75%) 0px 0px 21px 13px"></div>')
                        } else {
                            $('.modalproductcoleurs').append('<div colorid="'+e.product.colors[$i].id+'" class="ms-2 productinfocolor" style="cursor:pointer;background-color: ' + e.product.colors[$i].name + ';border-radius: 100px;height: 20px;width: 20px"></div>')
                        }
                    }
                    $('#articleinfo_selectedcolor').val(e.product.colors[0].id)

                    if (e.already == 1) {
                        $('.infodeletepane').css('display','flex')
                        $('.infoaddpane').css('display','none')
                    } else {
                        $('.infodeletepane').css('display','none')
                        $('.infoaddpane').css('display','flex')
                        if (e.product.quantity >= 1) {
                            $('.modalproducquantity2').html('<img src="{{asset('media/icons/clock.svg')}}" class="me-2" style="width: 12px">' +
                                'Produit en stock <b>  (' + e.product.quantity + 'article)</b>')
                            $('.modalproducquantity2').css('color', '#559f45')
                            $('.addbuttontype2').removeAttr('disabled')
                        } else {
                            $('.modalproducquantity2').html('<img src="{{asset('media/icons/wrong.svg')}}" class="me-2" style="width: 12px">' +
                                'Produit n\'est pas en stock')
                            $('.modalproducquantity2').css('color', 'red')
                            $('.addbuttontype2').attr('disabled', 'disabled')
                        }
                    }
                    $('.product-swiper-wrapper').html('')

                    for ($i = 0; $i < e.product.images.length; $i++) {
                        $('.product-swiper-wrapper').append('<div class="swiper-slide product-swiper-slide">' +
                            '<img src="{{url('storage/products')}}/' + e.product.images[$i].name + '"/>' +
                            ' </div>')

                    }
                    $('#articleinfo').modal('show')


                }
            })
        })
        $(document).on('click','.productinfocolor',function (){
            $('#articleinfo_selectedcolor').val($(this).attr('colorid'))
            $('.productinfocolor').css('box-shadow','none')
            $(this).css('box-shadow','rgb(68 168 227 / 75%) 0px 0px 21px 13px')
        })

        {{--$('.addbutton').click(function () {--}}
        {{--    $.ajax({--}}
        {{--        method: 'post',--}}
        {{--        url: '/getproductinfo',--}}
        {{--        data: {--}}
        {{--            '_token': '{{csrf_token()}}',--}}
        {{--            'productid': $(this).attr('productid')--}}
        {{--        }, success: function (e) {--}}
        {{--            $('.addedtopanesuccesstitle').text(e.title)--}}
        {{--            $('.addedtopanesuccessprice').text(e.price + ' MAD')--}}
        {{--            $('.addedtopanesuccessquantity').text(e.quantity)--}}
        {{--            $('.addedtopanesuccessimage').attr('src', '{{asset('storage/products')}}/' + e.images[0].name)--}}
        {{--            // addedtopanesuccessimage--}}
        {{--            for ($i = 0; $i < e.images.length; $i++) {--}}
        {{--                $('.product-swiper-wrapper').append('<div class="swiper-slide product-swiper-slide">' +--}}
        {{--                    '<img src="{{url('storage/products')}}/' + e.images[$i].name + '"/>' +--}}
        {{--                    ' </div>')--}}

        {{--            }--}}
        {{--            $('#articleinfo').modal('hide')--}}
        {{--            $('#addedtopanesuccess').modal('show')--}}

        {{--        }--}}
        {{--    })--}}

        {{--})--}}
        /********header swipper********/
        var swiper = new Swiper(".header-swiper-container", {
            navigation: {
                nextEl: ".header-swiper-button-next",
                prevEl: ".header-swiper-button-prev",
            },
            pagination: {
                el: ".header-swiper-pagination",
            },
            loop: true
        });
        /*********product swipper***************/
        // var swiper1 = new Swiper(".product-mySwiper", {
        //     loop: true,
        //     spaceBetween: 10,
        //     slidesPerView: 4,
        //     freeMode: true,
        //     watchSlidesVisibility: true,
        //     watchSlidesProgress: true,
        // });
        // var swiper2 = new Swiper(".product-mySwiper2", {
        //     loop: true,
        //     spaceBetween: 10,
        //
        //     navigation: {
        //         nextEl: ".product-swiper-button-next",
        //         prevEl: ".product-swiper-button-prev",
        //     },
        //     thumbs: {
        //         swiper: swiper1,
        //     },
        // });
    })

</script>
</body>
</html>

