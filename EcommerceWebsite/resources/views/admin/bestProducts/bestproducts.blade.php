<x-app-layout>
    <style>

    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <div class="col-10 my-5">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h2 class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center mb-3"
                        style="font-size:30px;font-weight:600;color: #204f8c">
                        {{ __('Meilleures ventes') }}
                    </h2>
                    <a href="{{url('admin/addbestproductpage')}}" class="btn ps-5 pe-5 text-light"
                       style="background-color: #204f8c;border-radius: 0">
                        Ajouter
                    </a>
                </div>
                @if(session()->get('statut')=='deleted')
                    <p class="alert alert-danger " style="border-radius: 0">
                        Meilleure vente supprimé
                    </p>
                @elseif(session()->get('statut')=='added')
                    <p class="alert  text-light" style="border-radius: 0;background-color:#204f8c ">
                        Meilleure vente Ajouté
                    </p>
                @elseif(session()->get('statut')=='updated')
                    <p class="alert  text-light" style="border-radius: 0;background-color:#204f8c ">
                        Meilleure vente mise a jour
                    </p>
                @endif
                <table class="table table-bordered" style="font-size: 13px" id="bestproduct_table">
                    <thead>
                    <tr>
                        <th scope="col">
                            Details
                        </th>
                        <th scope="col" style="width: 10%">Titre</th>
                        <th scope="col" style="width: 10%">Statut</th>
                        <th scope="col" style="width: 13%">Categorie</th>
                        <th scope="col" style="width: 10%">Companie</th>
                        {{--                        <th scope="col" style="width: 10%">Sous titre</th>--}}
                        <th scope="col" style="width: 10%">images</th>
                        <th scope="col" style="width: 10%">Coleurs</th>
                        <th scope="col" style="width: 10%">Quantite</th>
                        <th scope="col" style="width: 10%">Prix</th>
                        <th scope="col" style="width: 10%">Date</th>
                        <th scope="col" style="width: 10%">Action</th>
                    </tr>
                    </thead>
                    {{--                    <tbody>--}}
                    {{--                    @foreach($bestproducts as $bestproduct)--}}
                    {{--                        <tr class="align-items-center">--}}
                    {{--                            <td>{{$bestproduct->product->title}}</td>--}}
                    {{--                            <td>{{$bestproduct->product->statut}}</td>--}}
                    {{--                            <td>{{$bestproduct->product->childcategory->name }}</td>--}}
                    {{--                            <td>{{$bestproduct->product->company->name }}</td>--}}
                    {{--                            <td>--}}
                    {{--                                @foreach($bestproduct->product->images as $image)--}}
                    {{--                                    <img src="{{asset('storage/products/'.$image->name)}}" class="img-fluid">--}}
                    {{--                                @endforeach--}}
                    {{--                            </td>--}}
                    {{--                            <td>{{$bestproduct->product->specification}}</td>--}}
                    {{--                            <td>{{$bestproduct->product->Technical_sheet}}</td>--}}
                    {{--                            <td class="">--}}
                    {{--                                <div class="d-flex">--}}
                    {{--                                    @foreach($bestproduct->product->colors as $color)--}}
                    {{--                                        <div class="me-1"--}}
                    {{--                                             style="border-radius:100px;height: 25px;width: 25px;background-color:{{$color->name}};"></div>--}}
                    {{--                                    @endforeach--}}
                    {{--                                </div>--}}
                    {{--                            </td>--}}
                    {{--                            <td>{{$bestproduct->product->quantity}}</td>--}}
                    {{--                            <td>{{$bestproduct->product->price}}</td>--}}
                    {{--                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d h:i:s',$bestproduct->created_at)->format('d M Y') }}</td>--}}
                    {{--                            <td>--}}
{{--                                                    <button class="btn btn-sm btn-danger delete" bestproductid="{{$bestproduct->id}}">--}}
{{--                                                        Supprimer--}}
{{--                                                    </button>--}}
                    {{--                            </td>--}}
                    {{--                        </tr>--}}
                    {{--                    @endforeach--}}
                    {{--                    </tbody>--}}
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteconfirmation" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{url('admin/deletebestproduct')}}" class="modal-content"
                  style="border-radius: 0">
                @csrf
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <input type="hidden" name="bestproductid" id="bestproductid" value="">
                    <img src="{{asset('media/icons/warning.svg')}}" style="height: 40px">
                    <span class="ms-2 text-center">êtes-vous sûr de vouloir supprimer ce Meilleure vente</span>
                </div>
                <div class="modal-footer border-top-0">
                    <button class="btn btn-danger text-light pe-3 ps-3" style="border-radius: 0;">
                        Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(document).on('click','.delete',function () {
                $('#bestproductid').val($(this).attr('bestproductid'))
                $('#deleteconfirmation').modal('show')
            })
            var template = Handlebars.compile($("#details-template").html());
            var table = $('#bestproduct_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('admin/ajaxbestproducts') !!}',
                columns: [
                    {
                        "className": 'details-control',
                        "orderable": false,
                        "searchable": false,
                        "data": null,
                        "defaultContent": '<img src="{{asset('media/icons/plus2.svg')}}" class="text-center" style="cursor:pointer;height:20px"/>',
                    },
                    {data: 'product.title', name: 'product.title'},
                    {data: 'product.statut', name: 'product.statut'},
                    {data: 'product.child_category_id', name: 'product.child_category_id'},
                    {data: 'product.company_id', name: 'product.company_id'},
                    // {data: 'presentation', name: 'presentation'},
                    {data: 'images', name: 'images'},
                    {data: 'colors', name: 'colors'},
                    {data: 'product.quantity', name: 'product.quantity'},
                    {data: 'product.price', name: 'product.price'},
                    {data: 'product.created_at', name: 'product.created_at'},
                    {data: 'action', name: 'action'},
                ],

            });
            $('#bestproduct_table tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row(tr);

                if (row.child.isShown()) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                    $(this).children('img').attr('src',src="{{asset('media/icons/plus2.svg')}}")
                } else {
                    // Open this row
                    row.child(template(row.data())).show();
                    tr.addClass('shown');
                    $(this).children('img').attr('src',src="{{asset('media/icons/remove.svg')}}")

                }
            });
        })
    </script>
    <script id="details-template" type="text/x-handlebars-template">
        <table class="table">
            <tr>
                <td>Presentation:</td>
                <td>@{{{product.presentation}}}</td>
            </tr>
            <tr>
                <td>Details:</td>
                <td>@{{{product.specification}}}</td>
            </tr>
        </table>
    </script>
</x-app-layout>
