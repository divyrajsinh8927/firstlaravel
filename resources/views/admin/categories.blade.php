@extends('admin.adminMaster')
@section('admin')


<!-- page title area start -->
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
            <h4 class="header-title">Categories Data</h4>
            <div class="data-tables datatable-dark">
                <table id="dataTable2" class="text-center">
                    <thead class="text-capitalize">
                        <tr>
                            <th>SL</th>
                            <th>Categoryname</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="listOfCategory">
                        @php($i = 1)
                        @foreach($categories as $category)
                        @if($category->isDelete == 0)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>
                                <a href="{{ route('edit.category',$category->id) }}" id="updateCategory" style="float:left; margin-left: 25%; cursor: pointer" class="updateButton">
                                    <i class="fa fa-edit fa-2x"></i></a>
                                <a class="DeleteButton" style="float:right; margin-right: 25%" href="{{ route('delete.category',$category->id) }}" onclick="return confirm('Are You Sure?')">
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
            <form id="categoryForm" method="POST" action="{{ route('add.category') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="categoryName">Category Name</label>
                        <input type="text" class="form-control" id="txtcategoryName" placeholder="Enter Category Name" name="txtcategoryName">
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" style="text-align: right;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>




@endsection