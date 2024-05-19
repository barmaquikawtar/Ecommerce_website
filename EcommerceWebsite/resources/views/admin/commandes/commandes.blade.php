<x-app-layout>
    <style>

    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <div class="col-10 my-5">
                <div class="d-flex align-items-center justify-content-between">
                    <h2 class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center mb-4"
                        style="font-size:30px;font-weight:600;color: #204f8c">
                        {{ __('Commandes') }}
                    </h2>
                </div>
                <table class="table table-bordered" style="font-size: 14px;width: 100%" id="commande_table">
                    <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Produits</th>
                        <th scope="col">Total</th>
                        <th scope="col">Statut</th>
                        <th scope="col">Date</th>
                        {{--                    <th scope="col" style="width: 10%">Action</th>--}}
                    </tr>
                    </thead>
                    {{--                    <tbody>--}}
                    {{--                    @foreach($commendes as $commende)--}}
                    {{--                        <tr>--}}
                    {{--                            <td>{{$commende->client->user_name}}</td>--}}
                    {{--                            <td>{{$commende->client->email}}</td>--}}
                    {{--                            <td>{{$commende->client->telephone}}</td>--}}
                    {{--                            <td>{{$commende->client->adresse}} , {{$commende->client->city}}--}}
                    {{--                            <td>--}}
                    {{--                                @foreach($commende->items as $item)--}}
                    {{--                                    <div class="d-flex justify-content-between">--}}
                    {{--                                        <a href="{{url('product/'.$item->pane->product->id)}}" class="me-1"--}}
                    {{--                                           style="color:black;text-decoration: none">--}}
                    {{--                                            - {{$item->pane->product->title}}--}}
                    {{--                                            ({{$item->pane->quantity}})--}}
                    {{--                                        </a>--}}
                    {{--                                        <div>--}}
                    {{--                                            Coleur:--}}
                    {{--                                            <div class="ms-2"--}}
                    {{--                                                 style="height:20px;width:20px;border-radius:100px;background-color: {{$item->pane->color_id}}"></div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div><br>--}}
                    {{--                            @endforeach--}}
                    {{--                            <td>{{$commende->total}} MAD</td>--}}
                    {{--                            <td>--}}
                    {{--                                                    <select class="form-select commandestatut" commandeid="{{$commende->id}}"--}}
                    {{--                                                            style="font-size: 14px;border-radius: 0">--}}
                    {{--                                                        <option value="En confirmation"--}}
                    {{--                                                                @if($commende->statut=='En confirmation') selected="selected" @endif>--}}
                    {{--                                                            En confirmation--}}
                    {{--                                                        </option>--}}
                    {{--                                                        <option value="En livraison"--}}
                    {{--                                                                @if($commende->statut=='En livraison') selected="selected" @endif>--}}
                    {{--                                                            En livraison--}}
                    {{--                                                        </option>--}}
                    {{--                                                        <option value="Livré" @if($commende->statut=='Livré') selected="selected" @endif>--}}
                    {{--                                                            Livré--}}
                    {{--                                                        </option>--}}
                    {{--                                                    </select>--}}
                    {{--                            </td>--}}
                    {{--                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$commende->created_at)->format('d M Y')}}</td>--}}
                    {{--                            --}}{{--                        <td>--}}
                    {{--                            --}}{{--                            <a href="" class="btn btn-sm text-light" style="background-color: #204f8c;border-radius: 0"> Details</a>--}}
                    {{--                            --}}{{--                        </td>--}}
                    {{--                        </tr>--}}
                    {{--                    @endforeach--}}
                    {{--                    </tbody>--}}
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(document).on('change', '.commandestatut', function () {
                $commandeid = $(this).attr('commandeid')
                $.ajax({
                    url: '/admin/updatecommandestatut',
                    type: 'post',
                    data: {
                        '_token': '{{csrf_token()}}',
                        'commande_id': $(this).attr('commandeid'),
                        'value': $(this).val()
                    },
                    success: function (e) {
                    }
                })
            })

            var template = Handlebars.compile($("#details-template").html());
            var table = $('#commande_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('admin/ajaxcommades') !!}',
                columns: [
                        {{--                            <td>{{$commende->client->email}}</td>--}}
                        {{--                            <td>{{$commende->client->telephone}}</td>--}}
                        {{--                            <td>{{$commende->client->adresse}} , {{$commende->client->city}}--}}

                    {
                        data: 'client.user_name', name: 'client.user_name'
                    },
                    {data: 'client.email', name: 'client.email'},
                    {data: 'client.telephone', name: 'client.telephone'},
                    {data: 'client.adresse', name: 'client.adresse'},
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable": false,
                        "data": null,
                        "defaultContent": '<div class="d-flex">Produits <img src="{{asset('media/icons/plus2.svg')}}" class="text-center ms-2" style="cursor:pointer;height:20px"/></div>'
                    },
                    {data: 'total', name: 'total'},
                    {data: 'statut2', name: 'statut2'},
                    {data: 'created_at', name: 'created_at'},
                    // {data: 'product.price', name: 'product.price'},
                    // {data: 'product.created_at', name: 'product.created_at'},
                    // {data: 'action', name: 'action'},
                ],
            });
            $('#commande_table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);
                var tableId = 'products-' + row.data().id;

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                } else {
                    // Open this row
                    row.child(template(row.data())).show();
                    initTable(tableId, row.data());
                    tr.addClass('shown');
                    tr.next().find('td').addClass('no-padding bg-gray');
                }
            });

            function initTable(tableId, data) {
                $url='{{url('admin/getDetailsajaxcommades')}}'+'/'+data.id
                $('#' + tableId).DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: $url,
                    columns: [
                        { data: 'product.title', name: 'product.title' },
                        { data: 'product.childcategory.name', name: 'product.childcategory.name' },
                        { data: 'product.company.name', name: 'product.company.name' },
                        { data: 'images', name: 'images' },
                        { data: 'panecolor', name: 'panecolor' },
                        { data: 'product.statut', name: 'product.statut' },
                        { data: 'product.quantity', name: 'product.quantity' },
                        { data: 'product.price', name: 'product.price' },

                    ]
                })
            }
        })

    </script>
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table table-bordered details-table" id="products-@{{id}}">
            <thead>
            <tr>
                <th>Titre</th>
                <th>Categorie</th>
                <th>Companie</th>
                <th>Images</th>
                <th>Coleur</th>
                <th>Statut</th>
                <th>Quantite</th>
                <th>Prix</th>
            </tr>
            </thead>
        </table>
    </script>
</x-app-layout>
