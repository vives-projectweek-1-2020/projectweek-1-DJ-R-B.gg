<?php session_start(); ?>
<!DOCTYPE html>
<?php
    if(isset($_POST['submit'])){

        // Count total files

        $countfiles = count($_FILES['file']['name']);

        // Looping all files
        $userId = DB::connection('mysql')->select("SELECT id FROM accounts WHERE username = ?", [ $_SESSION["username"] ]);;                  
        DB::connection('mysql')->insert("INSERT INTO issues (user_id, title, category, comment) VALUES (?, ?, ?, ?)",
        [ $userId[0]->id , $_POST["title"], $_POST["category"], $_POST["comment"]]);
        for($i=0;$i<$countfiles;$i++){
            $fileName = $_FILES['file']['name'][$i];
            $fileSize = $_FILES['file']['size'][$i];
            $allowed = array('jpg','jpeg','png');
            $fileError = $_FILES['file']['error'][$i];
            $fileType = $_FILES['file']['type'][$i];
            $fileExt = explode('.',$fileName);
            $fileActualExt = strtolower(end($fileExt));
            if(in_array($fileActualExt,$allowed ))
            {
                if($fileError === 0){
                    if($fileSize < 500000){
                        header("Location: index.php?uploadsuccess");
                        $fileExt = explode('.',$fileName);
                        $fileActualExt = strtolower(end($fileExt));
                        $fileNameNew = uniqid('', true).".".$fileActualExt; 
                        $fileDestination = public_path('upload/').$fileNameNew;
                        move_uploaded_file($_FILES['file']['tmp_name'][$i],$fileDestination);
                        $issueId = DB::connection('mysql')->select("SELECT id FROM issues WHERE user_id  = ? ORDER BY created_at DESC ", [$userId[0]->id]);
                        DB::connection('mysql')->insert("INSERT INTO files (issue_id, name ) VALUES (?, ?)", [ $issueId[0]->id, $fileNameNew]);
                    }else{
                        echo "your file is to big";
                    }
                }else{
                    echo "there was an error procesing your file";
                }
            }
            else
            {
                echo "only images are allowed";
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
        @csrf
        @include('header')
        <form id=uploadForm action="file_upload" method="POST" enctype="multipart/form-data">@csrf
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button name="submit" class="input-group-text">Upload</button>
                </div>
                <div class="custom-file">
                    <input type="file" name="file[]" class="custom-file-input" id="inputGroupFile01" multiple>
                    <label name="file" type="file" class="custom-file-label" for="inputGroupFile01">Choose file</label>
                </div>
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput">title</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="title">
            </div>
            <div class="form-group">
                <label for="formGroupExampleInput2">description</label>
                <textarea rows="5" cols="40" name="comment" type="text" class="form-control" id="formGroupExampleInput2" placeholder="description"></textarea>
            </div>
            <label class="my-1 mr-2" for="inlineFormCustomSelectPref">subject</label>
                <select  name="category" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
                    <option selected>Choose...</option>
                    <option value="1">wiskunde</option>
                    <option value="2">taal</option>
                    <option value="3">geschiedenis</option>
                </select>
        </form>


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