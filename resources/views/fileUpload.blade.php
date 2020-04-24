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
    for ($i = 0; $i < count($_FILES["userfile"]["name"]); $i++)
    {
        if ($_FILES["userfile"]["error"][$i])
        {
            //fixen
            ?> <HTML> <div class="alert alert-danger"> </HTML>  <?php 
            echo $phpFileUploadErrors[$_FILES["userfile"]['error'][$i]];
            ?> <HTML></div></HTML>
            <?php
        }
        else
        {
            $userId = DB::connection('mysql')->select("SELECT id FROM accounts WHERE username = ?", [$_SESSION["username"]]);
            DB::connection('mysql')->insert("INSERT INTO issues (user_id, title, category, comment) VALUES (?, ?, ?, ?)",
                                            [ $userId[0]->id, $_POST["title"], $_POST["category"], $_POST["comment"] ]);
            $issueId = DB::connection('mysql')::table("issues")->insertGetId([ "user_id" => $userId[0]->id ]);
            $pathInfo = pathinfo($_FILES["userfile"]["name"][$i], PATHINFO_EXTENSION);
            $fileName= "Issue_" . $issueId . "_File_" . $i . "." . $pathInfo["extension"];
            $fileDestination = public_path('upload/') . $fileName;
            move_uploaded_file($_FILES['userfile']['tmp_name'][$i], $fileDestination);
        }
    }
}   


//     // Count total files
//     $countfiles = count($_FILES['file']['name']);
//     // if($countfiles != 0){
//     echo "<script>console.log('Will it work');</script>";
//     // Looping all files
//     $userId = DB::connection('mysql')->select("SELECT id FROM accounts WHERE username = ?", [$_SESSION["username"]]);;
//     DB::connection('mysql')->insert(
//         "INSERT INTO issues (user_id, title, category, comment) VALUES (?, ?, ?, ?)",
//         [$userId[0]->id, $_POST["title"], $_POST["category"], $_POST["comment"]]
//     );
//     for ($i = 0; $i < $countfiles; $i++) {
//         $fileName = $_FILES['file']['name'][$i];
//         $fileSize = $_FILES['file']['size'][$i];
//         $allowed = array('jpg', 'jpeg', 'png');
//         $fileError = $_FILES['file']['error'][$i];
//         $fileType = $_FILES['file']['type'][$i];
//         $fileExt = explode('.', $fileName);
//         $fileActualExt = strtolower(end($fileExt));
//         if (in_array($fileActualExt, $allowed)) {
//             if ($fileError === 0) {
//                 if ($fileSize < 500000) {
//                     $fileExt = explode('.', $fileName);
//                     $fileActualExt = strtolower(end($fileExt));
//                     $fileNameNew = uniqid('', true) . "." . $fileActualExt;
//                     $fileDestination = public_path('upload/') . $fileNameNew;
//                     move_uploaded_file($_FILES['file']['tmp_name'][$i], $fileDestination);
//                     $issueId = DB::connection('mysql')->select("SELECT id FROM issues WHERE user_id  = ? ORDER BY created_at DESC ", [$userId[0]->id]);
//                     DB::connection('mysql')->insert("INSERT INTO files (issue_id, name ) VALUES (?, ?)", [$issueId[0]->id, $fileNameNew]);
//                     header("Location: /");
//                     die();
//                 } else {
//                     echo "your file is to big";
//                 }
//             } else {
//                 echo "there was an error procesing your file";
//             }
//         } else {
//             echo "only images are allowed";
//         }
//     }
// }

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
        <form method="POST" enctype="multipart/form-data" action="">
            @csrf
            <input type="file" name="userfile[]" value="" multiple="" />
            <input type="submit" name="submit" value="Upload" />
        </form>
    </div>


    <!-- <input type ="file" name="file">
            <button type="submit" name="submit" value="submit">UPLOAD FILE</button>
            <input type="text" name="title" id="title2" placeholder="title" minlength="3" required="true" />
            <input type="text" name="comment" id="comment2" placeholder="comment" minlength="0" required="false" />
            <input type="text" name="category" id="category2" placeholder="category" minlength="0" required="true" /> -->

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>



<!-- <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload one or more files">
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button type="submit" name="submit" class="input-group-text">Upload</button>
                </div>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">title</label>
                <input type="text" name="title" required="true" class="form-control" id="formGroupExampleInput" placeholder="title">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">description</label>
                <textarea rows="5" cols="40" name="comment" type="text" class="form-control" id="formGroupExampleInput2" placeholder="description"></textarea>
            </div>
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">subject</label>
            <select name="category" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                <option selected>Choose...</option>
                <option value="wiskunde">wiskunde</option>
                <option value="taal">taal</option>
                <option value="geschiedenis">geschiedenis</option>
            </select> -->