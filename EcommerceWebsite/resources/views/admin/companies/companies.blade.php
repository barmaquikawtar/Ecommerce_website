<x-app-layout>
    <style>

    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <div class="col-10 mt-5 mb-5">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <p class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center"
                        style="font-size:30px;font-weight:600;color: #204f8c">
                        {{ __('Companies') }}
                    </p>
                    <a href="{{url('admin/addcompanypage')}}" class="btn ps-5 pe-5 text-light"
                       style="background-color: #204f8c;border-radius: 0">
                        Ajouter
                    </a>
                </div>
                @if(session()->get('statut')=='added')
                    <p class="alert text-light" style="background-color: #204f8c;border-radius: 0">
                        Companie ajouté
                    </p>
                @elseif(session()->get('statut')=='deleted')
                    <p class="alert alert-danger " style="border-radius: 0">
                        Companie supprimé
                    </p>
                @elseif(session()->get('statut')=='updated')
                    <p class="alert  " style="background-color: #204f8c;border-radius: 0">
                        Companie mise à jour
                    </p>
                @endif
                <table class="table table-bordered" id="company-table" style="width: 100%">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Logo</th>
                        <th scope="col">Date</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>
{{--                    <tbody>--}}
{{--                    @foreach($companies as $company)--}}
{{--                        <tr class=" align-items-center">--}}
{{--                            <td class="" scope="row">{{$company->name}}</td>--}}
{{--                            <td class="">--}}
{{--                                <img src="{{asset('storage/companies/'.$company->logo)}}" style="height: 40px"--}}
{{--                                     class="img-fluid">--}}
{{--                            </td>--}}
{{--                            <td class=""> {{\Carbon\Carbon::createFromFormat('Y-m-d h:i:s',$company->created_at)->format('d M Y')}}</td>--}}
{{--                            <td class="">--}}
{{--                                <a href="{{url('admin/modifycompanypage/'.$company->id)}}" class="btn text-light mt-0"--}}
{{--                                   companyid="{{$company->id}}" style="border-radius: 0;background-color: #204f8c">--}}
{{--                                    Modifier--}}
{{--                                </a>--}}
{{--                                <p class="btn btn-danger delete mb-0" companyid="{{$company->id}}" style="border-radius: 0">--}}
{{--                                    Supprimer</p>--}}
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
            <form method="post" action="{{url('admin/deletecompanies')}}" class="modal-content"
                  style="border-radius: 0">
                @csrf
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <input type="hidden" name="modalcompanyid" id="modalcompanyid" value="">
                    <img src="{{asset('media/icons/warning.svg')}}" style="height: 40px">
                    <span class="ms-2 text-center">êtes-vous sûr de vouloir supprimer cette companie</span>
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
            $('.delete').click(function () {
                $('#modalcompanyid').val($(this).attr('companyid'))
                $('#deleteconfirmation').modal('show')
            })

            $(function () {
                $('#company-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{!! url('admin/ajaxcompanies') !!}',
                    columns: [
                        {data: 'id', name: 'id'},
                        {data: 'name', name: 'name'},
                        {data: 'logo', name: 'logo',orderable: false, searchable: false},
                        {data: 'created_at', name: 'created_at'},
                        {data: 'action', name: 'action'},
                    ]
                });
            });
        })
    </script>
</x-app-layout>
