<x-app-layout>
    <style>

    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <form method="post" action="{{'/admin/modifycompanies'}}" enctype="multipart/form-data" class="container-fluid col-10 mt-5 mb-5">
                @csrf
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center"
                        style="font-size:30px;font-weight:600;color: #204f8c">
                        {{ __('Mise a jour Companie') }}
                    </h2>
                </div>
                <div class="row align-items-center">
                    <input type="hidden" name="comapnyid" value="{{$company->id}}">
                    <div class="col-4 col-sm-4 col-md-2 mt-3">
                        <x-label for="name" :value="__('Nom')"/>
                    </div>
                    <div class="col-8 col-md-4 mt-3">
                        <x-input id="name" value="{{$company->name}}" class="block mt-1 w-full" type="text" name="name"
                                 required autofocus/>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 mt-3">
                        <x-label for="logo" :value="__('Logo')"/>
                    </div>
                    <div class="col-8 col-md-4 mt-3 ">
                        <img src="{{asset('storage/companies/'.$company->logo)}}" style="height: 50px">
                        <x-input id="logo" class="block mt-1 w-full form-control" type="file" name="logo" :value="old('logo')"
                                 required autofocus/>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-4">
                        <button class="ml-3 ms-0 btn text-light" style="background-color: #204f8c ;border-radius: 0;border-color: transparent">
                            {{ __('Enregistrer') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
