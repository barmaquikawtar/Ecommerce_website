<!
<html>
<head>

    <x-parts.files/>
    <title>Home</title>
    <style>
        * {
            font-family: 'Noto Sans', sans-serif;
        }
        .list .list-item {
            box-shadow: 0px -1px 24px 0px rgba(32,79,140,0.75);
            -webkit-box-shadow: 0px -1px 24px 0px rgba(32,79,140,0.75);
            -moz-box-shadow: 0px -1px 24px 0px rgba(32,79,140,0.75);

        }
        .list  a {
            text-decoration: none;
        }
        .list .list-item:hover{
            border-bottom: solid 2px #204f8c;
        }
    </style>

</head>
<body>
<header>
    <x-parts.header/>
</header>
<div class="container mt-5">
    <div class="row p-6 list">
        <a href="{{url('information')}}" class="list-item col-12 col-sm-6 col-md-4 col-lg-3 mt-3 d-flex justify-content-center align-items-center pt-3 pb-3 bg-white border-b border-gray-200" style="text-decoration: none">
            <img src="{{asset('media/icons/user2.svg')}}" class="" style="height: 35px" >
            <p class="mb-0 text-center ms-4" style="font-size: 17px;color: #204f8c">Informations</p>
        </a>
        <a href="{{url('adresses')}}" class="list-item col-12 col-sm-6 col-md-4 col-lg-3 mt-3 d-flex justify-content-center align-items-center pt-3 pb-3 bg-white border-b border-gray-200" style="text-decoration: none">
            <img src="{{asset('media/icons/mark.svg')}}" class="" style="height: 35px" >
            <p class="mb-0 text-center ms-4" style="font-size: 17px;color: #204f8c">Mes adresses</p>
        </a>
        <a href="{{url('panier')}}" class="list-item col-12 col-sm-6 col-md-4 col-lg-3 mt-3 d-flex justify-content-center align-items-center pt-3 pb-3 bg-white border-b border-gray-200" style="text-decoration: none">
            <img src="{{asset('media/icons/panier.svg')}}" class="" style="height: 35px" >
            <p class="mb-0 text-center ms-4" style="font-size: 17px;color: #204f8c">Mon Panier</p>
        </a>
        <a href="{{url('mescommande')}}" class="list-item col-12 col-sm-6 col-md-4 col-lg-3 mt-3 d-flex justify-content-center align-items-center pt-3 pb-3 bg-white border-b border-gray-200" style="text-decoration: none">
            <img src="{{asset('media/icons/box2.svg')}}" class="" style="height: 35px" >
            <p class="mb-0 text-center ms-4" style="font-size: 17px;color: #204f8c">Mes commandes</p>
        </a>

    </div>

</div>


<x-parts.footer/>
<script>


</script>
</body>
</html>

