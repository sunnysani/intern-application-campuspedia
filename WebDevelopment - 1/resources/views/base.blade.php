<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Sani's Project</title>

        <!-- JQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #000000;
                font-weight: 600;
                margin-right: 150px;
                margin-left: 150px;
                text-align: center;
            }

            .opening {
                margin-top: 100px;
                margin-bottom: 75px;
            }

            .subjects {
                margin-top: 25px;
                margin-bottom: 25px;
            }

            
            .field-input {
                margin-top: 25px;
                margin-bottom: 25px;
                text-align: center;
            }

            .field-input label {
                margin-bottom: 0px;
            }

            .field-input input {
                margin-bottom: 0px;
                width: 400px;
            }

            @media only screen and (max-width: 1200px) {
                html, body {
                    margin-right: 50px;
                    margin-left: 50px;
                }
            }

            .closing {
                margin-top: 0px;
                margin-bottom:0px;
            }
        </style>
        
        @yield('custom_head')
    </head>
    <body>
        
        <div class="flex-center position-ref full-height">
            <div class="opening">
                <h1>Hello, welcome to my Laravel&nbsp;Project</h1>
                <p>Created by Naufal&nbsp;Sani
            </div>
        </div>

        @yield('content')

        <div class="flex-center position-ref full-height">
            <div class="closing">
                <br> <hr> <br>
                <p>Created by Naufal&nbsp;Sani<br>
                <a href="https://github.com/sunnysani/intern-application-campuspedia">Checkout the github!</a><br></p>
            </div>
        </div>
    </body>
    
</html>