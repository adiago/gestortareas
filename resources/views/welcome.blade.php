<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

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
    <div>
        <h1>Gestor de tareas</h1>
    </div>
    <div class="col-md-12">
        <div class=col-md-6">
            {!! Form::text('new_task', null, ['placeholder'=>'Nueva tarea...', 'id'=>'new_task']) !!}
        </div>
        <div class="col-md-6">
            <label ref="php">PHP</label>
            {!! Form::checkbox('php', 1, false, ['id'=>'php']) !!}

            <label ref="js">Javascript</label>
            {!! Form::checkbox('js', 1, false, ['id'=>'js']) !!}

            <label ref="php">CSS</label>
            {!! Form::checkbox('css', 1, false, ['id'=>'css']) !!}

            {!! Form::button('Añadir', ['onclick'=>'addTask']) !!}
        </div>
    </div>
    </body>
</html>
