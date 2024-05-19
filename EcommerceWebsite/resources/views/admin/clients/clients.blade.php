<x-app-layout>
    {{--    <x-slot name="header">--}}
    {{--        <div class="d-flex align-items-center justify-content-between">--}}
    {{--            <h2 class="font-semibold text-xl mb-0 text-gray leading-tight align-items-center"--}}
    {{--                style="font-weight:600;color: #204f8c">--}}
    {{--                {{ __('Utilisateurs') }}--}}
    {{--            </h2>--}}

    {{--        </div>--}}
    {{--    </x-slot>--}}

    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <div class="col-10 mt-5 mb-5">
               <h2 class="mb-4 mt-1" style="color: #337ab7">Clients</h2>
                <table class="table table-bordered" id="users-table">
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Nom</td>
                        <td>Email</td>
                        <td>Creé a</td>
                    </tr>
                    </thead>
                </table>
                <script>
                    $(function () {
                        $('#users-table').DataTable({
                            processing: true,
                            serverSide: true,
                            ajax: '{!! url('admin/ajaxclients') !!}',
                            columns: [
                                {data: 'id', name: 'id'},
                                {data: 'name', name: 'name'},
                                {data: 'email', name: 'email'},
                                {data: 'created_at', name: 'created_at'},
                            ]
                        });
                    });
                </script>
            </div>
        </div>

    </div>

</x-app-layout>
