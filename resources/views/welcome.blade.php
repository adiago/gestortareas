<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h1>Gestor de tareas</h1>
            </div>
            <form method="POST" action="store-task" id="form-task">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    {!! Form::text('taskname', null, ['placeholder'=>'Nueva tarea...', 'id'=>'taskname']) !!}
                </div>
                <div class="col-md-6">
                    <label ref="php">PHP</label>
                    {!! Form::checkbox('php', 1, false, ['id'=>'php']) !!}
        
                    <label ref="js">Javascript</label>
                    {!! Form::checkbox('js', 1, false, ['id'=>'js']) !!}

                    <label ref="php">CSS</label>
                    {!! Form::checkbox('css', 1, false, ['id'=>'css']) !!}

                    {!! Form::button('Añadir', ['id'=>'add']) !!}
                </div>
            </div>
            </form>
            <div class="row">
                    {{json_encode($tasks)}}
                <div class="col-md-12">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Tarea</th>
                            <th scope="col">Categorías</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            {{-- @foreach($tasks as $task)
                                <tr>
                                    <td>{{$task->title}}</td>
                                    <td>{{json_encode($task->category)}}</td>
                                    <td><i class="fa fa-window-close"></i></td>
                                </tr>
                        @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
    </body>
</html>
<script>
    // function addTask() {
    //     alert('hehe');
    // }

    $('#add').click(function(e) {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
        let data = {
            'taskname': $('#taskname').val(),
            'php': $('#php').val(),
            'css': $('#css').val(),
            'js': $('#js').val(),
        }
        
        if(!validateForm(data)) {
            alert('Error de validación')
            return;
        }

        $.post('/store-task', {data: data}, function(response){
            alert('post ok')
        });

    });

    function validateForm(data) {
        if(data.taskname.trim() != '' && (data.php || data.css || data.js)) {
            return true
        }
        return false
    }
</script>