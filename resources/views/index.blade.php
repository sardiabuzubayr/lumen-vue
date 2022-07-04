<!DOCTYPE html>
<html >
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel | Vue js</title>
        <link href="<?php echo env('HOST').":".env('HMR_PORT')?>/css/app.css" rel="stylesheet"/>

    </head>
    <body>
        <div id="app">
            <App/>
            <script type="text/javascript" src="<?php echo env('HOST').":".env('HMR_PORT')?>/js/app.js"></script>
        </div>
    </body>
</html>