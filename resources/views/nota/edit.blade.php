@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">CRUD Notas</div>
                    <div class="card-body">
                        <form id="form-create" method="POST" action="/api/nota">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Curso</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="curso" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Nota</label>

                                <div class="col-md-6">
                                    <input type="number" class="form-control" name="nota" required>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Descripción</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="description" required>

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row justify-content-center">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <td>Curso</td>
                    <td>Nota</td>
                    <td>Descripcion</td>
                </tr>
                </thead>
                <tbody id="tbody">
                <tr>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function () {
            var user = localStorage.getItem('user_id');
            var token =  localStorage.getItem('token');
            var url = $('#form-create').attr('action');
            console.log(token);

            if(token == null){
                window.location.href = "/login";
            };

            $.ajax({
                url: $('#form-create').attr('action'),
                headers: {
                    'Authorization':token,
                },
                method: 'GET',
                success: function(response){
                    console.log(response);

                    var row = '';
                    $.each(response, function (key, value) {
                        row += '<tr>';
                        row += '<td>'+value.curso+'</td>'
                        row += '<td>'+value.nota+'</td>'
                        row += '<td>'+value.description+'</td>'
                        row += '</tr>';

                    })
                    $('#tbody').html(row)
                }
            });

            $('#form-create').submit(function (e) {
                e.preventDefault();
                console.log(user);
                var data = $(this).serialize() + "&user_id=" + user;
                var form = $(this);

                $.ajax({
                    url: $(form).attr('action'),
                    headers: {
                        'Authorization':token,
                    },
                    method: 'POST',
                    data: data,
                    success: function(response){
                        if(response.status){
                            var row = '';
                            row += '<tr>';
                            row += '<td>'+response.data.curso+'</td>'
                            row += '<td>'+response.data.nota+'</td>'
                            row += '<td>'+response.data.description+'</td>'
                            row += '</tr>';

                            $('#tbody').append(row);
                        }
                        console.log(data);
                    }
                });
            })
        })
    </script>
@endsection