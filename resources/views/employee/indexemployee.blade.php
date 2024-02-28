@extends('layouts.app')
@section('content')
    <h3 class="text-center  text-dark mb-0 p-1"
        style="border-radius:3px;  background-image: linear-gradient( 135deg, #81FBB8 10%, #28C76F 100%);">
        Employee
    </h3>

    {{-- add data in model --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px;">
            <div class="modal-content">
                <form id="employeaddForm" autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header ">
                        <h4 class="modal-title text-dark fw-bold" id="exampleModalLabel">Add New Employee</h4>
                        <button type="button" class="btn-close bg-danger rounded-circle" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Name</label>
                                    <input type="text" name="name" placeholder="Enter your full name"
                                        class="form-control text-dark bg-light" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Email</label>
                                    <input type="email" name="email" placeholder="Enter your email address"
                                        class="form-control text-dark bg-light" required>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Phone</label>
                                    <input type="number" class="form-control text-dark" name="phone"
                                        placeholder="Enter your phone num" required>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="fw-bold text-dark">Address</label>
                                    <input type="text" class="form-control text-dark" name="Address"
                                        placeholder="Enter your address" required>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="fw-bold text-dark">Date of Birth</label>
                                    <input type="text" name="Dateofbirth" required
                                        class="text-dark form-control Dateofbirth" placeholder="DOB">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="fw-bold text-dark">Date of Issue</label>
                                    <input type="text" name="DateofIssue" required
                                        class="text-dark form-control Dateofissue" placeholder="DOI">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="fw-bold text-dark">Date of Expiry</label>
                                    <input type="text" name="DateofExpiry"
                                        class="text-dark
                                    required form-control Dateofexpiry"
                                        placeholder="DOE">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="fw-bold text-dark">Job Role</label>
                                    <input type="text" name="Jobrole" required class="text-dark form-control"
                                        placeholder="Enter your jobrole">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="fw-bold text-dark">Cnic</label>
                                    <input type="number" name="Cnic" class="text-dark form-control" placeholder="Cnic"
                                        required>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="fw-bold text-dark">Department</label>

                                    <select name="department" required class="form-control text-dark">
                                        <option class="d-none" selected="" value="">Choose the Department
                                        </option>
                                        @foreach ($department as $departments)
                                            <option class="text-dark" value="{{ $departments->department_name }}">
                                                {{ $departments->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="fw-bold text-dark">Document</label>
                                    <input type="file" name="document" class="form-control" id="uploadPdf" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- View modal data --}}
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header ">
                        <h4 class="modal-title text-dark fw-bold" id="exampleModalLabel">View Employee Details</h4>
                        <button type="button" class="btn-close bg-danger rounded-circle" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Employee Id</label>
                                    <p id="view_id" class="form-control text-dark"> </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Phone</label>
                                    <p id="phone" class="form-control text-dark"> </p>
                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Cnic</label>
                                    <p id="cnic" class="form-control text-dark"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Date of Birth</label>
                                    <p id="dob" class="form-control text-dark"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Date of Issue</label>
                                    <p id="doi" class="form-control text-dark"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Date of Expiry</label>
                                    <p id="doe" class="form-control text-dark"></p>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="fw-bold text-dark">Address</label>
                                    <p id="address" class="form-control text-dark"> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end view modal  --}}

    <div style="margin-right: 25px;" class="float-end py-2 container-fluid">
        <div class="alert alert-success shadow-md border text-danger fw-bolder text-center alert-dismissible fade" role="alert">
            Tomorrow is the expiry date of <span id="empName" ></span>! Please renew your data.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <button type="button" class="btn-md float-end mt-3 py-2 btn btn-secondary text-light" data-bs-toggle="modal"
            data-bs-target="#exampleModal">
            Add new<i style="top:2px; left:5px; font-size:22px; position:relative;" class="fas fa-plus-circle"></i>
        </button>

    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div id="tableContainer" class="table-responsive">
                    <table class="table  table-hover">
                        <thead class="bg-secondary">
                            <tr>
                                <th class="text-light" scope="col">Name</th>
                                <th class="text-light" scope="col">Doc</th>
                                <th class="text-light" scope="col">Jobrole</th>
                                <th class="text-light" scope="col">Dept</th>
                                <th class="text-light" scope="col">Email</th>
                                <th class="text-light" scope="col">Status</th>
                                <th class="text-light" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employee as $emp)
                                <tr class="tb">
                                    <td class="align-middle">{{ $emp->name }}</td>
                                    <td class="align-middle rounded-circle">
                                        @if (pathinfo($emp->document, PATHINFO_EXTENSION) == 'pdf')
                                            <a href="{{ asset('assets/documents/' . $emp->document) }}"
                                                target="_blank"><iframe
                                                    src="{{ asset('assets/documents/' . $emp->document) }}"
                                                    alt="Employee Document" class="img-fluid img-thumbnail "></iframe></a>
                                        @else
                                            <img src="{{ asset('assets/documents/' . $emp->document) }}"
                                                alt="Employee Document" class="img-fluid img-thumbnail rounded-circle">
                                        @endif
                                    </td>
                                    <td class="align-middle ">{{ $emp->jobrole }}</td>
                                    <td class="align-middle">{{ $emp->department }}</td>
                                    <td class="align-middle ">{{ $emp->email }}</td>
                                    <td class="align-middle">
                                        <button class="btn shadow border status-btn
                                        @if($emp->status === 'Approval')
                                            btn-success text-light fw-normal
                                        @elseif($emp->status === 'Decline')
                                            btn-danger text-light fw-normal
                                        @else
                                            btn-light fw-bolder
                                        @endif">
                                            {{ $emp->status }}
                                        </button>

                                    </td>
                                    <td class="align-middle">
                                        {{-- view modal button --}}
                                        <button id="viewbutton" data-viewid="{{ $emp->id }}"
                                            data-phone="{{ $emp->phone }}" data-address="{{ $emp->address }}"
                                            data-empname="{{ $emp->name }}" data-cnic="{{ $emp->cnic }}"
                                            data-dateofbirth="{{ $emp->dateofbirth }}"
                                            data-issue="{{ $emp->dateofissue }}" data-expiry="{{ $emp->dateofexpiry }}"
                                            data-bs-toggle="modal" data-bs-target="#viewModal"
                                            class="fas fa-eye bg-dark   fa-lg rounded text-light  p-2 border-0 shadow ">
                                        </button>
                                        {{-- delete data  --}}
                                        <button id="Deleteemployee" data-eid="{{ $emp->id }}"
                                            class="fas fa-trash-alt   fa-lg rounded text-light p-2 border-0 shadow ">
                                        </button>
                                        {{-- update modal  --}}
                                        <a id="updateemployee" data-uid="{{ $emp->id }}"
                                            data-upname="{{ $emp->name }}" data-upphone="{{ $emp->phone }}"
                                            data-upemail="{{ $emp->email }}" data-upaddress="{{ $emp->address }}"
                                            data-updepartment="{{ $emp->department }}"
                                            data-upjobrole="{{ $emp->jobrole }}" data-upcnic="{{ $emp->cnic }}"
                                            data-updob="{{ $emp->dateofbirth }}" data-updoi="{{ $emp->dateofissue }}"
                                            data-updoc="{{ $emp->document }}" data-updoe="{{ $emp->dateofexpiry }}"
                                            class="text-decoration-none fas fa-edit fa-lg border-0 p-2 bg-primary fa-lg rounded text-light "
                                            href="" data-bs-toggle="modal" data-bs-target="#updateModal">
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="demo">
                        {!! $employee->links('vendor.pagination.custom') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- update employee model --}}
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px;">
            <div class="modal-content">
                <form id="employeupdateForm" autocomplete="off" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="up_id">
                    <div class="modal-header ">
                        <h4 class="modal-title text-dark fw-bold" id="exampleModalLabel">Update Employee</h4>
                        <button type="button" class="btn-close bg-danger rounded-circle" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class=" text-dark">Name</label>
                                    <input type="text" id="upname" class="form-control text-dark bg-light">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="text-dark">Email</label>
                                    <input type="email" id="upemail" class="form-control text-dark bg-light">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class=" text-dark">Phone</label>
                                    <input type="number" class="form-control text-dark" id="upphone">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="text-dark">Address</label>
                                    <input type="text" class="form-control text-dark" id="upaddress">

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="text-dark">Date of Birth</label>
                                    <input type="text" id="updob" class="text-dark form-control Dateofbirth">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class=" text-dark">Date of Issue</label>
                                    <input type="text" id="updoi" class="text-dark form-control Dateofissue">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="text-dark">Date of Expiry</label>
                                    <input type="text" id="updoe" class="text-dark form-control Dateofexpiry">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="text-dark">Job Role</label>
                                    <input type="text" id="upjobrole" class="text-dark form-control">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="text-dark">Cnic</label>
                                    <input type="number" id="upcnic" class="text-dark form-control">
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="text-dark">Department</label>

                                    <select id="updepartment" class="form-control fw-bold text-dark ">
                                        <option class="text-dark">
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mt-2">
                                    <label class="text-dark">Document</label>
                                    <input type="file" class="form-control" id="updocu">
                                    <img id="previewImage" src="#" alt="Preview" class="img-thumbnail">
                                    <embed id="previewPdf" src="#" type="application/pdf" class="img-thumbnail"
                                        style="display: none;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- end update model --}}
