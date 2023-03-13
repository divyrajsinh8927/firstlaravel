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


    @endsection