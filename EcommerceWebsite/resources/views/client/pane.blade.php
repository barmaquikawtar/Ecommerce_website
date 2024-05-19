<!
<html>
<head>

    <x-parts.files/>
    <title>Panier</title>
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
<div class="container mt-2">
    <div class="row">
        <div class="col-12">
            <p style="color: #204f8c;font-size: 28px;font-weight: 600">PANIER</p>
        </div>
        <div class="col-12 col-lg-9">
            @foreach($panes as $pane)
                <div class="d-flex pb-2 pt-2"
                     style="border-bottom:solid 1px #c7c0c0;">
                    <a href="{{url('product/'.$pane->product_id)}}" class="imagearticle">
                        @foreach($pane->product->images as $image)
                            @if($loop->first)
                                <img src="{{asset('storage/products/'.$image->name)}}"
                                     class="img-fluid ">
                            @endif
                        @endforeach
                    </a>
                    <div class="ms-5 d-flex flex-wrap justify-content-between" style="width: 100%">
                        <a href="{{url('product/'.$pane->product_id)}}" style="text-decoration: none;">
                            <p class="mb-1" style="color: #204f8c;font-size: 20px">{{substr($pane->product->title,0,30)}}</p>
                            <p style="color: #f69c14;">{{$pane->product->price}} MAD</p>
                            @if($pane->color)
                                <div class="d-flex align-items-center" style="color: #6c6767">
                                    Coleur
                                    <div class="ms-1"
                                         style="width:20px;height:20px;border-radius: 100px;background-color: {{$pane->color->name}}"></div>
                                </div>
                            @endif
                        </a>
                        <div class="d-flex flex-column align-items-start align-items-sm-end mt-2 mt-sm-0">
                            <p class="mb-1" style="font-size: 18px;color: #204f8c;font-weight: 600">
                                <span class="pane{{$pane->id}}price">{{$pane->product->price * $pane->quantity}}</span>
                                MAD
                            </p>
                            <input type="number" class="form-control mb-2 product_quantity" value="{{$pane->quantity}}"
                                   name="quantity" min="1" pane_id="{{$pane->id}}"
                                   style="width: 70px;border-radius: 0">
                            <img src="{{asset('media/icons/trash.svg')}}" class="deletepane" paneid="{{$pane->id}}"
                                 style="height: 20px;cursor: pointer">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <form method="get" action="{{url('/Commande')}}" class="col-12 col-lg-3" style="text-decoration: none">
            @csrf
            <div class="p-3" style="border:solid 1px #dedbdb;color: #6c6767">
                <div class="d-flex justify-content-between align-items-center">
                    <p class="mb-0">{{count($panes)}} articles</p>
                    <p class="mb-0 " style="font-size: 19px;"><span class="totalprice">{{$total}}</span> MAD</p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p>Livraison<br>(entre 5 et 10 jours)</p>
                    <p style="font-size: 19px;">gratuit</p>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <p style="font-size: 19px;">TOTAL</p>
                    <p style="font-size: 19px;color: #f69c14"><span class="totalprice">{{$total}}</span> MAD</p>
                </div>
                <button class="btn text-light mt-4" style="background-color: #f69c14;width: 100%;border-radius: 0">
                    Commander
                </button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="Commandesuccessmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content" style="border-radius: 0">
            <div class="modal-header border-0 mb-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <img src="{{asset('media/icons/correct.svg')}}" class="img-fluid me-3" style="height: 50px">
                <p class="mb-0 text-success">Votre commande a été passé success</p>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deletemodalsucess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" style="border-radius: 0">
            <div class="modal-header border-0 mb-0 pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex align-items-center">
                <img src="{{asset('media/icons/wrong.svg')}}" class="img-fluid me-2" style="height: 30px">
                <p class="mb-0 text-danger">Produit supprimer </p>
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


        @if(session()->get('statut')=='deleted')
        $('#deletemodalsucess').modal('show')
        @elseif(session()->get('statut')=='commandepassed')
        $('#Commandesuccessmodal').modal('show')
        @endif
        $('.deletepane').click(function () {
            $('#pane_id').val($(this).attr('paneid'))
            $('#deletemodal').modal('show')

        })
        $('.product_quantity').on('click keyup', function () {
            $paneid = $(this).attr('pane_id')
            $.ajax({
                url: '/changepanequantity',
                method: 'post',
                data: {
                    '_token': '{{csrf_token()}}',
                    'pane_id': $paneid,
                    'quantity': $(this).val()
                }, success: function (e) {
                    console.log(e)
                    $('.totalprice').text(e.total)
                    $('.pane' + $paneid + 'price').text(e.price)
                }
            })
        })
    })

</script>
</body>
</html>

