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
<?php if (!(isset($_SESSION["username"]) && $_SESSION["username"])) {
  http_response_code(403);
  die('Forbidden');
}
?>
@include('header')

<?php
    $result = DB::connection('mysql')->select("SELECT issues.*, categories.name FROM issues JOIN categories ON issues.category_id = categories.id WHERE issues.id = ? ", [ $_GET['id'] ]);
    $user_id = $result[0]->user_id;
    $username = DB::connection('mysql')->select("SELECT username FROM users WHERE id = $user_id");

    if (isset($_POST["comment"]))
    {
      $userId = DB::connection('mysql')->select("SELECT id FROM users WHERE username = ?", [ $_SESSION["username"] ]);
      DB::connection('mysql')->insert("INSERT INTO comments (issue_id, user_id, comment) VALUES (?, ?, ?)", [ $_GET['id'], $userId[0]->id, $_POST["comment"] ]);
    }
?>

<div class="container">
  <div class="card text-center">
     <div class="card-header">
       <?= $username[0]->username?>
     </div>
     <div class="card-body">
       <h4 class="card-title">
         <?= $result[0]->name ?>
       </h4>
       <h5 class="card-title">
         <?= $result[0]->title ?>
       </h5>
       <p class="card-text">
         <?= $result[0]->comment ?>
       </p>
       <p>
        <div id="carousel2" class="carousel slide" data-ride="carousel2">
          <div class="carousel-inner">
                <?php
                  $images = DB::connection('mysql')->select("SELECT name FROM files WHERE issue_id = ?", [ $_GET["id"] ]);
                  for ($i = 0; $i < count($images); $i++)
                  {
                ?>
                <?php
                  if($i == 0){
                ?>
                <div class="carousel-item active">
                    <img class="d-block  issue_img" src="{{ asset('upload/') }}/<?= $images[$i]->name ?>" alt="Nice image">
                  </div>
                <?php 
                  } else {
                ?>
                  <div class="carousel-item">
                      <img class="d-block issue_img" src="{{ asset('upload/') }}/<?= $images[$i]->name ?>" alt="Nice image">
                  </div>
                <?php }} ?>
            </div>
            <a class="carousel-control-prev" href="#carousel2" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel2" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
        </div>
       </p>
       <form method="POST" action="/issue?id=<?= $_GET['id'] ?>">
       @csrf
       <div class="container pb-cmnt-container">
         <div class="form-group">                   
           <textarea name="comment" class="form-control" rows="5" id="comment" placeholder="Plaats hier je comment"></textarea>
           <div class="share-button">
             <button class="btn btn-primary pull-right" type="submit" >Post</button>
           </div>
         </div>
       </div>
       </form>
      </div>
    </div>
    <?php 
      $comments = DB::connection('mysql')->select("SELECT * FROM comments WHERE issue_id = ? ORDER BY created_at DESC", [ $_GET["id"] ]);
      for($i = 0; $i < count($comments); $i++){
      $username = DB::connection('mysql')->select("SELECT username FROM users WHERE id=?", [$comments[$i]->user_id]);
    ?>
    <div class="card">
      <div class="card-header">
        <?php echo $username[0]->username; ?>
      </div>
      <div class="card-body">
        <blockquote class="blockquote mb-0">
          <p><?php echo $comments[$i]->comment ?></p>
          <footer class="blockquote-footer"><?php
          date_default_timezone_set("Europe/Brussels");
          $now = new DateTime("now");
          $difference = $now->diff(DateTime::createFromFormat("Y-m-d H:i:s", $comments[$i]->created_at));
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
        ?></footer>
        </blockquote>
      </div>
    </div>
      <?php } ?>
</div>
</body>
</html>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
