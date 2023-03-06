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


<div class="dropdown col-lg-6 col-md-4 col-sm-6">
    <label for="Category" id="disp">Filter:</label>&nbsp&nbsp&nbsp
    <select class="btn btn-rounded" id="filterCategory" name="filterCategory">
    </select>
</div>
<!-- page title area end -->
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">Categories Data</h4>
            <div class="data-tables datatable-dark">
                <table id="dataTable2" class="text-center">
                    <thead class="text-capitalize">
                        <tr>
                            <th>SL</th>
                            <th>Product Image</th>
                            <th>Product Name</th>
                            <th>Category Name</th>
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
                        <img id="blah" src="#" style="width: 120px; height: 120px; text-align: center;display: none;" />
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
                        <img id="blah" src="#" style="width: 120px; height: 120px; text-align: center;display: none;" />
                    </div>
                    <div class="form-group">
                        <label for="fname">Upload Product Image</label>
                        <input type="file" name="updateProductImage" id="updateProductImage" class="form-control" onchange="showPreview(event);">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="updateid" id="updateid">
                        <label for="categoryName">Product Name</label>
                        <input type="text" class="form-control" id="txtUpdateProductName" placeholder="Enter Producut Name" name="txtUpdateProductName">
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
    $(document).ready(function() {
        var categories = ['<option value="0">Category</option><option value="0">All Product</option>']
        $.ajax({
            url: "{{route('get.categories')}}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    var row = $('<option value=' + data[i].id + '>' + data[i].category_name + '</option>');
                    categories.push(row)
                }
                $("#filterCategory").html(categories);
            }
        });

        var products = []
        $.ajax({
            url: "{{ route('cat.product',0) }}",
            type: "GET",
            dataType: 'json',
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    var url = '{{ asset("image") }}';
                    url = url.replace('image', data[i].product_image);
                    var row = $('<tr><td>' + data[i].id + '</td><td><img src=' + url + ' class="productImage" style="width: 130px; height: 130px;"></td><td>' + data[i].product_name + '</td><td>' + data[i].category_name + '</td><td><span style="float:left; margin-left: 25%; cursor: pointer" class="updateButton" data-toggle="modal" data-target="#updateform" data-id="' + data[i].id + '"><i class="fa fa-edit fa-2x"></i></span><span class="DeleteButton" style="float:right; margin-right: 25%" data-id="' + data[i].id + '"><i class="fa fa-trash fa-2x" style="color: red; cursor: pointer;"></i></span></td></tr>');
                    products.push(row)
                }
                $("#listOfProduct").html(products);
            }
        });
    });

    document.getElementById('filterCategory').addEventListener('change', function() {
        var productsByCategory = []
        var selectCategory = document.getElementById('filterCategory').value;
        var url = '{{ route("cat.product", ":id") }}';
        url = url.replace(':id', selectCategory);
        $.ajax({
            url: url,
            type: "GET",
            dataType: 'json',
            success: function(data) {
                for (var i = 0; i < data.length; i++) {
                    var url = '{{ asset("image") }}';
                    url = url.replace('image', data[i].product_image);
                    var row = $('<tr><td>' + data[i].id + '</td><td><img src=' + url + ' class="productImage" style="width: 130px; height: 130px;"></td><td>' + data[i].product_name + '</td><td>' + data[i].category_name + '</td><td><span style="float:left; margin-left: 25%; cursor: pointer" class="updateButton" data-toggle="modal" data-target="#updateform" data-id="' + data[i].id + '"><i class="fa fa-edit fa-2x"></i></span><span class="DeleteButton" style="float:right; margin-right: 25%" data-id="' + data[i].id + '"><i class="fa fa-trash fa-2x" style="color: red; cursor: pointer;"></i></span></td></tr>');
                    productsByCategory.push(row)
                }
                $("#listOfProduct").html(productsByCategory);
            }
        });
    });

    function showPreview(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("blah");
            preview.src = src;
            preview.style.display = "block";
        }
    }


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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
    $(".DeleteButton").click(function(e) {
        e.preventDefault()
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
</script>


@endsection