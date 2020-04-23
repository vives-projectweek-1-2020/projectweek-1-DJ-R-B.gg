<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grademe</title>
    <meta name= "author" content="Brent Schaepdrijver">
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/wiskunde.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>     
@include('header')
            <div class="upload">
            <input type="button" class="btn btn-primary" class="sticky-top" value="Upload hier je wiskunde taak." />      
        </div>

    <div class="container">
        <div class="card text-center">
            <div class="card-header">Wiskunde</div>
                <div class="card-body">  
                <p class="card-text">De verbetering</p>
                <h1 class="text-center"> Hier staat de oplossing van de taak </h1>
                <div class="container pb-cmnt-container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3"class="card text-center">
            <div class="panel panel-info">
                <div class="panel-body">
                   
                    <textarea placeholder="Write your comment here!" class="pb-cmnt-textarea" class="text-center"></textarea>
                    <div class="float-left">
                    <button class="btn btn-primary pull-right" type="button" >Share</button>
</div>  
                </div>
            </div>
        </div>
    </div>
</div>
                <img src="..." class="img-fluid" alt="Responsive image">
                </div>
   
</div>
</body>
</html>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
