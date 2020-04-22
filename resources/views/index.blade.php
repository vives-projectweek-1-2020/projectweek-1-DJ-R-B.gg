<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Uploadzone</title>
    <meta name= "author" content="Brent Schaepdrijver">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
  
	<div class="welcome">
        <header>Welkom, upload je taken hier.</header>
        <button type="button" class="login" onclick="select('login')">Login hier</button> 
        <button type="button" class="register" onclick="select('register')">Registreer hier</button>
             
    </div>
    <div class="choices">
        <button type="button" class="talen" onclick="select('talen')">Talen </button>
        <button type="button" class="wiskunde" onclick="select('wiskunde')">Wiskunde </button>
        <button type="button" class="geschiedenis" onclick="select('geschiedenis')">Geschiedenis</button>
    </div>
    
    <div class="upload">
      <button  type="button" class="files" onclick="select('files')">Plaats je files hier om ze te uploaden.</button>
    </div>
  
</body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
