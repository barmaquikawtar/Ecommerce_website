<!
<html>
<head>

    <x-parts.files/>
    <title>Commandes</title>
    <style>
        * {
            font-family: 'Noto Sans', sans-serif;
        }

        @media only screen and (max-width: 506px) {
            .imagearticle {
                width: 50%;
            }
        }

        @media only screen and (min-width: 507px) {
            .imagearticle {
                width: 30%;
            }
        }

    </style>

</head>
<body>
<header>
    <x-parts.header/>
</header>
<div class="container mt-5">
    <div class="row">
        <div class="col-12 ">
            <p style="color: #204f8c;font-size: 28px;font-weight: 600">MES COMMANDES</p>
        </div>
        @if($commandes)
            @foreach($commandes as $commande)
                <div class="col-md-8 col-lg-9 col-xl-9"
                     style="border-top: solid 1px #c7c0c0;border-left: solid 1px #c7c0c0;border-right: solid 1px #c7c0c0;@if($loop->last) border-bottom: solid 1px #c7c0c0; @endif">
                    <div class="mb-2 pb-2" style="">
                        @foreach($commande->items as $item)
                            <div class="d-flex pb-2 pt-2">
                                <a href="{{url('product/'.$item->product_id)}}" class="imagearticle">
                                    @foreach($item->product->images as $image)
                                        @if($loop->first)
                                            <img src="{{asset('storage/products/'.$image->name)}}" style="height: 100px"
                                                 class="img-fluid">
                                        @endif
                                    @endforeach
                                </a>
                                <div class="ms-5 d-flex flex-wrap justify-content-between" style="width: 100%">
                                    <a href="{{url('product/'.$item->product_id)}}"
                                       style="text-decoration: none;">
                                        <p class="mb-1"
                                           style="color: #204f8c;font-size: 20px">{{substr($item->product->title,0,30)}}</p>
                                        <p style="color: #f69c14;">{{$item->product->price}} MAD</p>
                                    </a>
                                    <div class="d-flex flex-column align-items-end">
                                        {{--                                        <input type="number" disabled="disabled"--}}
                                        {{--                                               class="form-control mb-2 product_quantity"--}}
                                        {{--                                               value="{{$item->pane->quantity}}"--}}
                                        {{--                                               name="quantity" min="1"--}}
                                        {{--                                               style="width: 70px;border-radius: 0">--}}
                                        <table class="table table-borderless" style="color: #6c6767">
                                            <tr>
                                                <td class="ps-0 ps-sm-1">Quantité</td>
                                                <td>{{$item->quantity}}</td>
                                            </tr>
                                            @if($item->color)
                                                <tr>
                                                    <td class="ps-0 ps-sm-1"> Coleur</td>
                                                    <td>
                                                        <div class="ms-1"
                                                             style="width:20px;height:20px;border-radius: 100px;background-color: {{$item->color->name}}"></div>
                                                    </td>
                                                </tr>
                                            @endif
                                        </table>
                                        {{--                                        <p style="color: #6c6767">Quantité : {{$item->pane->quantity}}</p>--}}
                                        {{--                                        <div class="d-flex align-items-center" style="color: #6c6767">--}}
                                        {{--                                            Coleur--}}
                                        {{--                                            <div class="ms-1"--}}
                                        {{--                                                 style="width:20px;height:20px;border-radius: 100px;background-color: {{$item->pane->color->name}}"></div>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            @if(!$loop->last)
                                <div class="d-flex justify-content-center">
                                    <hr style="width: 70%"/>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="col-md-4 col-lg-3 col-xl-3 d-flex align-items-center justify-content-center flex-column "
                     style="border-top: solid 1px #c7c0c0;border-right: solid 1px #c7c0c0;@if($loop->last) border-bottom: solid 1px #c7c0c0; @endif">
                    <table style="color: #204f8c;font-size: 18px;">
                        <tr>
                            <td class="pe-4 py-2">Prix total</td>
                            <td class="ps-4 py-2">{{$commande->total}} MAD</td>
                        </tr>
                        <tr>
                            <td class="pe-4 py-2">Statut</td>
                            <td class="ps-4 py-2">{{$commande->statut}}</td>
                        </tr>
                        <tr>
                            <td class="pe-4 py-2">Date</td>
                            <td class="ps-4 py-2">{{\Carbon\Carbon::createFromFormat('Y-m-d h:i:s',$commande->created_at)->format('d M Y')}}</td>
                        </tr>
                    </table>


                </div>
            @endforeach
        @else
            <p class="alert pt-3 pb-3 mt-5" style="background-color: #fcf8e3;color: #8a83a2">Vous n'avez pas encore
                passé de commande</p>
        @endif
    </div>
</div>
{{session('etat')}}
<div class="modal fade" id="paymantmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 0;border-color: transparent">
            <div class="modal-header mb-0 pb-0" style="border: none">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center justify-content-between pb-4">
                @if(session('etat')=='success')
                    <img src="{{asset('media/icons/success2.svg')}}" style="height: 70px"/>
                    <sapn style="font-size: 20px">Votre commande a eté enregistré success</sapn>
                @else
                    <img src="{{asset('media/icons/failed.svg')}}" style="height: 70px"/>
                    <sapn style="font-size: 20px">Votre commande a eté failed ressayer</sapn>
                @endif
            </div>

        </div>
    </div>
</div>
<x-parts.footer/>
<script>
    $(document).ready(function () {
        @if(session('etat'))
        $('#paymantmodal').modal('show')
        @endif
    })

</script>
</body>
</html>

