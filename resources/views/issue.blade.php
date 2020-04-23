<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grademe</title>
    <meta name= "author" content="Brent Schaepdrijver">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/wiskunde.css') }}">
</head>
<body>     
@include('header')

<?php
    $result = DB::connection('mysql')->select("SELECT * FROM issues WHERE id = ? ", [ $_GET['id'] ]);
    $user_id = $result[0]->user_id;
    $username = DB::connection('mysql')->select("SELECT username FROM accounts WHERE id = $user_id");
?>

<div class="container">
    <div class="card text-center">
        <div class="card-header">
          <?= $username[0]->username?>
        </div>
        <div class="card-body">
          <h4 class="card-title">
            <?= $result[0]->category ?>
          </h4>
          <h5 class="card-title">
            <?= $result[0]->title ?>
          </h5>
          <p class="card-text">
            <?= $result[0]->comment ?>
          </p>
          <p>
            <?php
              $images = DB::connection('mysql')->select("SELECT name FROM files WHERE issue_id = ?", [ $_GET["id"] ]);
              for ($i = 0; $i < count($images); $i++)
              {
            ?>
              <img src="{{ asset('upload/') }}/<?= $images[$i]->name ?>" class="card-text"/>
            <?php } ?>
          </p>
          <div class="container pb-cmnt-container">
            <div class="form-group">                   
              <textarea class="form-control" rows="5" id="comment">Plaats je commentaar hier</textarea>
              <div class="share-button">
                <button class="btn btn-primary pull-right" type="button" >Share</button>
              </div>
            </div>
            <img src="..." class="img-fluid" alt="Responsive image">
          </div>
        </div>
    </div>
</div>
</body>
</html>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
