@extends('admin.adminMaster')
@section('admin')
    <div class="main-content">
        <div class="page-title-area" style="margin-top: 20px;">
            <div class="row align-items-center">
                <div class="col-sm-12">
                    <h1 class="page-title pull-left" style="margin-top: 5px;">Users</h1>
                </div>
            </div>
        </div>
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Users Data</h4>
                    <div class="data-tables datatable-dark">
                        <table id="datatable_user" class="text-center">
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <script>
            var dt_info_lable = {!! json_encode($dt_info['labels']) !!};
            var dt_info_order = '<?= json_encode($dt_info['order']) ?>';


            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#datatable_user').DataTable({

                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    orderCellsTop: true,
                    ajax: getSiteUrl() + "/admin/table",
                    columns: {!! json_encode($dt_info['labels']) !!},
                    order: {!! json_encode($dt_info['order']) !!},
                });


                function editable(pk = 0, name = "", type = "") {
                    $('.xedit').editable({
                        url: "{{ route('user.update') }}",
                        title: 'Update',
                        type: type,
                        pk: pk,
                        name: name,
                        success: function(response, newValue) {
                            console.log('Updated', response)
                        }

                    });
                }
                $(document).on('click', '.xedit', function() {
                    var id = $(this).data('pk');
                    var name = $(this).data('name');
                    var type = $(this).data('type');
                    editable(id,name,type)
                });



            });



            $(document).on('click', '.DeleteButton', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't to Delete Category!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).data('id');
                        $.ajax({
                            type: 'POST',
                            method: 'POST',
                            url: "{{ route('user.delete') }}",
                            data: {
                                id: id,
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'user has been deleted.',
                                    'success'
                                ).then(function() {
                                    location.reload()
                                })
                            }
                        });
                    }
                })
            });
        </script>
    @endsection
