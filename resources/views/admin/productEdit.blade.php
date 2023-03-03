@extends('admin.adminMaster')
@section('admin')


<!-- <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered" role="document"> -->
<!-- <div class="modal-content"> -->
    <div class="modal-header border-bottom-0">
        <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
        <button class="close" data-dismiss="modal" aria-label="Close" id="addClose">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <form id="productForm" method="POST" enctype="multipart/form-data" action="{{ route('update.product') }}">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <img id="blah" src="#" style="width: 120px; height: 120px; text-align: center;display: none;" />
            </div>
            <div class="form-group">
                <label for="fname">Upload Product Image</label>
                <input type="file" name="productImage" id="productImage" class="form-control" onchange="showPreview(event);">
            </div>
            <div class="form-group">
                <input type="hidden" value="{{ $editProduct->id }}" name="id" id="id">
                <label for="categoryName">Product Name</label>
                <input type="text" class="form-control" id="txtProductName" placeholder="Enter Producut Name" name="txtProductName" value="{{ $editProduct->product_name }}" required>
            </div>
            <div class="form-group">
                <label for="categoryName">Category</label>
                <select name="category" id="category" placeholder="Select Categoroy" value="{{ $editProduct->category_id }}" required class="form-control">
                <option value="0" disabled>Select Category</option>
                    @foreach($categories as $category)
                    @if($category->isDelete == 0)
                    <option value="{{ $category->id }}" {{$category->id == $editProduct->category_id ? 'selected' : ''}}>{{ $category->category_name }}</option>
                    @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button type="submit" class="btn btn-success" style="text-align: right;" id="addProduct">Update Product</button>
        </div>
    </form>
<!-- </div> -->
<!-- </div>
</div> -->

@endsection