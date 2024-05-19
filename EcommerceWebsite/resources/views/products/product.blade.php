<!
<html>
<head>

    <x-parts.files/>
    <title>{{$product->title}}</title>
    <style>
        * {
            font-family: 'Noto Sans', sans-serif;
        }

        a {
            text-decoration: none;
        }

        /*****article slider****/
        .swiper-container {
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

        .swiper-container {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        .product-swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .productmySwiper2 {
            height: 80%;
            width: 100%;
        }

        .productmySwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .productmySwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .productmySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }

        .product-swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /*******related products******/
        .relatedproduct-swiper-container {
            width: 100%;
            height: 100%;
        }

        .relatedproduct-swiper-slide {
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

        .relatedproduct-swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .firstcolor {
            box-shadow: 0px 0px 21px 13px rgba(68, 168, 227, 0.75);
        }
    </style>

</head>
<body>
<header>
    <x-parts.header/>
</header>
<div class="container mt-5">
    <div class="row">
        <div class="col-12" style="color:#6c6767 ;font-size: 15px">
            <a href="{{url('Category/'.$product->childcategory->category->id)}}" class="pe-2"
               style="color:#6c6767;border-right: solid 1px #6c6767">{{$product->childcategory->category->name}}</a>
            <a href="{{url('/SousCategory/'.$product->childcategory->id)}}" class="pe-2 ps-2"
               style="color:#6c6767;border-right: solid 1px #6c6767">{{$product->childcategory->name}}</a>
            <a href="{{url('product/'.$product->id)}}" class="ps-2" style="color:#6c6767">{{$product->title}}</a>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-5" style="max-height: 70vh">
            <div
                style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff"
                class="swiper-container productmySwiper2">
                <div class="swiper-wrapper product-swiper-wrapper">
                    @foreach($product->images as $image)
                        <div class="swiper-slide product-swiper-slide">
                            <img src="{{asset('storage/products/'.$image->name)}}" class="img-fluid"/>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-button-next product-swiper-button-next" style="color: #204f8c"></div>
                <div class="swiper-button-prev product-swiper-button-prev" style="color: #204f8c"></div>
            </div>
            <div thumbsSlider="" class="swiper-container productmySwiper">
                <div class="swiper-wrapper product-swiper-wrapper">
                    @foreach($product->images as $image)
                        <div class="swiper-slide product-swiper-slide">
                            <img src="{{asset('storage/products/'.$image->name)}}" class="img-fluid"/>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <form form method="POST" action="{{url('/addtopane')}}" class="col-lg-7">
            @csrf
            <input type="hidden" name="product_id" value="{{$product->id}}">
            <p style="color: #204f8c;font-size: 30px;font-weight: 535">{{$product->title}}</p>
            <p style="color: #204f8c;font-size: 22px;font-weight: 535">{{$product->price}} MAD</p>
            <p class="p-md-3 pt-0 p-md-3"
               style="font-size:15px;color:#6c6767;border-top: solid 1px #d4cccc;border-bottom: solid 1px #d4cccc">{!!$product->presentation!!}</p>
            <div style="border-top: solid 1px #d4cccc;border-bottom: solid 1px #d4cccc">
                <img src="{{asset('storage/companies/'.$product->company->logo)}}" style="height: 100px;">
            </div>
            <p class="d-flex justify-content-between mt-3 pt-3 pb-3 mb-3"
               style="color: #204f8c;font-weight: 550;border-top:solid 1px #dcd6d6;border-bottom:solid 1px #dcd6d6">
                <span>État</span>
                <span>{{$product->statut}}</span>
            </p>
            @if($product->colors->count()>0)
                <div class="d-flex justify-content-between mt-3 pt-3 pb-3 mb-3"
                     style="color: #204f8c;font-weight: 550;border-top:solid 1px #dcd6d6;border-bottom:solid 1px #dcd6d6">
                    <span>Coleurs</span>
                    <div class="d-flex">
                        @foreach($product->colors as $color)
                            @if($loop->first)
                                <input type="hidden" name="selectedcolor" id="selectedcolor" value="{{$color->id}}">
                            @endif
                            <div class="ms-2 selectcolor  @if($loop->first) firstcolor @endif" colorid="{{$color->id}}"
                                 style="background-color:{{$color->name}};cursor:pointer;border-radius: 100px;height: 20px;width: 20px"></div>
                        @endforeach
                    </div>
                </div>
            @endif
            <div class="text-end">
                @if($product->quantity>=1)
                    <p style="color: #559f45;font-size: 12.5px">
                        <img src="{{asset('media/icons/correct.svg')}}" style="width: 15px">
                        Produit en stock <span style="font-weight: 600">({{$product->quantity}} produits)
                        </span>
                    </p>
                @else
                    <p class="text-danger" style="color: #559f45;font-size: 12.5px">
                        <img src="{{asset('media/icons/wrong.svg')}}" style="width: 15px">
                        Produit n'est pas en stock
                    </p>
                @endif

                <div class="d-flex justify-content-end mt-2">
                    <input class="form-control me-3" type="number" name="quantity" min="1" value="1"
                           style="border-radius:0;width: 70px!important;"/>
                    @if($ifalreadyinpane)
                        <button class="btn btn-danger addbuttontype2 addbutton3"
                                style="border-radius: 0 !important;height: 38px;width: 38px ">
                            <img src="{{asset('media/icons/wrong2.svg')}}" style="width: 18px">
                        </button>
                        <button class="btn text-danger addbuttontype2 addbutton4 border-danger"
                                style="border-radius: 0 !important;">
                            Supprimer du panier
                        </button>
                    @else
                        <button class="btn addbuttontype2 addbutton3"
                                style="border-radius: 0 !important;background-color:#204f8c;height: 38px;width: 38px ">
                            <img src="{{asset('media/icons/plus.svg')}}" style="width: 18px">
                        </button>
                        <button class="btn addbuttontype2 addbutton4"
                                style="border-radius: 0 !important;border-color: #204f8c;color: #204f8c">
                            Ajouter au panier
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>
    <div class="row" style="margin-top: 100px">
        <div class="col-lg-6">
            <p style="color:#204f8c;font-size: 20px;border-bottom: solid 2px #204f8c">
                Description
            </p>
            {!!$product->specification !!}
        </div>
        <div class="col-lg-6">
            <p style="color:#204f8c;font-size: 20px;border-bottom: solid 2px #204f8c">
                Fiche technique
            </p>
            {!!$product->Technical_sheet !!}
        </div>
    </div>
    <div class="row mt-5">
        <p class="mb-3" style="color: #204f8c;font-size: 20px;font-weight: 600">PRODUITS DANS LA MÊME CATÉGORIE :</p>
        <div class="swiper-container relatedproduct-mySwiper">
            <div class="swiper-wrapper relatedproduct-swiper-wrapper">
                @foreach($relatedproducts as $relatedproduct)
                    <a href="{{$relatedproduct->id}}" style="text-decoration: none;" class="swiper-slide relatedproduct-swiper-slide" >
                        <div>
                            @foreach($relatedproduct->images as $image)
                                @if($loop->first)
                                    <img src="{{asset('storage/products/'.$image->name)}}" style="height: 200px" class="img-fluid">
                                @endif
                            @endforeach
                            <p style="color: #6c6767;font-size: 15px">{{$relatedproduct->title}}</p>
                            <p style="color: #204f8c;font-size: 15px">{{$relatedproduct->price}} MAD</p>
                        </div>
                    </a>
                @endforeach
            </div>
            <div class="swiper-button-next relatedproduct-swiper-button-next" style="color: #204f8c"></div>
            <div class="swiper-button-prev relatedproduct-swiper-button-prev" style="color: #204f8c"></div>
        </div>
    </div>
</div>


<x-parts.footer/>
<div class="modal fade" id="addedtopanesuccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content " style="border-radius: 0">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-5">
                        @foreach($product->images as $image)
                            @if($loop->first)
                                <img src="{{asset('storage/products/'.$image->name)}}"
                                     class="img-fluid addedtopanesuccessimage"/>
                            @endif
                        @endforeach
                    </div>
                    <div class="col-7">
                        <div class="d-flex align-items-center mb-5">
                            <img src="{{asset('media/icons/correct3.svg')}}" style="height: 20px">
                            <p style="color: #f69c14" class="mb-0 ms-2">Produit ajouté au panier avec succès</p>
                        </div>
                        <p class="mb-1 addedtopanesuccesstitle" style="color: #204f8c;font-size: 17px;font-weight: 600">
                            {{$product->title}}
                        </p>
                        <p class="mb-1" style="color: #f69c14;font-size: 18px;font-weight: 550"><span
                                class="addedtopanesuccessprice">{{$product->price * session()->get('quantity')}}</span>
                            MAD</p>
                        <p style="color: #6c6767;font-size: 18px;font-weight: 400">Quantité
                            : {{session()->get('quantity')}}<span
                                class="addedtopanesuccessquantity"></span></p>
                        <div class="alert mt-5"
                             style="background-color:rgb(246,156,20,0.3);border-radius: 0;color: #f69c14 ">
                            <p class="mb-1">Il y a 5 articles dans votre panier.</p>
                            <p class="mb-1"><b>Total :</b> <span class="">50005</span> MAD</p>
                            <div class="d-flex">
                                <button class="btn btn-sm hoverbutton mt-2 me-2"
                                        style="border-color: #204f8c;color: #204f8c;border-radius: 0;background-color: rgb(32,79,140,0.2)">
                                    Continuer mes achats
                                </button>
                                <button class="btn btn-sm mt-2 d-flex align-items-center"
                                        style="border-color: #f69c14;color: white;border-radius: 0;background-color: #f69c14">
                                    <img src="{{asset('media/icons/correct2.svg')}}" style="width: 20px">
                                    <span class="ms-2">Commander</span>
                                </button>
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

<script>
    $(document).ready(function () {
        @if(session()->get('statut')=='addedtopane')
        $('#addedtopanesuccess').modal('show')
        @elseif(session()->get('statut')=='deletedpane')
        $('#deletedpanesuccess').modal('show')
        @endif
        $('.selectcolor').click(function () {
            $('.selectcolor').css('border', 'none')
            $('.selectcolor').css('box-shadow', 'none')
            $(this).css('box-shadow', '0px 0px 21px 13px rgba(68,168,227,0.75)')
            $('#selectedcolor').val($(this).attr('colorid'))

        })
        $('table').addClass('table')

        $('.addbutton').hover(function () {
            $(this).parent().children('.addbutton2').hide()
            $width = $(this).parent().children('.addbutton3').outerWidth() + $(this).parent().children('.addbutton4').outerWidth() + 'px'

            $(this).parent().children('.addbutton1').css('width', $width)

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
    })
    var swiper = new Swiper(".productmySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
    });
    var swiper2 = new Swiper(".productmySwiper2", {
        loop: true,
        spaceBetween: 10,
        navigation: {
            nextEl: ".product-swiper-button-next",
            prevEl: ".product-swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
    if(window.innerWidth>=1419){
        $nb=5
    }else if(window.innerWidth>=925 && window.innerWidth<=1418){
        $nb=4
    }
    else if(window.innerWidth>=746 && window.innerWidth<=924){
        $nb=3
    } else if(window.innerWidth>=542 && window.innerWidth<=745){
        $nb=2
    }
    /******related product****/
    var swiper = new Swiper(".relatedproduct-mySwiper", {
        slidesPerView: $nb,
        spaceBetween: 30,
        slidesPerGroup: 1,
        loop: true,
        loopFillGroupWithBlank: true,
        navigation: {
            nextEl: ".relatedproduct-swiper-button-next",
            prevEl: ".relatedproduct-swiper-button-prev",
        },
    });
</script>
</body>
</html>

