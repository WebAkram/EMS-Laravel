@extends('layouts.admin')
@section('content')
    <h3 class="text-center text-dark mb-0 p-1"
        style="border-radius:3px; background-image: linear-gradient(135deg, #81FBB8 10%, #28C76F 100%);">
        Department
    </h3>
          {{-- start update model --}}
          <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog ">
                <div class="modal-content">
                    <form id="departmentupdateForm" autocomplete="off" method="POST">
                        @csrf
                        <input type="hidden" id="up_id">
                        <div class="modal-header ">
                            <h4 class="modal-title text-dark fw-bold" id="exampleModalLabel">Update Department</h4>
                            <button type="button" class="btn-close bg-danger rounded-circle" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="fw-bold text-dark">Department Name</label>
                                <input type="text" id="up_name"
                                    class="form-control text-dark bg-light" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" name="submitbtn" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- end update model --}}

    <div class="mx-auto col-xl-6 mt-1">
        <span id="name_error" class="text-danger"></span>
        <form id="departmentaddForm" autocomplete="off" method="POST" class="col-md-12 mx-auto p-2">
            @csrf
            <div class="d-flex add mt-1">
                <input type="text" name="departmentname" required class="form-control rounded-0 shadow-sm"
                    placeholder="Enter the department name">
                <button class="btn btn-dark rounded-0" name="submit" type="submit"><i class="fa fa-plus"></i></button>
            </div>
        </form>

        {{-- fetch data in table of slider section --}}
        <div id="tableContainer" class="table-responsive">

            <table class="table table-hover">

                <thead class="bg-secondary">
                    <tr>
                        <th class="text-light" scope="col">Department Name</th>
                        <th class="text-light" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($department as $item)
                        <tr class="tb">
                            <td class="align-middle fw-bolder p-3">{{ $item->department_name }}
                            </td>
                            {{-- delete button --}}
                            <td class="align-middle mt-3">
                                <button id="Deletedepartment" data-id="{{ $item->id }}"
                                    class="fas fa-trash-alt fa-lg rounded text-light border-0  shadow p-2">
                                </button>

                            {{-- update button --}}

                                <a id="departmentshowupdate" data-uid="{{ $item->id }}"
                                    data-name="{{ $item->department_name }}"
                                    class="text-decoration-none fas fa-edit fa-lg bg-primary fa-lg ms-2 rounded text-light p-2"
                                    href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#updateModal">
                                </a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


            <div class="demo">
                {!! $department->links('vendor.pagination.custom') !!}
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('#departmentaddForm').submit(function(e) {
            e.preventDefault();
            // Validate the form fields
            if (!validateForm()) {
                return;
            }
            // Get the form data
            var gformData = new FormData(this);
            $.ajax({
                url: '{{ route('add.department') }}',
                type: 'POST',
                data: gformData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $(".table").load(location.href + ' .table');
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Added successfully',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000,
                        timerProgressBar: true
                    });
                },
            });
        });
    });

    // Function to validate form fields
    function validateForm() {
        var isValid = true;

        // Validate name
        var name = $("input[name='departmentname']").val();
        if (name.trim() === '') {
            $('#name_error').text('please enter the department name');
            isValid = false;
        } else if (name.length > 40) {
            $('#name_error').text('Name should not exceed 40 characters');
            isValid = false;
        } else {
            $('#name_error').text('');
        }
        return isValid;
    }

    // pagination
    $(document).ready(function() {

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            getProducts(page);
        });

        function getProducts(page) {
            $.ajax({
                url: '/pagination/department?page=' + page,
                success: function(response) {
                    $('#tableContainer').html(response);
                }
            });
        }
        // Delete hotel
        $(document).on('click', '#Deletedepartment', function() {
            var departmentId = $(this).data('id');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this department!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#fd5c63',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/deletedepartment/' + departmentId,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: () => {
                            Swal.fire('Deleted!',
                                'The department has been deleted.',
                                'success');
                            // Remove the deleted hotel row from the table
                            $(this).closest('tr').remove();
                            // Remove the success message after 2 seconds
                            setTimeout(() => {
                                Swal.close();
                            }, 900);
                        },
                        error: () => {
                            Swal.fire('Error!',
                                'An error occurred while deleting the department.',
                                'error');
                        },
                    });
                }
            });
        });

        $(document).on('click', '#departmentshowupdate', function() {
            let uid = $(this).data('uid');
            let name = $(this).data('name');
            // Set the values of the input fields in the update form
            $('#up_id').val(uid);
            $('#up_name').val(name);
        });
    });

        // update department
                $(document).ready(function() {
        let formChanged = false;
        $('#departmentupdateForm input').on('input', function() {
            formChanged = true;
        });
        $('#departmentupdateForm').submit(function(e) {
            e.preventDefault();
            if (!formChanged) {
                // Display a message asking the user to make some updates
                Swal.fire({
                    icon: 'warning',
                    title: 'No Changes Made',
                    text: 'Please make some changes in the update form before submitting.',
                });
                return;
            }
            //   // Get the form data
            let up_id = $('#up_id').val();
            let upname = $('#up_name').val();

            let formData = new FormData();
            formData.append('up_id', up_id);
            formData.append('up_name', upname);
            $.ajax({
                url: '{{ route('department.update') }}',
                method: 'post',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },

                success: function(response) {
                    $("#updateModal").modal("hide");
                    $("#updateModal form")[0].reset();
                    // Update pagination content after successful update
                    let currentPage = $('.pagination .active').text();
                    // Assuming the active page indicator has 'active' class
                    getProducts(currentPage);
                    // Reset the formChanged flag after successful submission
                    formChanged = false;
                     // Show success message
                     Swal.fire({
                        icon: 'success',
                        title: 'Update successfully',
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 8000,
                        timerProgressBar: true
                    });
                },
            });
        });
    });

        function getProducts(page) {
            $.ajax({
                url: '/pagination/department?page=' + page,
                success: function(response) {
                    $('#tableContainer').html(response);
                }
            });
        }

</script>
