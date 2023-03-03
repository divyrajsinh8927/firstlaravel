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
                    <tbody id="listOfCategory">
                        @php($i = 1)
                        @foreach($products as $product)
                        @if($product->isDelete == 0)
                        <tr>
                            <td>{{$i++}}</td>
                            <td><img src="{{ asset($product->product_image) }}" style="width: 130px; height: 130px;"> </td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->category_name }}</td>
                            <td>
                                <a href="{{ route('edit.product',$product->id) }}" id="updateCategory" style="float:left; margin-left: 25%; cursor: pointer" class="updateButton">
                                    <i class="fa fa-edit fa-2x"></i></a>
                                <a class="DeleteButton" style="float:right; margin-right: 25%" href="{{ route('delete.product',$product->id) }}" onclick="return confirm('Are You Sure?')">
                                    <i class="fa fa-trash fa-2x" style="color: red; cursor: pointer;"></i>
                                </a>
                            </td>
                        </tr>
                        @endif
                        @endforeach
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
            <form id="productForm" method="POST" enctype="multipart/form-data" action="{{ route('add.product') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <img id="blah" src="#" style="width: 120px; height: 120px; text-align: center;display: none;" />
                    </div>
                    <div class="form-group">
                        <label for="fname">Upload Product Image</label>
                        <input type="file" name="productImage" id="productImage" class="form-control" onchange="showPreview(event);" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Product Name</label>
                        <input type="text" class="form-control" id="txtProductName" placeholder="Enter Producut Name" name="txtProductName" required>
                    </div>
                    <div class="form-group">
                        <label for="categoryName">Category</label>
                        <select name="category" id="category" placeholder="Select Categoroy" required class="form-control"">
                        @foreach($categories as $category)
                        @if($category->isDelete == 0)
                        <option value=" {{ $category->id }}">{{ $category->category_name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" style="text-align: right;" id="addProduct">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showPreview(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("blah");
            preview.src = src;
            preview.style.display = "block";
        }
    }
</script>


@endsection