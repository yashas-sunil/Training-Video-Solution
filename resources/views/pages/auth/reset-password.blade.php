@extends('layouts.master')

@section('title', 'Reset Password')

@section('content')
    <main class="consumption px-md-2 px-sm-2 py-4 min-width" role="main" >
        <h3 class="text-secondary text-center pb-3"><b>Reset Password</b></h3>
        <form id="form-reset-password"  method="POST" action="{{ route('reset-password.store') }}">
            @csrf
            <input type="hidden" name="token" value="{{ request()->get('token') ?? 'null' }}">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="password" class="col-sm-4 col-form-label col-form-label-sm">New Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control password form-control-sm" id="new_password" name="password">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-4 col-form-label col-form-label-sm">Confirm Password</label>
                        <div class="col-sm-7">
                            <input type="password" class="form-control form-control-sm password_confirmation" id="password_confirmation" name="password_confirmation" data-rule-equalto='#new_password'>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-primary mb-5">Submit</button>
                </div>
            </div>
        </form>
        @if (session()->has('invalid_token'))
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="text-center">
                            Token is invalid or expired.
                        </div>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        @endif
    </main>
@endsection

@push('script')
    <script>
        $(function () {
            $('#form-reset-password').validate({
                rules: {
                    password: {
                        required: true,
                    },
                    password_confirmation: {
                        required: true,
                        equalTo : "#new_password"
                    }
                },
                messages: {
                    password_confirmation: {
			   		equalTo : 'Passwords do not match'
			   	}
			},
            });
        });
    </script>
@endpush

