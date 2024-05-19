<x-app-layout>
    <style>

    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <form method="post" action="{{'/admin/addbestproduct'}}" class="col-10 my-5">
                @csrf
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h2 class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center"
                        style="font-size:30px;font-weight:600;color: #204f8c">
                        {{ __('Ajouter Meilleures vente') }}
                    </h2>
                </div>
                <div class="row align-items-center">
                    <div class="col-1">
                        <x-label for="name" :value="__('Categorie')"/>
                    </div>
                    <div class="col-3">
                        <select name="product_id" class="form-control">
                            @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <button class="ml-3 ms-0 px-4 btn text-light" style="background-color: #204f8c ;border-radius: 0;">
                            {{ __('Ajouter') }}
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
