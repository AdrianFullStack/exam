@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>
                <div class="card-body">
                    <form id="form-login" method="POST" action="/api/auth/login">
                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            if(typeof(localStorage.getItem("token"))!='undefined'){
                window.location.href = "/nota/create";
            };


            $('#form-login').submit(function (e) {
                e.preventDefault()
                var data = $(this).serialize();

                $.post('api/auth/login', data, function (response) {
                    console.log(response)
                    if(response.status){
                        window.location.href = "/nota/create";
                        localStorage.setItem('token', response.token_type + ' ' + response.access_token);
                        localStorage.setItem('user_id', response.user);
                    }
                })
            })
        })
    </script>
@endsection

