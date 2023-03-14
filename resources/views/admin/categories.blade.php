@extends('admin.adminMaster')
@section('admin')

<!-- page title area start -->
<div class="main-content">
    <div class="page-title-area" style="margin-top: 20px;">
        <div class="row align-items-center">
            <div class="col-sm-12">
                <h1 class="page-title pull-left" style="margin-top: 5px;">Categories</h1>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#addCategoryForm" style="text-decoration: none; color: white;border: 0px solid; float: inline-end; background-color: #272727;">
                    Add Category
                </button>
            </div>
        </div>
    </div>
    <!-- page title area end -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <a class="btn btn-danger" href="{{ url('importCategory') }}" style="text-decoration: none; color: white;border: 0px solid; float: right; background-color: #0069D9; margin-top: -17px;">
                    Import
                </a>
                <h4 class="header-title">Categories Data</h4>
                <div class="data-tables datatable-dark">
                    <table id="dataTable2_ajax" class="text-center">
                        <thead class="text-capitalize">
                            <tr>
                                <th>SL</th>
                                <th>Categoryname</th>
                                <th>Actions</th>
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


<!--Import model-->



<!--add Category Model-->
<div class="modal fade" id="addCategoryForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" class="form-control" id="txtcategoryName" placeholder="Enter Category Name" name="txtcategoryName">
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button class="btn btn-success" style="text-align: right;" id="btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--updateCategory model-->
<div class="modal fade" id="updateCategoryForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="alert alert-danger print-error-msg" style="display:none" id="updateErrorMessage">
                    <ul></ul>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="hidden" name="categoryId" id="categoryId" />
                        <input type="text" class="form-control" id="txtUpdatecategoryName" placeholder="Enter Category Name" name="txtUpdatecategoryName" />
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button class="btn btn-success" style="text-align: right;" id="btnUpdateCategory">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    window.addEventListener('DOMContentLoaded', function(event) {
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            search_param = {};
            table = $('#dataTable2_ajax').DataTable({
                processing: true,
                serverSide: true,
                deferRender: true,
                orderCellsTop: true,
                ajax: function(data, callback) {
                    $.each(search_param, function(k, v) {});
                    $.ajax({
                        url: "{{ route('get.All.categories') }}",
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
                    },
                    {
                        'data': 'category_name',
                    },
                    {
                        'data': 'id',
                        'orderable': false,
                        render: function(data, type, row, meta) {
                            return '<span style="float:left; margin-left: 25%; cursor: pointer" class="editCategory" data-toggle="modal" data-target="#updateCategoryForm" data-id="' + data + '"><i class="fa fa-edit fa-2x"></i></span><span class="DeleteButton" style="float:right; margin-right: 25%" data-id="' + data + '"><i class="fa fa-trash fa-2x" style="color: red; cursor: pointer;"></i></span>';
                        }
                    },
                ]
            });


            //import
            const fileInput = document.getElementById('categoryfile');

            fileInput.addEventListener('change', function() {
                const file = fileInput.files[0];
                var path = fileInput.value
                var allowedExtensions =
                    /(\.csv|\.xlsx)$/i;
                if (!allowedExtensions.exec(path)) {
                    Swal.fire(
                        'Not Supported!',
                        'Please Upload csv Or xlsx Filr.',
                        'error'
                    )
                    fileInput.value = '';
                    return false;
                }
            });
            $('#import').submit(function(e) {
                e.preventDefault();

                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: "{{ route('import.categories') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        Swal.fire(
                            'Imported!',
                            'Category has been Imported.',
                            'success'
                        )
                    }
                });
            });

            //add
            $("#btn-submit").click(function(e) {
                e.preventDefault();

                var categoryName = $("#txtcategoryName").val();

                $.ajax({
                    type: 'POST',
                    method: 'POST',
                    url: "{{ route('add.category') }}",
                    data: {
                        categoryName: categoryName
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            Swal.fire(
                                'Inserted!',
                                'Category has been Inserted.',
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


            //update Category

            var updateId = 0;
            $(document).on('click', '.editCategory', function() {
                updateId = $(this).data('id');
                $.ajax({
                    type: 'POST',
                    url: "{{ route('edit.category') }}",
                    data: {
                        id: updateId
                    },
                    success: function(data) {
                        $('#categoryId').val(data.id);
                        $('#txtUpdatecategoryName').val(data.category_name);
                    }
                });
            });


            $("#btnUpdateCategory").click(function(e) {
                e.preventDefault()

                var id = $("#categoryId").val();
                var updateCategoryName = $("#txtUpdatecategoryName").val();

                $.ajax({
                    type: 'POST',
                    method: 'POST',
                    url: "{{ route('update.category') }}",
                    data: {
                        id: id,
                        updateCategory: updateCategoryName
                    },
                    success: function(data) {
                        if ($.isEmptyObject(data.error)) {
                            alert(data.success);
                            location.reload();
                        } else {
                            printUpdateErrorMsg(data.error);
                        }
                    }
                });
            });

            function printUpdateErrorMsg(msg) {
                $("#updateErrorMessage").find("ul").html('');
                $("#updateErrorMessage").css('display', 'block');
                $.each(msg, function(key, value) {
                    $("#updateErrorMessage").find("ul").append('<li>' + value + '</li>');
                });
            }

        });
    });
    //delete category
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
                    url: "{{ route('delete.category') }}",
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

<script>

</script>



@endsection
