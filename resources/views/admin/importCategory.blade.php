@extends('admin.adminMaster')
@section('admin')

<div class="card-body">
    <h4 class="header-title">Custom file input</h4>
    <form id="import">
        <table class="table table-bordered" id="errors">
        </table>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">Upload</span>
            </div>
            <div class="custom-file">
                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                <input type="file" class="custom-file-input" id="categoryfile" name="categoryfile">
            </div>
        </div>
        <div class="modal-footer border-top-0 d-flex justify-content-center">
            <button class="btn btn-success" style="text-align: right;">Import</button>
        </div>
</div>
</form>
</div>

<script>
    window.addEventListener('DOMContentLoaded', function(event) {
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(".custom-file-input").on("change", function() {
                var fileName = $(this).val().split("\\").pop();
                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            $('#import').submit(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't to Import Category!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Import it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formData = new FormData(this);
                        $.ajax({
                            type: 'POST',
                            url: "{{ route('import.categories') }}",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function(data) {
                                // Swal.fire(
                                //     'Imported!',
                                //     'Category has been Imported.',
                                //     'success'
                                // )
                                $("#errors").html(data);
                            }
                        });
                    }
                });
            });
        });
    });
</script>

@endsection
