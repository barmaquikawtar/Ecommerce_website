<!
<html>
<head>

    <x-parts.files/>
    <title>Panier</title>
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
    <form method="post" action="{{url('/Commandeclick')}}" class="row" style="border-bottom:  solid 1px #d5d3d3">
        @csrf
        <div class="col-12">
            <p class="mt-2" style="color: #204f8c;font-size: 22px;font-weight: 600">VOS INFORMATIONS PERSONNELLES</p>
        </div>
        <div class="col-12" style="color: #8b8888">
            <div class="row  align-items-center mt-3">
                <div class="col-4 col-md-2 mt-3">
                    <label for="name" style="font-weight: 600">Nom</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="text" name="name" value="{{$user->user_name}}"  id="name" class="form-control" required
                           style="border-radius: 0">
                </div>
                <div class="col-4 col-md-2 mt-3">
                    <label for="email" style="font-weight: 600">Email</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="email" name="email" value="{{$user->email}}"  id="name" required class="form-control"
                           style="border-radius: 0">
                </div>
                <div class="col-4 col-md-2 mt-3">
                    <label for="telephone" style="font-weight: 600">Telephone</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="tel" name="telephone"  value="{{$user->telephone}}" id="telephone" required
                           class="form-control"
                           style="border-radius: 0">
                </div>
            </div>
            <div class="row mt-3 align-items-center">
                <div class="col-4 col-md-2 mt-3">
                    <label for="city" style="font-weight: 600">Ville</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <select class="form-select" name="city" id="city">
                        <option value="Marrakech">Marrakech</option>
                        <option value="Casablanca">Casa blanca</option>
                        <option value="Agadir">Agadir</option>
                        <option value="Rabat">Rabat</option>
                        <option value="Sale">Sale</option>
                        <option value="El jadida">El jadida</option>
                        <option value="Tanger">Tanger</option>
                        <option value="Tetouan">Tetouan</option>

                    </select>
                </div>
                <div class="col-4 col-md-2 mt-3">
                    <label for="zip" style="font-weight: 600">Zip code</label>
                </div>
                <div class="col-8 col-md-4 mt-3">
                    <input type="text" name="zip" value="{{$user->zip}}" id="zip" required class="form-control"
                           style="border-radius: 0">
                </div>
                <div class="col-4 col-md-2 mt-3">
                    <label for="adresse" style="font-weight: 600">Adresse</label>
                </div>
                <div class="col-8 col-md-6 mt-3">
                    <input type="text" name="adresse" value="{{$user->adresse}}" id="adresse" required class="form-control"
                           style="border-radius: 0">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-4 col-md-2"></div>
                <div class="col-10 mt-3 text-end">
                    <button class="btn text-light px-5" style="border-radius:0;background-color: #204f8c!important; ">
                        Suivant
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


    })

</script>
</body>
</html>

