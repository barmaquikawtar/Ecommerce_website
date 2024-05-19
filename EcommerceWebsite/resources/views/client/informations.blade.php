<!
<html>
<head>

    <x-parts.files/>
    <title>Informations</title>
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
    <form method="post" action="{{url('/informationcheck')}}" class="row" style="border-bottom:  solid 1px #d5d3d3">
        @csrf
        <div class="col-12">
            <p class="mt-2" style="color: #204f8c;font-size: 22px;font-weight: 600">VOS INFORMATIONS PERSONNELLES</p>
        </div>
        <div class="col-12" style="color: #8b8888">
            <div class="row  align-items-center mt-3">
                <div class="col-4 col-md-2  mt-3">
                    <label for="name" style="font-weight: 600">Nom</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="text" name="name" value="{{$user->user_name}}" id="name" class="form-control" required
                           style="border-radius: 0">
                </div>
                <div class="col-4 col-md-2 mt-3">
                    <label for="email" style="font-weight: 600">Email</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="email" name="email" value="{{$user->email}}" id="name" required class="form-control"
                           style="border-radius: 0">
                </div>
                <div class="col-4 col-md-2 mt-3">
                    <label for="telephone" style="font-weight: 600">Telephone</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="tel" name="telephone" value="{{$user->telephone}}" id="telephone" required
                           class="form-control"
                           style="border-radius: 0">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-4 col-md-2"></div>
                <div class="col-8 ">
                    <input class="form-check-input" type="checkbox"  name="modifypassword" id="modifypassword">
                    <label class="form-check-label" for="modifypassword">
                        Modifer mot de passe
                    </label>
                </div>
            </div>
            <div class="row align-items-center mt-3 passwpordfields" style="display: none">
                <div class="col-4 col-md-2 mt-3">
                    <label for="password" style="font-weight: 600">Actuel mot de passe</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="password" name="password" id="password"  class="form-control"
                           style="border-radius: 0">
                </div>
            </div>
            <div class="row align-items-center mt-3 passwpordfields" style="display: none">
                <div class="col-4 col-md-2 mt-3">
                    <label for="newpassword1" style="font-weight: 600">Nouveau Mot de passe</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="password" name="newpassword1" id="newpassword1"  class="form-control"
                           style="border-radius: 0">
                </div>
                <div class="col-4 col-md-2 mt-3">
                    <label for="newpassword2" style="font-weight: 600">Récrire nouveau Mot de passe</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="password" name="newpassword2" id="newpassword2"  class="form-control"
                           style="border-radius: 0">
                </div>
            </div>
            <div class="row">
                <div class="col-4 col-md-2"></div>
                <div class="col-8 mt-3">
                    <button class="btn text-light " style="border-radius:0;background-color: #204f8c!important; ">
                        Enregistrer
                    </button>
                </div>

            </div>
            <div class="row mt-3">
                <div class="col-4 col-md-2">

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
        $('#modifypassword').click(function () {
            if ($(this).is(':checked')) {
                $('.passwpordfields').show()
            } else {
                $('.passwpordfields').hide()
            }
        })
    })

</script>
</body>
</html>

