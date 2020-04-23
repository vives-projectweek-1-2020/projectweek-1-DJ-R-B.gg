<?php session_start(); ?>
<!DOCTYPE html>
<?php
    if(isset($_POST['submit'])){
        $result = DB::connection('mysql')->select("SELECT password FROM accounts");
        print_r($result[0]);
        $file = $_FILES['file'];
        $fileName = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $fileSize = $_FILES['file']['size'];
        $fileError = $_FILES['file']['error'];
        $fileType = $_FILES['file']['type'];
        $fileExt = explode('.',$fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg','jpeg','png');
        if(in_array($fileActualExt,$allowed ))
        {
            if($fileError === 0){
                if($fileSize < 500000){
                    $fileNameNew = uniqid('', true).".".$fileActualExt; 
                    $fileDestination = public_path('upload/').$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: index.php?uploadsuccess");
                    $userId = DB::connection('mysql')->select("SELECT id FROM accounts WHERE username = ?", [ $_SESSION["username"] ]);
                    DB::connection('mysql')->insert("INSERT INTO issues (user_id, title, category) VALUES (?, ?, ?)", [ $userId[0]->id, isset($_POST["title"]), isset($_POST["category"])]);
                    $issueId = DB::connection('mysql')->select("SELECT id FROM accounts WHERE username = ?", [ $_SESSION["username"] ]);
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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Title of the document</title>
    </head>
<body>
@csrf
<form action="file_upload" method="POST" enctype="multipart/form-data">@csrf
<input type ="file" name="file">
<button type="submit" name="submit" value="submit">UPLOAD FILE</button>
<input type="text" name="title" id="title2" placeholder="title" minlength="3" required="true" />
<input type="text" name="category" id="category2" placeholder="category" minlength="3" required="true" />
</form>

</body>
</html>