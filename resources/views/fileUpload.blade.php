<!DOCTYPE html>
<?php


    echo 'console.log("connected!")';
    if(isset($_POST['submit'])){
        echo 'console.log("connected!")';
        $file = $_FILES['file'];
        print_r($file);
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
                echo 'console.log("connected!")';
                if($fileSize < 500000){
                    echo 'console.log("connected!")';
                    $fileNameNew = uniqid('', true).".".$fileActualExt;
                    $fileDestination = public_path('upload/').$fileNameNew;
                    move_uploaded_file($fileTmpName, $fileDestination);
                    header("Location: index.php?uploadsuccess");
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
</form>
</body>
</html>
