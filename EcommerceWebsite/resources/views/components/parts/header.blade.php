<style>
    .navbar {
        font-size: 16px;
    }

    .navbar .navbar-nav .nav-item a {
        color: white !important;
    }

    .navbar .navbar-nav .nav-item {
        margin-right: 15px;
        padding-left: 10px;
        padding-right: 10px;
    }

    .navbar .navbar-nav .nav-item:first-child {
        margin-left: 0;
    }

    header .part2, header .part1 {
        color: #6c6767;
    }

    header .part2 a, header .part1 a {
        text-decoration: none;
        color: #6c6767;
    }

    header .part1 .side1 ul li {
        border-right: solid 1px #bbb6b6;
        padding-right: 15px;
        padding-left: 15px;
    }

    header .part1 {
        font-size: 12px;
        -webkit-box-shadow: 0px 8px 8px 0px rgba(0, 0, 0, 0.58);
        box-shadow: 0px 8px 8px 0px rgba(0, 0, 0, 0.58) !important;
    }

    header .part1 li:hover a {
        color: #3265ac;
    }

    .navbar .dropdown-menu .dropdown-item:hover {
        background-color: #3c66bb;
    }

    .searchsuggestions li {
        cursor: pointer;
    }

    .form-control:focus {
        box-shadow: none !important;
        -webkit-box-shadow: none !important;
        border-color: #ced4da;
    }
</style>
<div class="container-fluid part1 mt-1 pt-2 pb-2" style="background-color: #ffffff;">
    <div class="row align-items-center">
        <div class="col-sm-3 col-lg-3 side1 mb-4 mb-sm-0">
            <ul class="d-flex pb-0 mb-0" style="list-style: none">
                <li class="d-none d-md-block">
                    <a href="{{url('/')}}">
                        <span>Accueil</span>
                        {{--                        <img src="{{asset('media/icons/user.svg')}}" style="height: 20px"/>--}}
                    </a>
                </li>
                <li class="d-block d-md-none">
                    <a href="{{url('/dashboard')}}">
                        <img src="{{asset('media/icons/user.svg')}}" style="height:18px;">
                    </a>
                </li>
                <li class="d-block d-md-none">
                    <a href="{{url('/panier')}}" class="d-flex align-items-start">
                        <img src="{{asset('media/icons/panier.svg')}}" style="height:18px;">
                        @if($nbpane>0)
                            <p class="mb-0 d-flex text-light justify-content-center align-items-center rounded-circle"
                               style="font-size: 14px;background-color: #f69c14;border-radius: 100%;width: 16px;height: 16px"> {{$nbpane}}</p>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{url('/message')}}">
                        <span class="d-none d-md-block">Contact</span>
                        <img class="d-block d-md-none" src="{{asset('media/icons/mail.svg')}}" style="height:18px;">
                    </a>
                </li>
            </ul>
        </div>
        <div class=" col-sm-9 col-lg-9 ">
            <ul class="d-flex  justify-content-start justify-content-sm-end  align-items-center flex-wrap pb-0 mb-0 "
                style="list-style: none">
                <li class="d-flex  ps-sm-3 pe-3 mt-2 mt-sm-0"
                    style="cursor: pointer;/*border-left: solid 1px #6c6767*/">
                    <img src="{{asset('media/icons/fixphone.svg')}}" class="me-2" style="height: 18px">
                    <span class="me-1">Magasin</span>
                    <span style="font-weight: 600;color: #f69c14">0554 7823 669</span>

                </li>
                <li class="d-flex align-items-center mt-2 mt-sm-0 " style="cursor: pointer">
                    <img src="{{asset('media/icons/telephone.svg')}}" class="" style="height: 18px">
                    <span class="me-1">Services Client</span>
                    <span style="font-weight: 600;color: #f69c14">0554 7823 669</span>
                </li>
            </ul>

        </div>
    </div>
</div>
<div class="container-fluid part2" style="background-color: #f6f6f6 !important;">
    <div class="row d-flex align-items-center">
        <a href="{{url('/')}}" class="col-sm-6 col-md-3">
            <img src="{{asset('media/icons/logo.jpg')}}" style="height: 120px">
        </a>
        <form method="get" action="{{url('/search')}}" class="col-sm-6 col-md-3 d-flex dropdown"
              style="color: #6c6767;">
            <input type="text" class="form-control searchinput" data-bs-toggle="dropdown" aria-expanded="false"
                   style="border-radius: 0 !important;background-color: #f3f1f1;font-size: 13px!important;" autocomplete="off"
                   name="inputdata"
                   placeholder="Rechercher un produit..." autocomplete="false">
            <ul class="dropdown-menu searchsuggestions" aria-labelledby="dropdownMenuButton1"
                style="font-size: 13px;width: 93%;border-radius: 0;background-color: #f3f1f1 !important;">
            </ul>
            <button class="btn" style="background-color: #f69c14;border-radius: 0 !important;">
                <img src="{{asset('media/icons/search.svg')}}" style="height: 20px">
            </button>
        </form>
        <div class="col-4 text-end pe-5 d-none d-md-block" style="border-right: solid 1px #204F8C">
            @if(\Illuminate\Support\Facades\Auth::guard('client')->check())
                <a href="{{url('/dashboard')}}" class="mb-0 " style="font-size: 18px;font-weight: 600;color:#204F8C ">Votre
                    compte</a>
            @else
                <p class="mb-0 " style="font-size: 18px;font-weight: 600;color:#204F8C ">Votre compte</p>
            @endif
            <div class="d-flex justify-content-end mt-1" style="font-size: 14px">
                @if(\Illuminate\Support\Facades\Auth::guard('client')->check())
                    <a href="{{url('/dashboard')}}" class="mb-0 pe-3 pb-0" style="border-right: solid 1px #c6c2c2; ">
                        {{ \Illuminate\Support\Facades\Auth::guard('client')->user()->user_name }}
                    </a>
                    <form method="post" action="{{url('logout')}}" class="ps-3 mb-0 pb-0">
                        @csrf
                        <button class="p-0" style="background-color: transparent;border: none;color: #6c6767">
                            Déconnexion
                        </button>
                    </form>
                @else
                    <span class="pe-3" style="border-right: solid 1px #c6c2c2;font-size: 14px">Bienvenue</span>
                    <a class="ps-3" href="{{url('/connexion')}}" style="font-size: 14px">Identifiez-vous</a>
                @endif
            </div>
        </div>
        <div class="col-2 text-end ps-5 d-none d-md-block">
            <a href="{{url('/panier')}}" class="d-flex align-items-center">
                <div>
                    <p class="mb-0 me-1" style="font-size: 18px;font-weight: 600;color:#204F8C ">Panier</p>
                    @if(\Illuminate\Support\Facades\Auth::guard('client')->check())
                        <p class="mb-0" style="font-size: 14px">{{$total}} MAD</p>
                    @endif
                    @if($nbpane==0)
                        <p class="mb-0" style="font-size: 14px"> (vide)</p>
                    @endif
                </div>
                <div class="d-flex align-items-start">
                    <img src="{{asset('media/icons/panier.svg')}}" style="height:40px;">
                    @if($nbpane>0)
                        <p class="mb-0 text-light "
                           style="font-size: 14px;background-color: #f69c14;padding: 1px 7px 1px 7px;border-radius: 100%"> {{$nbpane}}</p>
                    @endif
                </div>
            </a>
        </div>
    </div>
