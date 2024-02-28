@extends('layouts.admin')
@section('content')
{{-- LOADING spinner --}}
<div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-info" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        {{-- end spinner --}}
            <!-- Sale & Revenue Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 ">
                    <div class="col-sm-6 col-xl-3 ">
                        <div class="bg-light border border-1 border-primary shadow rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-hotel fa-3x text-info"></i>
                            <div class="ms-3">
                                <p class="mb-2  fw-bolder">Tot Department</p>
                                <h5 class="mb-0 ms-2 bg-primary rounded text-center p-1 text-light">{{$departmentcount}}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light border border-1 border-primary shadow rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fas fa-bed fa-3x text-info"></i>
                            <div class="ms-3">
                                <p class="mb-2  fw-bolder">Employee Data</p>
                                <h6 class="mb-0 ms-2 bg-primary rounded text-center p-1 text-light">
                                    {{$empcount}}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light border border-1 border-primary shadow rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-user fa-3x text-info"></i>

                            <div class="ms-3">
                                <p class="mb-2 fw-bolder">Total Admins</p>
                                <h6 class="mb-0 ms-2 bg-primary rounded text-center p-1 text-light">
                                    {{$adminRole}}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light border border-1 border-primary shadow rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-info"></i>
                            <div class="ms-3">
                                <p class="mb-2 fw-bolder">Total Employee</p>
                                <h6 class="mb-0 ms-2 bg-primary rounded text-center p-1 text-light">
                                    {{$employeeRole}}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sale & Revenue End -->
@endsection
