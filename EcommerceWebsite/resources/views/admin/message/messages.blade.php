<x-app-layout>
    <style>

    </style>
    <div class="container-fluid">
        <div class="row">
            <x-admin.sidenavbar/>
            <div class="col-10 mt-5 mb-5">
                @if(session()->get('statut')=='deleted')
                    <p class="alert alert-danger " style="border-radius: 0">
                        Message supprimé
                    </p>
                @endif
                <h2 class="mb-4 mt-1" style="color: #337ab7">Messages</h2>
                <table class="table table-borderede" id="messages-table" style="width: 100%">
                    <thead>
                    <tr>
                        <td style="width: 5%">Id</td>
                        <td style="width: 10%">Nom</td>
                        <td style="width: 12%">Email</td>
                        <td style="width: 12%">Telephone</td>
                        <td style="width: 10%">Sujet</td>
                        <td style="width: 28%">Message</td>
                        <td style="width: 7%">Fichier</td>
                        <td style="width: 9%">Date</td>
                        <td style="width: 7%">Action</td>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deleteconfirmation" tabindex="-1" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{url('admin/deletemessage')}}" class="modal-content"
                  style="border-radius: 0">
                @csrf
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <input type="hidden" name="messageid" id="messageid" value="">
                    <img src="{{asset('media/icons/warning.svg')}}" style="height: 40px">
                    <span class="ms-2 text-center">êtes-vous sûr de vouloir supprimer ce message</span>
                </div>
                <div class="modal-footer border-top-0">
                    <button class="btn btn-danger text-light pe-3 ps-3" style="border-radius: 0 ;">
                        Supprimer
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $(document).on('click','.delete',function () {
                $('#messageid').val($(this).attr('messageid'))
                $('#deleteconfirmation').modal('show')
            })
        })

        $(function () {
            $('#messages-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! url('admin/ajaxmessages') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone', name: 'phone'},
                    {data: 'subject', name: 'subject'},
                    {data: 'message', name: 'message'},
                    {data: 'downloadfile', name: 'downloadfile', orderable: false, searchable: false},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]
            });
        });
    </script>

</x-app-layout>
