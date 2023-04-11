@extends('admin.adminMaster')
@section('admin')

<!-- page title area start -->
<div class="page-title-area" style="margin-top: 20px;">
    <div class="row align-items-center">
        <div class="col-sm-12">
            <h1 class="page-title pull-left" style="margin-top: 5px;">Product Management</h1>
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#form" style="text-decoration: none; color: white;border: 0px solid; float: right; background-color: #272727; height: 55px;">
                Add Product
            </button>
        </div>
    </div>
</div>

<p id="me"></p>
<div class="dropdown col-lg-6 col-md-4 col-sm-6">
    <form id="form-filter" method="post">
        <label for="Category" id="disp">Filter:</label>&nbsp&nbsp&nbsp
        <select class="btn btn-rounded" id="filterCategory" name="filterCategory">
        </select>
    </form>
</div>
<button class="btn btn-primary mb-3" type="button" id="exportProducts" style="float: right; margin-right: 30px;" id="exportProducts">Export</button>
<!-- page title area end -->
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Product Data</h4>
            <div class="data-tables datatable-dark">
                <table id="dataTable2_ajax" class="text-center">
                    <thead class="text-capitalize">
                        <tr>
                            <th class="text-center">Select All&nbsp;&nbsp;&nbsp;<input class="mycheckbox" type="checkbox" style="height: 15px; width: 15px;" id="checkAll"></th>
                            <th>id</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Product Price</th>
                            <th>Sub-Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="listOfProduct">

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

<!-- Add ProductForm  -->
<div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button class="close" data-dismiss="modal" aria-label="Close" id="addClose">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="productForm" enctype="multipart/form-data">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <img id="blah" src="" style="width: 120px; height: 120px; text-align: center;" />
                    </div>
                    <div class="form-group">
                        <label for="fname">Upload Product Image</label>
                        <input type="file" name="productImage" id="productImage" class="form-control" onchange="showPreview(event);">
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Product Name</label>
                        <input type="text" class="form-control" id="txtProductName" placeholder="Enter Producut Name" name="txtProductName">
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Product Price</label>
                        <input type="text" class="form-control" id="txtProductPrice" placeholder="Enter Producut Price In Rupees" name="txtProductPrice">
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Category</label>
                        <select name="category" id="category" placeholder="Select Categoroy" class="form-control">

                        </select>
                    </div>
                </div>
                <div class=" modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" style="text-align: right;" id="addProduct">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- update form -->
