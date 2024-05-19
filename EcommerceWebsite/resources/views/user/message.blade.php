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
<div class="container">
    <div class="row mt-4">
        <div class="col-3">
            <a class="pe-3" href="{{url('')}}"
               style="font-size: 16px; border-right: solid 1px #9e9e9e;color: #9e9e9e;text-decoration: none">Accueil</a>
            <a class="ps-3" href="{{url('/message')}}" style="font-size: 16px;color: #9e9e9e;text-decoration: none">Contactez-nous</a>
            <div class="pt-3 ps-2 mt-4 pb-3" style="border: solid 1px rgb(238,228,228)">
                <p class="mb-0 ps-2" style="font-size:20px;font-weight: 600;color: #204f8c;">Informations de la
                    boutique</p>
                <p style="border: solid 2px #204f8c;background-color: #204f8c"></p>
                <div class="d-flex align-items-center pt-3 pb-3" style="border-bottom: solid 1px #9e9e9e">
                    <img class="me-3" src="{{asset('media/icons/mark2.svg')}}" style="height: 30px">
                    <span style="color: #9e9e9e;font-size: 14px">Marrakech,Morocco</span>
                </div>
                <a href="mailto:del.souhaib@gmail.com" class="d-flex align-items-center pt-3 pb-3"
                   style="border-bottom: solid 1px #9e9e9e;text-decoration: none">
                    <img class="me-3" src="{{asset('media/icons/mail2.svg')}}" style="height: 30px">
                    <span style="color: #9e9e9e;font-size: 14px">del.souhaib@gmail.com</span>
                </a>
                <a href="tel:0771705545" class="d-flex align-items-center pt-3" style="text-decoration: none">
                    <img class="me-3" src="{{asset('media/icons/phone2.svg')}}" style="height: 30px">
                    <span style="color: #9e9e9e;font-size: 14px">0771705545</span>
                </a>
            </div>
        </div>
        <form method="post" action="{{url('/sendmessage')}}" enctype="multipart/form-data" class="col-9 mt-5"
              style="color: #9e9e9e">
            @csrf
            @if(session()->get('statut')=='added')
                <div class="alert text-light d-flex align-items-center"
                     style="background-color: #204f8c;border-radius: 0">
                    <img src="{{asset('media/icons/success.svg')}}" style="height: 40px">
                    <span class="ms-3">Message Envoye</span>
                </div>
            @endif
            <p class="mb-0 pt-0 mt-0" style="font-weight:500;font-size: 26px;color: #204f8c">Contactez-nous</p>
            <div class="row align-items-center mt-4" style="font-weight: 500">
                <div class="col-2 mt-3">
                    <label for="name">Nom complete *</label>
                </div>
                <div class="col-4 mt-3">
                    <x-input type="text" class="form-control" id="name" name="name" required/>
                </div>
                <div class="col-2 mt-3">
                    <label for="Sujet">Sujet *</label>
                </div>
                <div class="col-4 mt-3">
                    <select name="Sujet" id="Sujet" class="form-select">
                        <option value="Demande de devis">Demande de devis</option>
                        <option value="Service client">Service client</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <div class="col-2 mt-3">
                    <x-label for="email">Email *</x-label>
                </div>
                <div class="col-4 mt-3">
                    <x-input type="email" class="form-control" id="email" name="email" required/>
                </div>
                <div class="col-2 mt-3">
                    <x-label for="tele">Telephone *</x-label>
                </div>
                <div class="col-4 mt-3">
                    <x-input type="tel" class="form-control" id="tele" name="tele" required/>
                </div>
                <div class="col-2 mt-3">
                    <x-label for="file">Fichier</x-label>
                </div>
                <div class="col-4 mt-3">
                    <x-input type="file" class="form-control" id="file" name="file"/>
                </div>
            </div>
            <div class="row">
                <div class="col-2 mt-3">
                    <x-label for="message">Message *</x-label>
                </div>
                <div class="col-8 mt-3">
                    <textarea class="form-control" id="message" name="message" rows="4">

                    </textarea>
                </div>
                <div class="col-12 mt-5">
                    <button class="btn text-light pe-5 ps-5"
                            style="border-radius:0;background-color: #204f8c!important;">Envoyer
                    </button>
                </div>
        </form>
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

