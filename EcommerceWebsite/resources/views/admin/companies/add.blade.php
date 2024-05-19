<x-app-layout>
    <style>

    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <form method="post" action="{{'/admin/addcompanies'}}" enctype="multipart/form-data" class="col-10 container-fluid mt-5 mb-5">
                <div class="d-flex align-items-center justify-content-between">
                    <p class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center"
                        style="font-size:30px;font-weight:600;color: #204f8c">
                        {{ __('Ajouter Companie') }}
                    </p>
                </div>
                @csrf
                <div class="row align-items-center">
                    <div class="col-4 col-sm-4 col-md-2 mt-3">
                        <x-label for="name" :value="__('Nom')"/>
                    </div>
                    <div class="col-8 col-md-4 mt-3">
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                                 required autofocus/>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 mt-3">
                        <x-label for="logo" :value="__('Logo')"/>
                    </div>
                    <div class="col-8 col-md-4 mt-3">
                        <x-input id="logo" class="block mt-1 w-full form-control" type="file" name="logo" :value="old('logo')"
                                 required autofocus/>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-4">
                        <button class="ml-3 ms-0 btn text-light px-4" style="background-color: #204f8c ;border-radius: 0">
                            {{ __('Ajouter') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
