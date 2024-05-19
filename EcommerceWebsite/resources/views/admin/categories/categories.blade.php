<x-app-layout>
    <style>
    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <div class="col-10 my-5">
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h2 class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center"
                        style="font-size:30px;font-weight:600;color: #204f8c">
                        {{ __('Categories') }}
                    </h2>
                    <a href="{{url('admin/addcategorypage')}}" class="btn ps-5 pe-5 text-light"
                       style="background-color: #204f8c;border-radius: 0">
                        Ajouter
                    </a>
                </div>
                <div class="row">
                    @if(session()->get('statut')=='added')
                        <p class="alert text-light" style="background-color: #204f8c;border-radius: 0">
                            Categorie ajouté
                        </p>
                    @elseif(session()->get('statut')=='deleted')
                        <p class="alert alert-danger " style="border-radius: 0">
                            Categorie supprimé
                        </p>
                    @endif
                    <table class="table table-bordered" id="categories-table">
                        <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>
{{--                        <tbody>--}}
{{--                        @foreach($categories as $categorie)--}}
{{--                            <tr>--}}
{{--                                <td scope="row">{{$categorie->name}}</td>--}}
{{--                                <td>{{\Carbon\Carbon::createFromFormat('Y-m-d h:i:s',$categorie->created_at)->format('d M Y')}}</td>--}}
{{--                                <td>--}}
{{--                                    <p class="btn btn-danger delete" categoriid="{{$categorie->id}}" style="border-radius: 0">Supprimer</p>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteconfirmation" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{url('admin/deletecategory')}}" class="modal-content" style="border-radius: 0">
                @csrf
                <div class="modal-header border-bottom-0" >
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <input type="hidden" name="categoryid" id="modalcategoryid" value="">
                    <img src="{{asset('media/icons/warning.svg')}}" style="height: 40px">
                    <span class="ms-2 text-center">êtes-vous sûr de vouloir supprimer cette categorie</span>
                </div>
                <div class="modal-footer border-top-0">
                    <button  class="btn btn-danger text-light pe-3 ps-3" style="border-radius: 0;">
                        Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function (){
            $(document).on('click','.delete',function (){
                $('#modalcategoryid').val($(this).attr('categoriid'))
                $('#deleteconfirmation').modal('show')
            })
            $('#categories-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{url('admin/ajaxcategories')}}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action'},
                ]
            });
        })
    </script>
</x-app-layout>
