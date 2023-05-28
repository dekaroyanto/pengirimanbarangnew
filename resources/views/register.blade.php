@extends('layout.mazer')

@section('judulhal')
<h3>Tambah Akun</h3>
@endsection

@section('content')
<div class="page-content">


    <div class="card">
        <div class="card-content">
            <div class="card-body">
                <form action="/registeruser" method="post" class="form form-vertical">
                    @csrf
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="first-name-icon">Name</label>
                                    <div class="position-relative">
                                        <input type="text" name="name" class="form-control" id="first-name-icon" />
                                        <div class="form-control-icon">
                                            <i class="bi bi-person"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="email-id-icon">Email</label>
                                    <div class="position-relative">
                                        <input type="text" name="email" class="form-control" id="email-id-icon" />
                                        <div class="form-control-icon">
                                            <i class="bi bi-envelope"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group has-icon-left">
                                    <label for="password-id-icon">Password</label>
                                    <div class="position-relative">
                                        <input type="password" name="password" class="form-control" id="password-id-icon" />
                                        <div class="form-control-icon">
                                            <i class="bi bi-lock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">
                                    Submit
                                </button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">
                                    Reset
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection