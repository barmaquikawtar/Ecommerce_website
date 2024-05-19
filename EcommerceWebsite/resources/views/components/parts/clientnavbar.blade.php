<div class="d-block d-md-none" style="top:50%;position: sticky;z-index: 2">
    <a  data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
        <img src="{{asset('media/icons/circle.svg')}}" style="cursor:pointer;height: 50px;background-color: transparent !important;">
    </a>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="pt-3 " style="border: solid 1px rgb(238,228,228)">
                <p class="mb-0 ps-2" style="font-size:20px;font-weight: 600;color: #204f8c;">Neuf</p>
                <p style="border: solid 2px #204f8c;background-color: #204f8c"></p>
                @foreach($newproudcts as $newproudct)
                    <a href="{{url('/product/'.$newproudct->id)}}" class="row pb-3 pt-3 ps-2"
                       style="text-decoration: none;border-bottom: solid 1px rgb(238,228,228)">
                        <div class="col-5">
                            @foreach($newproudct->images as $image)
                                @if($loop->first)
                                    <img src="{{asset('storage/products/'.$image->name)}}" class="img-fluid">
                                @endif
                            @endforeach
                        </div>
                        <div class="col-7">
                            <p class="mb-2" style="font-size: 14px;color: #6c6767">{{$newproudct->title}}</p>
                            <p style="color: #204f8c;font-weight: 600">{{$newproudct->price}} MAD</p>
                        </div>
                    </a>
                @endforeach
                <div class="text-center">
                    <a href="{{url('/statut/Neuf')}}" class="btn btn-sm hoverbutton "
                       style="border-color: #204f8c;color:#204f8c;border-radius: 0 !important;width:90%">
                        Tous les produits Neuf
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-3" style="border: solid 1px rgb(238,228,228)">
                <p class="mb-0 ps-2" style="font-size:20px;font-weight: 600;color: #204f8c;">Occasion</p>
                <p style="border: solid 2px #204f8c;background-color: #204f8c"></p>
                @foreach($usedproudcts as $usedproudct)
                    <a href="{{url('/product/'.$usedproudct->id)}}" class="row pb-3 pt-3 ps-2"
                       style="text-decoration: none;border-bottom: solid 1px rgb(238,228,228)">
                        <div class="col-5">
                            @foreach($usedproudct->images as $image)
                                @if($loop->first)
                                    <img src="{{asset('storage/products/'.$image->name)}}" class="img-fluid">
                                @endif
                            @endforeach
                        </div>
                        <div class="col-7">
                            <p class="mb-2" style="font-size: 14px;color: #6c6767">{{$usedproudct->title}}</p>
                            <p style="color: #204f8c;font-weight: 600">{{$usedproudct->price}} MAD</p>
                        </div>
                    </a>
                @endforeach
                <div class="text-center">
                    <a href="{{url('/statut/Occasion')}}" class="btn btn-sm hoverbutton"
                       style="border-color: #204f8c;color:#204f8c;border-radius: 0 !important;width: 90%">
                        Tous les produits Occasion
                    </a>
                </div>
            </div>
            <div class="mt-4 pt-3" style="border: solid 1px rgb(238,228,228)">
                <p class="mb-0 ps-2" style="font-size:20px;font-weight: 600;color: #204f8c;">Meilleures ventes</p>
                <p style="border: solid 2px #204f8c;background-color: #204f8c"></p>
                @foreach($bestproducts as $bestproduct)
                    <a href="{{url('product/'.$bestproduct->product->id)}}" class="row pb-3 pt-3 ps-2"
                       style="text-decoration: none;border-bottom: solid 1px rgb(238,228,228)">
                        <div class="col-5">
                            @foreach($bestproduct->product->images as $image)
                                @if($loop->first)
                                    <img src="{{asset('storage/products/'.$image->name)}}" class="img-fluid">
                                @endif
                            @endforeach
                        </div>
                        <div class="col-7">
                            <p class="mb-2" style="font-size: 14px;color: #6c6767">{{$bestproduct->product->title}}</p>
                            <p style="color: #204f8c;font-weight: 600">{{$bestproduct->product->price}} MAD</p>
                        </div>
                    </a>
                @endforeach
                <div class="text-center">
                    <a href="{{url('/meilleures_ventes')}}" class="btn btn-sm hoverbutton"
                       style="border-color: #204f8c;color:#204f8c;border-radius: 0 !important;width: 90%">
                        Toutes les meilleures ventes
                    </a>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="col-lg-3 col-md-4 d-none d-md-block">
    <div class="pt-3 " style="border: solid 1px rgb(238,228,228)">
        <p class="mb-0 ps-2" style="font-size:20px;font-weight: 600;color: #204f8c;">Neuf</p>
        <p style="border: solid 2px #204f8c;background-color: #204f8c"></p>
        @foreach($newproudcts as $newproudct)
            <a href="{{url('/product/'.$newproudct->id)}}" class="row pb-3 pt-3 ps-2"
               style="text-decoration: none;border-bottom: solid 1px rgb(238,228,228)">
                <div class="col-5">
                    @foreach($newproudct->images as $image)
                        @if($loop->first)
                            <img src="{{asset('storage/products/'.$image->name)}}" class="img-fluid">
                        @endif
                    @endforeach
                </div>
                <div class="col-7">
                    <p class="mb-2" style="font-size: 14px;color: #6c6767">{{$newproudct->title}}</p>
                    <p style="color: #204f8c;font-weight: 600">{{$newproudct->price}} MAD</p>
                </div>
            </a>
        @endforeach
        <div class="text-center">
            <a href="{{url('/statut/Neuf')}}" class="btn btn-sm hoverbutton "
               style="border-color: #204f8c;color:#204f8c;border-radius: 0 !important;width:90%">
                Tous les produits Neuf
            </a>
        </div>
    </div>
    <div class="mt-4 pt-3" style="border: solid 1px rgb(238,228,228)">
        <p class="mb-0 ps-2" style="font-size:20px;font-weight: 600;color: #204f8c;">Occasion</p>
        <p style="border: solid 2px #204f8c;background-color: #204f8c"></p>
        @foreach($usedproudcts as $usedproudct)
            <a href="{{url('/product/'.$usedproudct->id)}}" class="row pb-3 pt-3 ps-2"
               style="text-decoration: none;border-bottom: solid 1px rgb(238,228,228)">
                <div class="col-5">
                    @foreach($usedproudct->images as $image)
                        @if($loop->first)
                            <img src="{{asset('storage/products/'.$image->name)}}" class="img-fluid">
                        @endif
                    @endforeach
                </div>
                <div class="col-7">
                    <p class="mb-2" style="font-size: 14px;color: #6c6767">{{$usedproudct->title}}</p>
                    <p style="color: #204f8c;font-weight: 600">{{$usedproudct->price}} MAD</p>
                </div>
            </a>
        @endforeach
        <div class="text-center">
            <a href="{{url('/statut/Occasion')}}" class="btn btn-sm hoverbutton"
               style="border-color: #204f8c;color:#204f8c;border-radius: 0 !important;width: 90%">
                Tous les produits Occasion
            </a>
        </div>
    </div>
    <div class="mt-4 pt-3" style="border: solid 1px rgb(238,228,228)">
        <p class="mb-0 ps-2" style="font-size:20px;font-weight: 600;color: #204f8c;">Meilleures ventes</p>
        <p style="border: solid 2px #204f8c;background-color: #204f8c"></p>
        @foreach($bestproducts as $bestproduct)
            <a href="{{url('product/'.$bestproduct->product->id)}}" class="row pb-3 pt-3 ps-2"
               style="text-decoration: none;border-bottom: solid 1px rgb(238,228,228)">
                <div class="col-5">
                    @foreach($bestproduct->product->images as $image)
                        @if($loop->first)
                            <img src="{{asset('storage/products/'.$image->name)}}" class="img-fluid">
                        @endif
                    @endforeach
                </div>
                <div class="col-7">
                    <p class="mb-2" style="font-size: 14px;color: #6c6767">{{$bestproduct->product->title}}</p>
                    <p style="color: #204f8c;font-weight: 600">{{$bestproduct->product->price}} MAD</p>
                </div>
            </a>
        @endforeach
        <div class="text-center">
            <a href="{{url('/meilleures_ventes')}}" class="btn btn-sm hoverbutton"
               style="border-color: #204f8c;color:#204f8c;border-radius: 0 !important;width: 90%">
                Toutes les meilleures ventes
            </a>
        </div>
    </div>
</div>
