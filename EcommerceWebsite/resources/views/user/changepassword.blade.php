<!
<html>
<head>

    <x-parts.files/>
    <title>Reset mot de passe</title>
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
    <form method="post" action="{{url('/changepasswpordcheck')}}" class="row" style="border-bottom:  solid 1px #d5d3d3">
        @csrf
        <input type="hidden" name="token" value="{{$token}}">
        <div class="col-12">
            <p class="mt-2" style="color: #204f8c;font-size: 22px;font-weight: 600">CHANGER LE MOT DE PASSE</p>
        </div>
        <div class="col-12" style="color: #8b8888">
            <div class="row  align-items-center mt-3">
                <div class="col-sm-4 col-md-2 col-4 mt-3">
                    <label for="email" style="font-weight: 600">Email</label>
                </div>
                <div class="col-8 col-md-4 col-8 mt-3">
                    <input type="email" name="email"  id="name" required class="form-control"
                           style="border-radius: 0">
                </div>

            </div>
            <div class="row align-items-center mt-3 " >
                <div class="col-sm-4 col-md-2 col-4 mt-3">
                    <label for="password" style="font-weight: 600">Mot de passe</label>
                </div>
                <div class="col-8 col-md-4 col-8 col-8 mt-3">
                    <input type="password" name="password" id="password"  class="form-control"
                           style="border-radius: 0">
                </div>
                <div class="col-sm-4 col-md-2 col-4 mt-3">
                    <label for="password_confirmation" style="font-weight: 600">Recrire le Mot de passe</label>
                </div>
                <div class="col-8 col-md-4 col-8 mt-3">
                    <input type="password" name="password_confirmation" id="password_confirmation"  class="form-control"
                           style="border-radius: 0">
                </div>
            </div>

            <div class="row">
                <div class="col-sm-4 col-md-2 col-4"></div>
                <div class="col-8 mt-3">
                    <button class="btn text-light " style="border-radius:0;background-color: #204f8c!important; ">
                        Enregistrer
                    </button>
                </div>

            </div>
            <div class="row mt-3">
                <div class="col-2">
                </div>
                <div class="col-8" style="font-size: 15px">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p class="text-danger">{{ $error }}</p>
                        @endforeach
                    @endif
                </div>
            </div>

        </div>
    </form>
</div>


<x-parts.footer/>
<script>
    $(document).ready(function () {

    })

</script>
</body>
</html>

