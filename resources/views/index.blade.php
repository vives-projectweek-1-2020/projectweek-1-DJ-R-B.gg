<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grademe</title>
    <meta name= "author" content="Brent Schaepdrijver, Dieter Dewachter">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    @include('header')

    <div class="main">
        <div class="welcome">
            <header>Welkom, upload je taken hier.</header>
        </div>
        
        <div class="upload">
        <input type="button" class="btn btn-outline-success" onclick="select('files')" value="Selecteer files om te uploaden"></button>
        </div>
    </div>

<!-- TRYING SOMETHING -->
<div class="HomePage container">
<?php
$result = DB::connection('mysql')->select("SELECT id, category, title, comment, timestamp FROM fileupload ORDER BY timestamp DESC");
for($i=0; $i < count($result); $i++) { 
  $id = $result[$i]->id;  ?>
  <div class="card text-center">
    <div class="card-header">
      <?= $result[$i]->category ?>
    </div>
    <div class="card-body">
      <h5 class="card-title">
        <?= $result[$i]->title ?>
      </h5>
      <p class="card-text">
        <?= $result[$i]->comment ?>
      </p>
      <p>
        <img src="{{ asset('upload/5ea04a9f4308f8.46219301.jpg') }}" class="card-text"/>
      </p>
      <a href="#" class="btn btn-primary">Help this kid</a>
    </div>
    <div class="card-footer text-muted">
      <?php
        $difference = time() - strtotime($result[$i]->timestamp);
        $days_left = abs(round($difference / 86400)); // 86400 = seconds per day
        echo "$days_left day(s) ago";
      ?>
    </div>
  </div>
<?php
}
?>

<!-- <div class="HomePage container">
  <div class="card text-center">
    <div class="card-header">
      Wiskunde
    </div>
    <div class="card-body">
      <h5 class="card-title">Can you please help me solve this thing</h5>
      <img src="public\upload\5ea04a9f4308f8.46219301.jpg" class="card-text"/>
      <a href="#" class="btn btn-primary">Help this kid</a>
    </div>
    <div class="card-footer text-muted">
      1 day ago
    </div>
  </div>
  <div class="card text-center">
    <div class="card-header">
      Taal
    </div>
    <div class="card-body">
      <h5 class="card-title">Can you please help me solve this thing</h5>
      <img src="public\upload\5ea04a9f4308f8.46219301.jpg" class="card-text"/>
      <a href="#" class="btn btn-primary">Help this kid</a>
    </div>
    <div class="card-footer text-muted">
      1 day ago
    </div>
  </div>

  <div class="card text-center">
    <div class="card-header">
      Geschiedenis
    </div>
    <div class="card-body">
      <h5 class="card-title">Can you please help me solve this thing</h5>
      <img src="public\upload\5ea04a9f4308f8.46219301.jpg" class="card-text"/>
      <a href="#" class="btn btn-primary">Help this kid</a>
    </div>
    <div class="card-footer text-muted">
      1 day ago
    </div>
  </div> -->
</div>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
