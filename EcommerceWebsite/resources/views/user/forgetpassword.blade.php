<!
<html>
<head>

    <x-parts.files/>
    <title>Home</title>
    <style>
        * {
            font-family: 'Noto Sans', sans-serif;
        }
    </style>

</head>
<body>
<header>
    <x-parts.header/>
</header>
<div class="container mt-2">
    <div class="row" style="border-bottom:  solid 1px #d5d3d3">
        <div class="col-12">
            <p class="mt-2" style="color: #204f8c;font-size: 22px;font-weight: 600">MOT DE PASSE OUBLIÉ ?</p>
        </div>
        <form method="post" action="{{url('/forgetpasswordcheck')}}" class="col-12" style="color: #8b8888">
            @csrf
            <div class="row  align-items-center mt-3">
                <div class="col-12">
                    <p>Veuillez renseigner l'adresse e-mail que vous avez utilisée à la création de votre compte. Vous
                        recevrez un lien temporaire pour réinitialiser votre mot de passe.</p>
                </div>
                <div class="col-12">
{{--                    @if(session('status'))--}}
                        <p style="color: #204f8c!important">{{session('status')}}</p>
{{--                    @endif--}}
                </div>
                <div class="col-4 col-md-2 col-lg-1">
                    <label for="email" style="font-weight: 600">Email</label>
                </div>
                <div class="col-8 col-md-4 col-lg-4 ">
                    <input type="email" name="email" required id="name" class="form-control" style="border-radius: 0">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4 col-md-2 col-lg-1"></div>
                <div class="col-8 ">
                    <button class="btn text-light " style="border-radius:0;background-color: #204f8c!important; ">
                        Envoyer
                    </button>
                </div>
            </div>
            <div class="row mt-1">
                <div class="col-4 col-md-2 col-lg-1"></div>
                <div class="col-8 mt-3">
                    <a href="{{url('/connexion')}}" style="color: #8b8888;text-decoration: none;font-size: 15px">Connexion?</a>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-1"></div>
                <div class="col-12" style="font-size: 15px">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
            </div>

        </form>
    </div>
</div>


<x-parts.footer/>
<script>


</script>
</body>
</html>