@endsection

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://mozilla.github.io/pdf.js/build/pdf.js"></script>
<script>


    $(document).ready(function() {



        $('#employeaddForm').submit(function(e) {
            e.preventDefault();
            // Get the form data
            var gformData = new FormData(this);
            $.ajax({
                url: '{{ route('addemployee') }}',
                type: 'POST',
                data: gformData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $("#exampleModal").modal("hide");
                    $("#exampleModal form")[0].reset();
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


       $(document).ready(function () {
        // view employee data
        showEmployeeData($('#viewbutton'));
        $(document).on('click', '#viewbutton', function() {
            showEmployeeData($(this));
        });



        function showEmployeeData(button) {
        // Retrieve data from the clicked button
        let vid = button.data('viewid');
        let phone = button.data('phone');
        let address = button.data('address');
        let cnic = button.data('cnic');
        let dob = button.data('dateofbirth');
        let doi = button.data('issue');
        let doe = button.data('expiry');
        let empName = button.data('empname');
            // Set values in the update form
            $('#view_id').text(vid);
            $('#phone').text(phone);
            $('#address').text(address);
            $('#cnic').text(cnic);
            $('#dob').text(dob);
            $('#doi').text(doi);
            $('#doe').text(doe);

            // Calculate days left for expiry
            let daysLeft = calculateDaysLeft(new Date(doe));

            if (daysLeft === 1) {
                // Show the alert
                $('.alert').addClass('show');
                $('#empName').text(empName);
            }

        }


    function calculateDaysLeft(expiryDate) {
    const currentDate = new Date();
    const timeDifference = expiryDate.getTime() - currentDate.getTime();
    const daysLeft = Math.ceil(timeDifference / (1000 * 60 * 60 * 24)); // Convert milliseconds to days
    return daysLeft;
}


        });

        // Delete employee
        $(document).ready(function() {
        $(document).on('click', '#Deleteemployee', function() {
            var employeeId = $(this).data('eid');
            Swal.fire({
                title: 'Are you sure?',
                text: 'You will not be able to recover this employee!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#fd5c63',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/deleteemployee/' + employeeId,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        success: () => {
                            Swal.fire('Deleted!',
                                'The employee has been deleted.',
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
                                'An error occurred while deleting the employee.',
                                'error');
                        },
                    });
                }
            });
        });
    });
    //  pagination
    $(document).ready(function() {
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            getProducts(page);
        });

        function getProducts(page) {
            $.ajax({
                url: '/pagination/employee?page=' + page,
                success: function(response) {
                    $('#tableContainer').html(response);
                }
            });
        }
    });
    //  show update value in modal
    var departments = @json($department);
    $(document).ready(function() {
        $(document).on('click', '#updateemployee', function() {
            let uid = $(this).data('uid');
            let up_name = $(this).data('upname');
            let up_email = $(this).data('upemail');
            let up_phone = $(this).data('upphone');
            let up_address = $(this).data('upaddress');
            let up_department = $(this).data('updepartment');
            let up_jobrole = $(this).data('upjobrole');
            let up_cnic = $(this).data('upcnic');
            let up_dob = $(this).data('updob');
            let up_doi = $(this).data('updoi');
            let up_doc = $(this).data('updoc');
            let up_doe = $(this).data('updoe');
            // Set the values of the input fields in the update form
            $('#up_id').val(uid);
            $('#upname').val(up_name);
            $('#upemail').val(up_email);
            $('#upphone').val(up_phone);
            $('#upaddress').val(up_address);
            $('#upjobrole').val(up_jobrole);
            $('#upcnic').val(up_cnic);
            $('#updob').val(up_dob);
            $('#updoi').val(up_doi);
            $('#updoe').val(up_doe);
            $('#updepartment').empty();
            $('#updepartment').append($('<option>', {
                class: 'd-none',
                text: up_department,
                value: up_department
            }));
            departments.forEach(function(departmnt) {
                $('#updepartment').append($('<option>', {
                    text: departmnt.department_name,
                    value: departmnt.department_name
                }));
            });
            if (up_doc) {
                if (up_doc.toLowerCase().match(/\.(jpg|jpeg|png|gif)$/)) {
                    // Display the uploaded file as an image
                    $('#previewImage').attr('src', "{{ asset('assets/documents/') }}" + '/' + up_doc);
                    $('#previewPdf').hide();
                    $('#previewImage').show();
                } else if (up_doc.toLowerCase().match(/\.(pdf)$/)) {
                    // Display the uploaded file as a PDF
                    $('#previewPdf').attr('src', "{{ asset('assets/documents/') }}" + '/' + up_doc);
                    $('#previewImage').hide();
                    $('#previewPdf').show();
                }
            }
            $('#updocu').val(up_doc);
        });
    });
    // update employee
    $(document).ready(function() {
        let formChanged = false;
        $('#employeupdateForm :input').on('input',function() {
                formChanged = true;
            });
        $('.Dateofbirth').on('changeDate', function() {
            formChanged = true;
        });
        $('.Dateofissue').on('changeDate', function() {
            formChanged = true;
        });
        $('.Dateofexpiry').on('changeDate', function() {
            formChanged = true;
        });
        $('#employeupdateForm').submit(function(e) {
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
            let upname = $('#upname').val();
            let upemail = $('#upemail').val();
            let upphone = $('#upphone').val();
            let upaddress = $('#upaddress').val();
            let upjobrole = $('#upjobrole').val();
            let upcnic = $('#upcnic').val();
            let updob = $('#updob').val();
            let updoi = $('#updoi').val();
            let updoe = $('#updoe').val();
            let updepartment = $('#updepartment').val();
            let updocu = $('#updocu').prop('files')[0];

            let formData = new FormData();
            formData.append('up_id', up_id);
            formData.append('up_name', upname);
            formData.append('up_email', upemail);
            formData.append('up_phone', upphone);
            formData.append('up_address', upaddress);
            formData.append('up_jobrole', upjobrole);
            formData.append('up_cnic', upcnic);
            formData.append('up_dob', updob);
            formData.append('up_doi', updoi);
            formData.append('up_doe', updoe);
            formData.append('up_department', updepartment);
            formData.append('up_docu', updocu);
            $.ajax({
                url: '{{ route('employee.update') }}',
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
                    let currentPage = $('.pagination .active').text();
                    getProducts(currentPage);
                    formChanged = false;
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
            url: '/pagination/employee?page=' + page,
            success: function(response) {
                $('#tableContainer').html(response);
            }
        });
    }
</script>