<div class="modal fade" id="updateform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
                <button class="close" data-dismiss="modal" aria-label="Close" id="addClose">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateProductForm" enctype="multipart/form-data">
                <div class="alert alert-danger print-error-msg" style="display:none" id="productError">
                    <ul></ul>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <img id="upblah" src="#" style="width: 120px; height: 120px; text-align: center;" />
                    </div>
                    <div class="form-group">
                        <label for="fname">Upload Product Image</label>
                        <input type="file" name="updateProductImage" id="updateProductImage" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="updateid" id="updateid">
                        <label for="categoryName">Product Name</label>
                        <input type="text" class="form-control" id="txtUpdateProductName" placeholder="Enter Producut Name" name="txtUpdateProductName">
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Product Price</label>
                        <input type="text" class="form-control" id="txtUpdateProductPrice" placeholder="Enter Producut Price In Rupees" name="txtUpdateProductPrice">
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Category</label>
                        <select name="updateCategory" id="updateCategory" placeholder="Select Categoroy" required class="form-control">

                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" style="text-align: right;">Update Product</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', function(event) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {

            var categoryDataCount = 0;
            var order = "";
            var orderColumnName = "";

            $("#productImage").change(function() {
                const file = this.files[0];
                if (file) {
                    var src = URL.createObjectURL(file);
                    var preview = document.getElementById("blah");
                    preview.src = src;
                }
            });


            $("#updateProductImage").change(function() {
                const file = this.files[0];
                if (file) {
                    var src = URL.createObjectURL(file);
                    var preview = document.getElementById("upblah");
                    preview.src = src;
                }
            });


            var filtercategories = ['<option value="-1" disabled>Select Category</option><option value="0">All Product</option>']
            $.ajax({
                url: "{{route('get.categories')}}",
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var row = $('<option value=' + data[i].id + '>' + data[i].category_name + '</option>');
                        filtercategories.push(row)
                    }
                    $("#filterCategory").html(filtercategories);
                }
            });

            $('#filterCategory').on("change", function(e) {
                table.ajax.reload();
            });

            search_param = {};
            table = $('#dataTable2_ajax').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                orderCellsTop: true,
                ajax: function(data, callback) {
                    $.each(search_param, function(k, v) {});
                    data.category_id = $('#filterCategory').val();
                    $.ajax({
                        url: "{{ route('cat.product') }}",
                        data: data,
                        type: "post",
                        dataType: 'json',
                        beforeSend: function() {},
                        success: function(res) {
                            callback(res);
                                categoryDataCount = res.displayedProduct;
                            order = res.order;
                            orderColumnName = res.orderColumnName;
                            $('#dataTable2_ajax_info').html("<b style='font-size: 15px;'>Found </b>&nbsp&nbsp<b style='font-size: 20px;'>" + res.displayedProduct + "</b> &nbsp&nbsp<b style='font-size: 15px;'> From Total </b>&nbsp&nbsp<b style='font-size: 20px;'>" + res.totalProduct + "</b><b style='font-size: 15px;'>  &nbsp&nbspProducts </b>");
                        }
                    });
                },
                language: {
                    processing: '<i class="fa fa-spinner fa-spin fa-1x fa-fw"></i> <span class="sr-only" style="display:contents;"> Loading...</span>'
                },
                lengthMenu: [
                    [5, 10, 25, 50, 100, 150, 250, 500, 1000, 1500, -1],
                    [5, 10, 25, 50, 100, 150, 250, 500, 1000, 1500, 'All']
                ],
                'columns': [{
                        'data': 'id',
                        'orderable': false,
                        render: function(data, type, row, meta) {
                            return '<input class="form-check-input" type="checkbox" value="' + data + '" style="height: 30px; width: 30px; margin-top: -13px;">';
                        }
                    },
                    {
                        'data': 'id',
                    },
                    {
                        'data': 'product_image',
                        'orderable': false,
                        render: function(data, type, row, meta) {
                            var imgurl = "{{ asset(':data') }}";
                            imgurl = imgurl.replace(':data', data);
                            return '<img src="' + imgurl + '" style="height: 100px; width: 100px;">';
                        }
                    },
                    {
                        'data': 'product_name',
                    },
                    {
                        'data': 'product_price',
                    },
                    {
                        'data': 'category_name',
                    },
                    {
                        'data': 'id',
                        'orderable': false,
                        render: function(data, type, row, meta) {
                            return '<span style="float:left; margin-left: 25%; cursor: pointer" class="updateButton" data-toggle="modal" data-target="#updateform" data-id="' + data + '"><i class="fa fa-edit fa-2x"></i></span><span class="DeleteButton" style="float:right; margin-right: 25%" data-id="' + data + '"><i class="fa fa-trash fa-2x" style="color: red; cursor: pointer;"></i></span>';
                        }
                    }
                ]

            });

            $("#checkAll").click(function() {
                $('.form-check-input').not(this).prop('checked', this.checked);
            });


            $(document).on("click", "#exportProducts", function() {
                var checked = [];
                $(".form-check-input:checked").each(function() {
                    checked.push($(this).val());
                });
                if ($('#filterCategory').val() == -1)
                    var exportDataCount = checked.length;
                else if ($('#filterCategory').val() == 0 && checked.length == 0)
                    var exportDataCount = categoryDataCount;
                else
                    var exportDataCount = checked.length;
                Swal.fire({
                    title: 'You Have Total ' + exportDataCount + ' Record to export',
                    text: "You won't to Export Product!",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Export it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var ids = checked.join(",");
                        var url = '/product-export' + '?ids=' + ids + '&' + $('#form-filter').serialize() + '&order=' + order + '&orderColumn=' + orderColumnName;
                        window.open(url, '_blank');

                        $("#checkAll").prop("checked", false)
                        $(".form-check-input:checked").prop("checked", false)
                    }
                });
            });



            const fileInput = document.getElementById('productImage');

            fileInput.addEventListener('change', function() {
                const file = fileInput.files[0];
                if (file.type != 'image/jpeg' && file.type != 'image/jpg' && file.type != 'image/png') {
                    $("#productForm")[0].reset();
                    alert('Please select a JPEG image file.');
                    return;
                }

                if (file.size > 10 * 1024 * 1024) {
                    alert('The file size exceeds the maximum limit of 10MB.');
                    return;
                }
            });


            var categories = ['<option value="0" disabled selected>Select Category</option>']
            $.ajax({
                url: "{{route('get.categories')}}",
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var row = $('<option value=' + data[i].id + '>' + data[i].category_name + '</option>');
                        categories.push(row)
                    }
                    $("#category").html(categories);
                }
            });

            $('#productForm').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('add.product') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire(
                                'Inserted!',
                                'Product has been Inserted.',
                                'success'
                            ).then(function() {
                                location.reload()
                            })
                        } else {
                            printErrorMsg(data.error);
                        }
                    }
                });
            });

            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function(key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                });

            }


            //update Area
            var updateCategories = ['<option value="0" disabled selected>Select Category</option>']
            $.ajax({
                url: "{{route('get.categories')}}",
                type: "GET",
                dataType: 'json',
                success: function(data) {
                    for (var i = 0; i < data.length; i++) {
                        var row = $('<option value=' + data[i].id + '>' + data[i].category_name + '</option>');
                        updateCategories.push(row)
                    }
                    $("#updateCategory").html(updateCategories);
                }
            });

            $(document).on('click', '.updateButton', function() {
                updateId = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('edit.product') }}",
                    data: {
                        id: updateId
                    },
                    success: function(data) {
                        $('#updateid').val(data.id);
                        $('#txtUpdateProductName').val(data.product_name);
                        $('#txtUpdateProductPrice').val(data.Product_price);
                        $('#updateCategory').val(data.category_id);
                    }
                });
            });

            $('#updateProductForm').submit(function(e) {
                e.preventDefault();

                var updateFormData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('update.product') }}",
                    data: updateFormData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire(
                                'Updated!',
                                'Product has been Updated.',
                                'success'
                            ).then(function() {
                                location.reload()
                            })
                        } else {
                            printUpdateErrorMsg(data.error);
                        }
                    }
                });
            });

            function printUpdateErrorMsg(msg) {
                $("#productError").find("ul").html('');
                $("#productError").css('display', 'block');
                $.each(msg, function(key, value) {
                    $("#productError").find("ul").append('<li>' + value + '</li>');
                });
            }

            //delete product
            $(document).on('click', '.DeleteButton', function() {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't to Delete Product!",
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
                            url: "{{ route('delete.product') }}",
                            data: {
                                id: id,
                            },
                            success: function(data) {
                                Swal.fire(
                                    'Deleted!',
                                    'Category has been deleted.',
                                    'success'
                                ).then(function() {
                                    location.reload()
                                })
                            }
                        });
                    }
                })
            });



        });
    });
</script>


@endsection
