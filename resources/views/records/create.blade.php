@extends('layouts.app')

@section('content')

    <div class="app-main" id="main">
        <!-- begin container-fluid -->
        <div class="container-fluid">
            <!-- begin row -->
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <!-- begin page title -->
                    <div class="d-block d-lg-flex flex-nowrap align-items-center">
                        <div class="page-title mr-4 pr-4 border-right">
                            <h1>Dashboard</h1>
                        </div>
                        <div class="breadcrumb-bar align-items-center">
                            <nav>
                                <ol class="breadcrumb p-0 m-b-0">
                                    <li class="breadcrumb-item">
                                        <a href="index.html"><i class="ti ti-home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        Dashboard
                                    </li>
                                    <li class="breadcrumb-item active text-primary" aria-current="page">Default</li>
                                </ol>
                            </nav>
                        </div>

                    </div>
                    <!-- end page title -->
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 m-b-30">
                    <h3>Budget</h3>
                    <create-record></create-record>
                </div>
            </div>
        </div>
        <!-- end container-fluid -->
    </div>



@endsection
