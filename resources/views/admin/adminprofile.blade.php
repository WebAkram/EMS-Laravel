@extends('layouts.admin')
@section('content')
    {{-- title section --}}
    <h3 class="text-center text-dark mb-0 p-2"
        style="background-image: linear-gradient(120deg, #35f58e 0%, #7dfd8e 100%);border-radius:3px;">Profile Details</h3>

    <div style="border: 1px solid #a5b4fc;" class="mx-auto col-xl-6 mt-2  shadow  rounded">
        <div class="text-center">
            <img id="profile-image" class="rounded-circle mx-auto mt-1" src="{{ asset('dashboard/img/user.jpg') }}"
                alt="" style="width: 120px; height: 120px; object-fit: cover;">
            <br>

            @if (Auth::check())
                <h6 style="background-image: linear-gradient(120deg, #0f0f0f 0%, #1a4b4b 100%); border-top-left-radius: 15px; border-bottom-right-radius: 15px; font-weight: unset;"
                    class="mt-2 name p-2  d-lg-inline-flex text-light ">
                    Username : {{ Auth::user()->name }}
                </h6>
                <br>
                <h6 style="border-top-left-radius: 15px; border-bottom-right-radius: 15px; font-weight: unset; "
                    class="mt-2  p-2 bg-secondary  d-lg-inline-flex text-light">
                    Email : {{ Auth::user()->email }}
                </h6>
            @else
                <script>
                    window.location = "{{ route('login') }}";
                </script>
            @endif
        </div>
        <form id="updateprofile" method="POST" action="{{ route('updateadmin.profile') }}">
            @csrf
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-3">
                        <label class="currentusername fw-bold text-dark">Username</label>
                        @if (Auth::check())
                            <input type="text" name="current_username" id="current_username"
                                class="form-control fw-bold text-dark bg-light" value="{{ Auth::user()->name }}" readonly>
                        @endif

                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="fw-bold text-dark">New Username</label>
                        <input type="text" name="new_username" id="new_username"
                            class="form-control fw-bold text-dark bg-light">
                        <span id="new_username_error" class="text-danger"></span>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 mt-3">
                        <label class="fw-bold text-dark">Current Password</label>
                        <div class="input-group">
                            <input type="password" name="current_password" id="current_password"
                                class="form-control fw-bold text-dark bg-light error-border" placeholder="******">
                            <span class="input-group-text" id="toggleCurrentPassword">
                                <i class="fas fa-eye" id="currentPasswordIcon"></i>
                            </span>
                        </div>
                        <span id="new_currentpassword_error" class="text-danger"></span>
                    </div>
                    <div class="col-md-6 mt-3">
                        <label class="fw-bold text-dark">New Password</label>
                        <div class="input-group">
                            <input type="password" name="new_password" placeholder="******" id="new_password"
                                class="form-control fw-bold text-dark bg-light">
                            <span class="input-group-text" id="toggleNewPassword">
                                <i class="fas fa-eye" id="newPasswordIcon"></i>
                            </span>
                        </div>
                        <span id="new_password_error" class="text-danger"></span>
                    </div>
                </div>


                <div class="text-center pt-3">
                    <button class="btn btn-dark border-0 mx-auto" type="button" id="update_button">
                        Update
                    </button>

                </div>
            </div>
    </div>
    </form>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
    $(document).ready(function() {
        $('#update_button').click(function(e) {
            e.preventDefault();

            // Clear any previous error messages
            $('.text-danger').empty();

            // Disable the button while the AJAX request is in progress
            $('#update_button').prop('disabled', true);

            // Store the original button text
            var originalButtonText = $('#update_button').text();

            // Set the button text to the loading spinner
            $('#update_button').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Updating'
            );
            // Serialize all form data
            var formData = $('#updateprofile').serialize();
            setTimeout(function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('updateadmin.profile') }}",
                    data: formData,
                    success: function(response) {
                        if (response.success) {
                            // Change the label text to "Previous Username"
                            $(".currentusername").text("Previous Username");
                            // Assuming `response.newName` contains the updated name
                            $(".name").text(response.newName);
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated successfully',
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                showCloseButton: true,
                            });
                        } else {
                            // Handle errors based on the response
                            if (response.passwordMismatch) {
                                $('#new_currentpassword_error').text(
                                    'Current password does not match.');


                            } else if (response.newPasswordRequired) {
                                $('#new_currentpassword_error').text(
                                    'Current password is required.'
                                );

                            } else if (response.passwordNotChanged) {
                                $('#new_currentpassword_error').text(
                                    'New password must not match the current password.'
                                );


                            } else {
                                $('.error-message').text(
                                    'Profile update failed...');
                            }
                        }

                        // Re-enable the button and restore the original text
                        $('#update_button').prop('disabled', false);
                        $('#update_button').text(originalButtonText);
                    },
                });
            }, 300);
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        const toggleCurrentPassword = document.getElementById("toggleCurrentPassword");
        const currentPasswordInput = document.getElementById("current_password");
        const currentPasswordIcon = document.getElementById("currentPasswordIcon");

        const toggleNewPassword = document.getElementById("toggleNewPassword");
        const newPasswordInput = document.getElementById("new_password");
        const newPasswordIcon = document.getElementById("newPasswordIcon");

        toggleCurrentPassword.addEventListener("click", function() {
            togglePasswordVisibility(currentPasswordInput, currentPasswordIcon);
        });

        toggleNewPassword.addEventListener("click", function() {
            togglePasswordVisibility(newPasswordInput, newPasswordIcon);
        });

        function togglePasswordVisibility(input, icon) {
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }
    });
</script>

<style type="text/css">
    .form-control:focus {
        border: 2px solid #818cf8 !important;
        box-shadow: none !important;
    }

    .btn-dark {
        background-color: #111827 !important;
    }
</style>
