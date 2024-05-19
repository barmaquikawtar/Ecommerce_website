<!
<html>
<head>

    <x-parts.files/>
    <title>Paiement</title>
    <style>
        * {
            font-family: 'Noto Sans', sans-serif;
        }

    </style>

</head>
<body>
<header>
    <x-parts.header/>
    <style>
        .wpwl-form-card{
            border: none;
            background-color: transparent;
            box-shadow: none;
            min-width: 100% !important;
        }

         .wpwl-button-pay{
            border-radius: 0;
            background-color: #204f8c !important;
            padding-right: 30px;
            padding-left: 30px;
             border: none;
        }
         select{
             width: 100% !important;
border-radius: 0 !important;
         }
         input{
             display: block;
             width: 100% !important;
             padding: .375rem .75rem;
             font-size: 1rem;
             font-weight: 400;
             line-height: 1.5;
             color: #212529;
             background-color: #fff;
             background-clip: padding-box;
             border: 1px solid #ced4da;
             -webkit-appearance: none;
             -moz-appearance: none;
             appearance: none;
             border-radius: 0!important;
             transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
         }
         .wpwl-group{
             display: flex !important;

         }
         .wpwl-label{
             /*min-width: 15% !important;*/
             width: 20% !important;
         }
         .wpwl-group-mobilePhoneCountryCode,.wpwl-group-mobilePhoneNumber,.wpwl-group-birthDate{
             display: none !important;
         }
         .wpwl-wrapper-submit{
             display: flex !important;
             justify-content: end !important;
             /*text-align: end !important;*/
         }
    </style>
</header>
<div class="container mt-5">
    <script src="https://eu-test.oppwa.com/v1/paymentWidgets.js?checkoutId={{$responseData['id']}}"></script>
    <form action="{{url('/test'.$responseData['id'])}}" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>

</div>

<x-parts.footer/>
<script>
    $(document).ready(function () {


    })

</script>
</body>
</html>

