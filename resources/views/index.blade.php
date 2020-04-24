<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grademe</title>
    <meta name= "author" content="Brent Schaepdrijver, Dieter Dewachter">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
  @include('header')

  <!-- TRYING SOMETHING -->
  <div class="HomePage container">
  <?php
    $result = false;
    if (isset($_GET["category"]))
    {
      $result = DB::connection('mysql')->select("SELECT * FROM issues WHERE category = ? ORDER BY created_at DESC", [ $_GET["category"] ]);
    }
    else if (isset($_GET["own"]))
    {
      $userId = DB::connection('mysql')->select("SELECT id FROM accounts WHERE username = ?", [ $_SESSION["username"] ]);
      $result = DB::connection('mysql')->select("SELECT * FROM issues WHERE user_id = ? ORDER BY created_at DESC", [ $userId[0]->id ]);
    }
    else
    {
      $result = DB::connection('mysql')->select("SELECT * FROM issues ORDER BY created_at DESC");
    }

    for ($i = 0; $i < count($result); $i++)
    { 
      $id = $result[$i]->id;
      $user_id = $result[$i]->user_id;
      $username = DB::connection('mysql')->select("SELECT username FROM accounts WHERE id = $user_id");
      $images = DB::connection('mysql')->select("SELECT name FROM files WHERE issue_id = ?", [$result[$i]->id]) ?>
      <div class="card text-center">
        <div class="card-header">
          <?= $username[0]->username?>
        </div>
        <div class="card-body">
          <h4 class="card-title">
            <?= $result[$i]->category ?>
          </h4>
          <h5 class="card-title">
            <?= $result[$i]->title ?>
          </h5>
          <p class="card-text">
            <?= $result[$i]->comment ?>
          </p>
          <p>
            <img src="{{ asset('upload/') }}/<?= $images[$i]->name ?>" class="card-text"/>
          </p>
          <?php if (isset($_SESSION["username"]) && $_SESSION["username"]) { ?>
            <a href="issue?id=<?= $result[$i]->id ?>" class="btn btn-primary">Help this kid</a>
          <?php } else { ?>
            <a tabindex="<?= $i ?>" class="btn btn-primary popover-dismiss" role="button" data-toggle="popover" data-trigger="focus" title="Please login" data-content="You have to login in order to view this issue">Help this kid</a>
          <?php } ?>
        </div>
        <div class="card-footer text-muted">
        <?php
          date_default_timezone_set("Europe/Brussels");
          $now = new DateTime("now");
          $difference = $now->diff(DateTime::createFromFormat("Y-m-d H:i:s", $result[$i]->created_at));
          if ($difference->d > 0)
          {
            echo $difference->format("%a day(s) ago");
          }
          else if ($difference->h > 0)
          {
            echo $difference->format("%h hour(s) ago");
          }
          else
          {
            echo "A moment ago";
          }
        ?>
        </div>
      </div>
<?php
  }
?>
</div>

</body>
</html>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
$('.popover-dismiss').popover({
  trigger: 'focus'
})
</script>
