<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            * {
                box-sizing: border-box;
            }

            html, body {
                background-color: #FFFFFF;
                color: #67676F;
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
            }

            .content {
                margin: 0 auto;
            }

            .step {
                font-size: 24px;
                padding: 0 25px;
                margin-bottom: 30px;
            }

            .alert {
                color: #A97061;
            }

            .input-group {
                margin-bottom: 20px;
            }

            label {
                display: block;
            }

            input {
                padding: 12px;
                border-radius: 6px;
                font-size: 12px;
                width: 100%;
            }
            .button {
                background-color: #67676F;
                border: 2px solid #67676F;
                color: #FFFFFF;
            }
            h1 {
                text-align:center;
            }
            .output {
                overflow: auto;
                height: 50vh;
                list-style-type: none;
            }
            .film {
                list-style-type: none;
                padding: 2px
            }
            .film-container {
                border: 1px solid #CDCAC6;
            }
            .film-container + .film-container {
                border-top: 0;
            }
            .film-data {
                font-size: 18px;
            }
        </style>
        <script type="text/javascript">
        function getoffset() {
            console.log("Submitted!");
            const date = new Date();
            document.getElementById('offset').value =  date.getTimezoneOffset();
            console.log(document.getElementById('offset').value)
        }
        </script>
    </head>
    <body>
    <h1> Albuquerque Film Locations </h1>
    <div class="flex-center full-height">
            <div class="content">
                @yield('content')
            </div>
        </div>
    </body>
</html>