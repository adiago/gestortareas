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
            .center50{margin:0 auto; width: 50%}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row center50">
                <h1>Gestor de tareas</h1>
                <hr>
            </div>
        
            <div class="row center50">
                <form method="POST" action="store-task" id="form-task">
                    @csrf
        
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
                </form>

            </div>
            <div class="row center50">
                <div class="col-md-12">
                    <table class="table table-striped" id="tasks-table">
                        <thead>
                            <tr>
                                <th scope="col">Tarea</th>
                                <th scope="col">Categorías</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tasks as $task)
                                <tr id="{{$task->id}}">
                                    <td>{{$task->title}}</td>
                                    <td>
                                        @foreach($task->categories as $cat){{$cat->name}} @endforeach
                                    </td>
                                    <td>
                                        <button type="button" class="close" aria-label="Close" onclick="deletetask({{$task->id}})">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
    $('#add').click(function(e) {
       
        let data = {
            'taskname': $('#taskname').val(),
            'php': $('#php').prop('checked'),
            'css': $('#css').prop('checked'),
            'js': $('#js').prop('checked')
        }
        
        if(!validateForm(data)) {
            alert('Error de validación')
            return;
        }

        $.post('/store-task', {data})
        .done(function(response){
            let categories = '';
            response.categories.forEach(function(elem) {
                categories += ' '+elem.name
            })
    
            $('#tasks-table tr:last').after('<tr id="'+response.id+'">'+
                '<td>'+response.title+'</td>'+
                '<td>'+
                    categories
                    +'</td>'+
                '<td class="text-justify-content-center">'+
                    '<button type="button" class="close" aria-label="Close" onclick="deletetask('+response.id+')">'+
                    '<span aria-hidden="true">&times;</span>'+
                    '</button></td>'+
            '</tr>');

        }).fail(function() {
            alert('Error al añadir');

        });

    });

    function deletetask(id) {
        $.post('/delete-task/'+id).done(function(response){
            $('#'+id).remove();
        }).fail(function() {
            alert('Error al eliminar');
        })
    } 

    function validateForm(data) {
        if(data.taskname.trim() != '' && (data.php || data.css || data.js)) {
            return true
        }
        return false
    }
</script>