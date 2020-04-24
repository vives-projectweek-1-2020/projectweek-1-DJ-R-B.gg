<?php session_start(); ?>
<!DOCTYPE html>
<?php

use Illuminate\Support\Facades\Route;

$phpFileUploadErrors = array(
    0 => 'There is no error, the file uploaded with succes',
    1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
    2 => 'The uploaded file exeeds the MAX_FILE_SIZE directive that was specified in the HTML form',
    3 => 'The uploaded file was only partially uploaded',
    4 => 'No file was uploaded',
    6 => 'Missing a temporary folder',
    7 => 'Failed to write file to disk',
    8 => 'A PHP extension stoppen the file upload',
);

if (isset($_FILES['userfile']))
{
    $userId = DB::connection('mysql')->select("SELECT id FROM users WHERE username = ?", [$_SESSION["username"]]);
    $issueId = DB::connection('mysql')->table("issues")->insertGetId([
        "user_id" => $userId[0]->id,
        "title" => $_POST["title"],
        "category_id" => $_POST["category"],
        "comment" => $_POST["comment"]
    ]);
    for ($i = 0; $i < count($_FILES["userfile"]["name"]); $i++)
    {
        if ($_FILES["userfile"]["error"][$i])
        {
            ?> <HTML>
            <div class="alert alert-danger">
            </HTML> <?= $phpFileUploadErrors[$_FILES["userfile"]['error'][$i]] ?> <HTML>
            </div>
            </HTML>
            <?php
        }
        else
        {
            $pathInfo = pathinfo($_FILES["userfile"]["name"][$i], PATHINFO_EXTENSION);
            $fileName = "Issue_" . $issueId . "_File_" . $i . "." . $pathInfo;
            $fileDestination = public_path('upload/') . $fileName;
            move_uploaded_file($_FILES['userfile']['tmp_name'][$i], $fileDestination);

            DB::connection('mysql')->insert("INSERT INTO files (issue_id, name) VALUES (?, ?)", [ $issueId, $fileName ]);
        }
    }
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Grademe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="{{ asset('css/fileUpload.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    @include('header')
    <div class="container">
        <form class="md-form" method="POST" enctype="multipart/form-data" action="">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Descriptive title">
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <select class="form-control" id="category" name="category">
                    <?php
                        $categories = DB::connection('mysql')->select("SELECT id, name FROM categories");
                        for ($i = 0; $i < count($categories); $i++)
                        {
                    ?>
                        <option value="<?= $categories[$i]->id ?>"><?= $categories[$i]->name ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea class="form-control" id="comment" name="comment" rows="3" placeholder="Long and detailed explanation of the issue"></textarea>
            </div>
            <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="userfile[]" value="" multiple>
                <label class="custom-file-label" for="customFile">Choose files</label>
            </div><br /><br />
            <input type="submit" name="submit" value="Upload" class="btn btn-outline-dark btn-block" />
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>