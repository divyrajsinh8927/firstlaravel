@extends('admin.adminMaster')
@section('admin')

<!--updateCategory model-->
<!-- <div class="modal fade" id="updateCategoryForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
    <!-- <div class="modal-dialog modal-dialog-centered" role="document"> -->
        <!-- <div class="modal-content"> -->
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="exampleModalLabel">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="categoryForm" method="POST" action="{{ route('update.category') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="hidden" value="{{ $editCategory->id }}" name="id"/>
                            <input type="text" class="form-control" id="txtUpdatecategoryName" placeholder="Enter Category Name" name="txtUpdatecategoryName" value="{{ $editCategory->category_name }}" />
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" style="text-align: right;" id="btnUpdateCategory">Update</button>
                </div>
            </form>
        <!-- </div> -->
    <!-- </div> -->
<!-- </div> -->


@endsection