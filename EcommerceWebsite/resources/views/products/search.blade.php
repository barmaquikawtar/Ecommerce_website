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
</header>
<div class="container-fluid  ps-lg-5 ps-sm-3 ps-1 mt-2">
    <div class="row">
        <x-parts.clientnavbar/>
        <div class="col-12 col-md-8 mt-3">
            @if($products)
                <div class="row">
                    <p style="color: #204f8c;font-size: 22px;font-weight: 600">{{$title}}</p>
                    <div class="pt-3 pb-3 col-12 d-flex align-items-center justify-content-between"
                         style="border-bottom: solid 1px #cdcbcb;border-top: solid 1px #cdcbcb">
                        <span style=" color: #6c6767 !important">Il y a {{count($products)}} produits</span>
                        <div class="d-flex align-items-center">
                            <label for="trier" style="color: #6c6767;">Trier par :</label>
                            <select name="trier" id="trier" class="form-control ms-3" datatype="{{$datatype}}"
                                    style="border-radius: 0;width: 200px;color: #6c6767 !important">
                                <option value="atoz">Nom, A à Z</option>
                                <option value="ztoa">Nom, Z à A</option>
                                <option value="croissant">Prix, Croissant</option>
                                <option value="decroissant">Prix, Décroissant</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 allproducts">
                    @foreach($products as $product)
                        <div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-4 col-12 card text-center mb-4 pb-2">
                            <div>
                                @foreach($product->images as $img)
                                    @if($loop->first)
                                        <a href="{{url('product/'.$product->id)}}" class="articleimage">
                                            <img src="{{asset('storage/products/'.$img->name)}}"
                                                 class="img-fluid " style="max-height: 40vh"/>
                                        </a>
                                    @endif
                                @endforeach
                            </div>
                            <a href="{{url('product/'.$product->id)}}" class="mt-1"
                               style="font-size: 14px;text-decoration: none;color: #6c6767">
                                {{substr($product->title,0,20)}}
                            </a>
                            <span class="mt-1" style="color:#204f8c;font-size: 20px ">
                            {{$product->price}} MAD
                        </span>
                            @if($product->quantity>=1)

                                <span style="color: #559f45;font-size: 12.5px">
                            <img src="{{asset('media/icons/correct.svg')}}" style="width: 10px">
                                Produit en stock ({{$product->quantity}})
                        </span>
                            @else
                                <span class="text-danger" style="font-size: 12.5px">
                            <img src="{{asset('media/icons/wrong.svg')}}" style="width: 10px">
                            Produit n'est pas en stock
                            </span>
                            @endif
                            @if($product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first())
                                <div class="d-flex">
                                    <button class="btn btn-danger deletebutton addbuttontype2 addbutton3"
                                            paneid="{{$product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/wrong2.svg')}}" style="width: 18px">
                                    </button>
                                    <button class="btn text-danger deletebutton addbuttontype2 addbutton4 border-danger"
                                            paneid="{{$product->pane->where('client_id',\Illuminate\Support\Facades\Auth::guard('client')->id())->first()->id}}"
                                            style="border-radius: 0 !important;width: 80%">
                                        Supprimer
                                    </button>
                                </div>
                            @else
                                <form method="post" action="{{url('/addtopane')}}" class="d-flex">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    @foreach($product->colors as $color)
                                        @if($loop->first)
                                            <input type="hidden" name="selectedcolor" value="{{$color->id}}">
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="quantity" value="1">
                                    <button @if($product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton1" productid="{{$product->id}}"
                                            style="border-radius: 0 !important;background-color:#204f8c;height: 38px;width: 20% ">
                                        <img src="{{asset('media/icons/plus.svg')}}" style="width: 18px">
                                    </button>
                                    <button @if($product->quantity<=0) disabled="disabled"
                                            @endif class="btn addbutton addbutton2" productid="{{$product->id}}"
                                            style="width:80%;border-radius: 0 !important;border-color: #204f8c;color: #204f8c">
                                        Ajouter au panier
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row mt-5">
                    <p class="text-center" style="color: #204f8c;font-size: 22px;">0 result pour ce recherche</p>
                </div>
            @endif
        </div>
    </div>
</div>


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


<x-parts.footer/>
<script>
    $(document).ready(function () {
        $('#trier').change(function () {
            $.ajax({
                url: '/filtersearch',
                method: 'post',
                data: {
                    '_token': '{{csrf_token()}}',
                    'filtertype': $(this).val(),
                    'inputdata': $(this).attr('datatype')
                }, success: function (e) {
                    if (e.length > 0) {
                        $('.allproducts').html('')
                        for ($i = 0; $i < e.length; $i++) {
                            $alreadyadded = false
                            $paneid = 0;
                            for ($j = 0; $j < e[$i].pane.length; $j++) {
                                if (e[$i].pane[$j].client_id == '{{\Illuminate\Support\Facades\Auth::guard('client')->id()}}') {
                                    $alreadyadded = true;
                                    $paneid = e[$i].pane[$j].id
                                }
                            }
                            if (e[$i].quantity <= 0) {
                                $disabled = 'disabled="disabled"'
                                $message = '<span class="text-danger" style="font-size: 12.5px">' +
                                    '<img src="{{asset('media/icons/wrong.svg')}}" style="width: 10px">' +
                                    'Produit n\'est pas en stock </span>'
                            } else {
                                $disabled = ""
                                $message = '<span style="color: #559f45;font-size: 12.5px">' +
                                    '<img src="{{asset('media/icons/correct.svg')}}" style="width: 10px">' +
                                    'Produit en stock (' + e[$i].quantity + ')</span>'
                            }
                            if(e[$i].colors.length>0) {
                                $colorid = '<input type="hidden" name="selectedcolor" value="' + e[$i].colors[0].id + '">'
                            }
                            if ($alreadyadded == true) {
                                $('.allproducts').append('<div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-4 col-12 card text-center mb-4 pb-2">' +
                                    '<div> <a href="{{url('product/')}}/' + e[$i].id + '" class="articleimage">' +
                                    '<img src="{{asset('storage/products/')}}/' + e[$i].images[0].name + '" style="max-height: 40vh" class="img-fluid"/> </a></div>' +
                                    '<a href="{{url('product/')}}/' + e[$i].id + '" class="mt-1"' +
                                    'style="font-size: 14px;text-decoration: none;color: #6c6767">' + e[$i].title.substr(0, 20) + '</a>' +
                                    '<span class="mt-1" style="color:#204f8c;font-size: 20px ">' + e[$i].price + ' MAD</span>' +
                                    $message +
                                    '<div class="d-flex">' +
                                    ' <button class="btn btn-danger deletebutton addbuttontype2 addbutton3"' +
                                    'paneid="' + $paneid + '"' +
                                    'style="border-radius: 0 !important;height: 38px;width: 20% ">' +
                                    '<img src="{{asset('media/icons/wrong2.svg')}}" style="width: 18px">' +
                                    '</button>' +
                                    '<button class="btn text-danger deletebutton addbuttontype2 addbutton4 border-danger"' +
                                    'paneid="' + $paneid + '"' +
                                    'style="border-radius: 0 !important;width: 80%">' +
                                    'Supprimer' +
                                    '</button>' +
                                    '</div>')
                            } else {
                                $('.allproducts').append('<div class="col-xxl-3 col-xl-4 col-lg-4 col-md-6 col-sm-4 col-12 card text-center mb-4 pb-2">' +
                                    '<div> <a href="{{url('product/')}}/' + e[$i].id + '" class="articleimage">' +
                                    '<img src="{{asset('storage/products/')}}/' + e[$i].images[0].name + '" style="max-height: 40vh" class="img-fluid"/> </a></div>' +
                                    '<a href="{{url('product/')}}/' + e[$i].id + '" class="mt-1"' +
                                    'style="font-size: 14px;text-decoration: none;color: #6c6767">' + e[$i].title.substr(0, 20) + '</a>' +
                                    '<span class="mt-1" style="color:#204f8c;font-size: 20px ">' + e[$i].price + ' MAD</span>' +
                                    $message +
                                    '<form method="post" action="{{url('/addtopane')}}" class="d-flex">@csrf' +
                                    ' <input type="hidden" name="product_id" value="' + e[$i].id + '">' +
                                    $colorid +
                                    '<input type="hidden" name="quantity" value="1">' +
                                    '<button ' + $disabled + ' class="btn addbutton addbutton1" productid="' + e[$i].id + '"' +
                                    'style="border-radius: 0 !important;background-color:#204f8c;height: 38px;width: 20% ">' +
                                    '<img src="{{asset('media/icons/plus.svg')}}" style="width: 18px"></button>' +

                                    '<button ' + $disabled + ' class="btn addbutton addbutton2" productid="' + e[$i].id + '"' +
                                    'style="width:80%;border-radius: 0 !important;border-color: #204f8c;color: #204f8c">Ajouter au panier </button>' +
                                    '</form> </div>')
                            }
                        }
                    }
                }, error: function (e) {
                    console.log(e)
                }
            })
        })

        $(document).on('click','.deletebutton',function () {
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



        $(document).on('mouseover','.addbutton',function () {
            $(this).parent().children('.addbutton2').hide()
            $(this).parent().children('.addbutton1').css('width', '100%')
        })
        $(document).on('mouseout','.addbutton',function () {
            $(this).parent().children('.addbutton2').show()
            $(this).parent().children('.addbutton1').css('width', '38px')
        })

        $(document).on('mouseover','.addbuttontype2',function () {
            $(this).parent().children('.addbutton4').hide()
            $width = $(this).parent().children('.addbutton3').outerWidth() + $(this).parent().children('.addbutton4').outerWidth() + 'px'
            $(this).parent().children('.addbutton3').css('width', $width)
        })
        $(document).on('mouseout','.addbuttontype2',function () {
            $(this).parent().children('.addbutton4').show()
            $(this).parent().children('.addbutton3').css('width', '38px')
        })
        $(document).on('mouseover','.rapide,.articleimage',function () {
            $(this).parent().children('.articleimage').css('filter', 'blur(1px)')
            $(this).parent().children('.rapide').show()
        })
        $(document).on('mouseout','.rapide,.articleimage',function () {
            $(this).parent().children('.articleimage').css('filter', 'blur(0)')
            $(this).parent().children('.rapide').hide()

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

