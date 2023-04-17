@extends('admin.adminMaster')
@section('admin')
    <!-- page title area start -->
    <div class="main-content">
        <!-- page title area end -->
        <div class="col-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Categories Data</h4>
                    <div class="data-tables datatable-dark">
                        <table id="dataTable2_ajax" class="text-center">
                            <thead class="text-capitalize">
                                <tr>
                                    <th>SL</th>
                                    <th>User</th>
                                    <th>Product</th>
                                    <th>Address</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>OrderDateTime</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Dark table end -->
    </div>
    </div>
    </div>
    <!-- main content area end -->
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function(event) {
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var order_id;
                search_param = {};
                table = $('#dataTable2_ajax').DataTable({
                    processing: true,
                    serverSide: true,
                    deferRender: true,
                    orderCellsTop: true,
                    ajax: function(data, callback) {
                        $.each(search_param, function(k, v) {});
                        $.ajax({
                            url: "{{ route('Admin.All.Orders') }}",
                            data: data,
                            type: "post",
                            dataType: 'json',
                            beforeSend: function() {},
                            success: function(res) {
                                callback(res);
                            }
                        });
                    },
                    'columns': [{
                            'data': 'id',
                            render: function(data, type, row, meta) {
                                order_id = data;
                                return '<span class="">' + order_id + '</span>'
                            }
                        },
                        {
                            'data': 'user_name',
                        },
                        {
                            'data': 'product_name',
                        },
                        {
                            'data': 'address',
                            'orderable': false,
                        },
                        {
                            'data': 'quantity',
                        },
                        {
                            'data': 'price',
                        },
                        {
                            'data': 'status',
                            'orderable': false,
                            render: function(data, type, row, meta) {
                                if (data == null) {
                                    return '<span class="">Waiting</span>'
                                }
                                if (data == 0) {
                                    return '<span class="">Canceled</span>'
                                }
                                if (data == 1) {
                                    return '<span class="">Confirmed</span>'
                                }
                            }
                        },
                        {
                            'data': 'created_at',
                        },
                        {
                            'data': 'status',
                            'orderable': false,
                            render: function(data, type, row, meta) {
                                if (data == null) {
                                    return '<span class="ConfirmOrder" style="float:left; margin-left: 10%;margin-right: 10%; cursor: pointer" data-id="' +
                                        order_id +
                                        '"><i class="fa fa-check fa-2x"></i></span><span class="cancelOrder" style="float:right; margin-right: 25%" data-id="' +
                                        order_id +
                                        '"><i class="fa fa-times fa-2x" style="color: red; cursor: pointer;"></i></span>';
                                }
                                if (data == 1) {
                                    return '<span class="">Confirmed</span>'
                                }
                                if (data == 0) {
                                    return '<span class="">Canceled</span>'
                                }
                                if (data == 2) {
                                    return '<span class="">Delivered</span>'
                                }
                            }
                        },
                    ]
                });
            });
        });


        $(document).on('click', '.ConfirmOrder', function() {
            Swal.fire({
                title: 'Confirm',
                text: "You won't to Confirm Order!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'POST',
                        method: 'put',
                        url: "{{ route('Admin.confirm.Orders') }}",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            if (data.success) {
                                Swal.fire(
                                    'Confirm!',
                                    'Order has been Confirmed.',
                                    'success'
                                ).then(function() {
                                    location.reload()
                                })
                            }
                            else{
                                Swal.fire(
                                    'Confirm!',
                                    'Order has been Confirmed But SMS Not send.',
                                    'warning'
                                ).then(function() {
                                })
                            }
                        }
                    });
                }
            })
        });


        $(document).on('click', '.cancelOrder', function() {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't to Reject Order!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Reject it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var id = $(this).data('id');
                    $.ajax({
                        type: 'POST',
                        method: 'delete',
                        url: "{{ route('Admin.Reject.Orders') }}",
                        data: {
                            id: id,
                        },
                        success: function(data) {
                            Swal.fire(
                                'Reject!',
                                'Order has been Reject.',
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
