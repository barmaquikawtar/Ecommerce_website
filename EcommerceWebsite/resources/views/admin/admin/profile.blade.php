<x-app-layout>
    <style>

    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <form method="post" action="{{url('/admin/updateprofile')}}" class="container-fluid col-10 my-5">
                @csrf
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h2 class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center"
                        style="font-size:30px;font-weight:600;color: #204f8c">
                        {{ __('Profile') }}
                    </h2>
                </div>
                <div class="row">
                    @if(session()->get('statut')=='updated')
                        <p class="alert  text-light" style="background-color: #204f8c;border-radius: 0">
                            Votre compte a ete mise à jour
                        </p>
                    @endif
{{--                    <div class="col-12">--}}
{{--                        <p style="color: #204f8c;font-size: 22px;font-weight: 550">Compte information</p>--}}
{{--                    </div>--}}
                </div>
                <div class="row align-items-center">
                    <div class="col-4 col-sm-4 col-md-2 mt-3">
                        <x-label for="name" :value="__('Nom')"/>
                    </div>
                    <div class="col-8 col-md-4 mt-3">
                        <x-input class="form-control" type="text" name="name" id="name" value="{{$admin->name}}"/>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 mt-3">
                        <x-label for="email" :value="__('Email')"/>
                    </div>
                    <div class="col-8 col-md-4 mt-3">
                        <x-input class="form-control" type="email" name="email" id="email" value="{{$admin->email}}"/>
                    </div>
                </div>
                <div class="row align-items-center mt-3" style="margin-top: 50px">
                    <div class="col-4 col-sm-4 col-md-2"></div>
                    <div class="col-8 ">
                        <x-input type="checkbox" id="modifypasswpord" name="modifypasswpord" />
                        <label for="modifypasswpord">Modifier mot de passe</label>
                    </div>
                </div>
                <div class="row align-items-center passwpordarea mt-4" style="display: none">
                    <div class="col-4 col-sm-4 col-md-2 mt-3">
                        <label for="currentpasswpord">Actuel mot de passe</label>
                    </div>
                    <div class="col-8 col-md-4 mt-3">
                        <x-input type="password" id="currentpasswpord" name="currentpasswpord" class="form-control"/>
                    </div>
                </div>
                <div class="row align-items-center mt-4 passwpordarea " style="display: none">
                    <div class="col-4 col-sm-4 col-md-2 mt-3">
                        <label for="nepassword">Nouveau mot de passe</label>
                    </div>
                    <div class="col-8 col-md-4 mt-3">
                        <x-input type="password" id="nepassword" name="nepassword" class="form-control"/>
                    </div>
                    <div class="col-4 col-sm-4 col-md-2 mt-3">
                        <label for="nepassword2">Nouveau mot de passe</label>
                    </div>
                    <div class="col-8 col-md-4 mt-3">
                        <x-input type="password" id="nepassword2" name="nepassword2" class="form-control"/>
                    </div>
                </div>
                <div class="col-4 col-sm-4 col-md-2 mt-4">
                    <button class="me-2 ms-2 btn mx-5 text-light" style="background-color: #204f8c;border-radius:0 ">Enregistrer
                    </button>
                </div>
                <div class="col-12 mt-4">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#modifypasswpord').click(function () {
                if (this.checked) {
                    $('.passwpordarea').show()
                } else {
                    $('.passwpordarea').hide()
                }
            })
        })
    </script>
</x-app-layout>