</div>
<nav class="navbar navbar-expand-lg  pt-0 pb-0 "
     style="background-color: #204F8C !important;border-radius: 0!important;border: none!important;">
    <div class="container-fluid ps-0">
        {{--        <a class="navbar-brand d-block d-lg-none" href="{{url('/')}}">--}}
        {{--            <img src="{{asset('media/icons/home.svg')}}" style="height: 25px">--}}
        {{--        </a>--}}
        <button class="navbar-brand navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <img src="{{asset('/media/icons/navbar.svg')}}" style="height: 25px"/>
        </button>
        <a class="navbar-brand d-block d-lg-none" href="{{url('/')}}">
            <img src="{{asset('media/icons/home.svg')}}" style="height: 25px">
        </a>
        <div class="d-flex d-lg-none">
            <a class="nav-link d-flex text-light align-items-center pe-4 ps-4" href="{{url('/statut/Neuf')}}"
               style="background-color: #f69c14 !important;border-right: solid 1px rgb(255,255,255,0.5);border-top: solid 1px orange;">
                <img src="{{asset('media/icons/new.svg')}}" class="me-2" style="height: 15px">
                <span>Neuf </span>
            </a>
            <a class="nav-link d-flex text-light align-items-center pe-2 pe-sm-4 ps-2 ps-sm-4" href="{{url('/statut/Occasion')}}"
               style="background-color: #f69c14 !important;border-top: solid 1px orange;">
                <img src="{{asset('media/icons/occasion.svg')}}" class="me-2" style="height: 15px">
                <span>Occasion</span>
            </a>
        </div>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mt-5 mt-lg-0">
                <li class="nav-item d-none d-lg-block" style="background-color: #3768a8">
                    <a class="nav-link active" aria-current="page" href="{{url('/')}}">
                        <img src="{{asset('media/icons/home.svg')}}" style="height: 25px">
                    </a>
                </li>

                @foreach($categories as $category)
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="{{url('Category/'.$category->id)}}" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">{{$category->name}}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown"
                            style="background-color: #204f8c !important;border-radius: 0 !important;">
                            <li>
                                <a class="dropdown-item" href="{{url('Category/'.$category->id)}}">Tous</a>
                            </li>
                            @foreach($category->child_categories as $childcategory)
                                <li><a class="dropdown-item"
                                       href="{{url('SousCategory/'.$childcategory->id)}}">{{$childcategory->name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="d-none d-lg-flex">
            <a class="nav-link d-flex text-light align-items-center pe-4 ps-4" href="{{url('/statut/Neuf')}}"
               style="background-color: #f69c14 !important;border-right: solid 1px rgb(255,255,255,0.5);border-top: solid 1px orange;">
                <img src="{{asset('media/icons/new.svg')}}" class="me-2" style="height: 15px">
                <span>Neuf </span>
            </a>
            <a class="nav-link d-flex text-light align-items-center pe-2 pe-sm-4 ps-2 ps-sm-4" href="{{url('/statut/Occasion')}}"
               style="background-color: #f69c14 !important;border-top: solid 1px orange;">
                <img src="{{asset('media/icons/occasion.svg')}}" class="me-2" style="height: 15px">
                <span>Occasion</span>
            </a>
        </div>

    </div>
</nav>

<script>
    $('.searchinput').keyup(function () {
        $.ajax({
            url: '/searchsuggestion',
            method: 'get',
            data: {
                inputdata: $(this).val()
            },
            success: function (e) {
                console.log(e)
                $('.searchsuggestions').html('')
                if (e.length == 0) {
                    $('.searchsuggestions').html('<li><a class="dropdown-item">0 resulte pour ce recherche</a></li>')
                } else {
                    for ($i = 0; $i < e.length; $i++) {
                        $('.searchsuggestions').append('<li><a href="{{url('product')}}/' + e[$i].id + '" class="dropdown-item">' + e[$i].title + '</a></li>')
                    }
                }


            }
        })
    })
</script>
