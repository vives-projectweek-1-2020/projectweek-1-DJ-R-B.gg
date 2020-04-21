<?php
    // message for the user
    $status = false;
    $type = "alert-danger";

    if (isset($_POST["username"]))
    {
        // database connection
        $db = new mysqli("127.0.0.1", "root", "", "pieter");
        $username = $db->real_escape_string($_POST["username"]);

        if (isset($_POST["password"])) // login
        {
            $input = $db->real_escape_string($_POST["password"]);

            $result = $db->query("SELECT password FROM accounts WHERE username='$username'");
            if ($result->num_rows > 0)
            {
                $row = $result->fetch_assoc();
            
                if (password_verify($input, $row["password"]))
                {
                    $_SESSION["username"] = $username;
                    $status = "Successfully logged in as '$username'!";
                    $type = "alert-success";
                }
                else
                {
                    $status = "Invalid password!";
                }
            }
            else
            {
                $status = "Username not found";
            }
        }
        else if (isset($_POST["password1"]) && isset($_POST["password2"])) // register
        {
            if ($_POST["password1"] != $_POST["password2"])
            {
                $status = "Passwords don't match!";
            }
            else
            {
                $plain_password = $db->real_escape_string($_POST["password1"]);

                $password = password_hash($plain_password, PASSWORD_DEFAULT);
                $rank = 0;

                $db->query("INSERT INTO accounts (username, password, rank) VALUES ('$username', '$password', '$rank')");
                $status = "Successfully registered '$username'";
                $type = "alert-success";
            }
        }

        $db->close();
    }
?>
<style>
html {
    font-family: sans-serif;
    background-color: #fefefe;
}
body {
    height: 100%;
    position: fixed;
    width: 100%;
}
#logincontainer {
    height: 100%;
    width: 100%;
    position: fixed;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.2);
    display: none;
}
.popup {
    min-height: 800px;
    width: 80%;
    max-width: 700px;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}
.popup .title {
    background-color: rgb(34, 34, 34);
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    color: white;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.popup .actions {
    background-color: #eeeeee;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    display: flex;
    justify-content: flex-end;
    align-content: center;
    padding: 16px 24px;
}

button{
    margin: 10px 10px;
}

.close {
    cursor: pointer;
}
</style>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <?php if ($status) { ?>
        <div class="alert <?= $type ?>" id="status">
            <?php echo $status; ?>
        </div>
    <?php } ?>
    <div id="login">
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username1">Username</label>
                <input type="text" name="username" id="username1" placeholder="Your name" />
            </div>
            <div class="form-group">
                <label for="password3">Password</label>
                <input type="password" name="password" id="password3" placeholder="Password" />
            </div>
            
            <input type="submit" class="btn btn-outline-success" value="Login" />
        </form>
    </div>

    
    <button onclick="showPopup()" class="btn btn-outline-success">Register</button>
    <div id="logincontainer">
        <div class="popup">
            <div class="title">Register<i class="material-icons close" onclick="cancel()">X</i></div>
            <div id="register">
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username1">Username</label>
                <input type="text" name="username" id="username1" placeholder="Your name" />
            </div>
            <div class="form-group">
                <label for="password4">Password</label>
                <input type="password" name="password1" id="password4" placeholder="Password" />
            </div>
            <div class="form-group">
                <label for="password5">Repeat</label>
                <input type="password" name="password2" id="password5" placeholder="Password" />
            </div>
            
        </form>
    </div>
            <div class="actions">
                <input type="submit" class="btn btn-outline-success" value="Register" />
                <button class="btn btn-outline-success" onclick="cancel()">cancel</button>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script>
    function showPopup() {
        document.getElementById('logincontainer').style.display = 'block'
    }
    function cancel() {
        document.getElementById('logincontainer').style.display = 'none'
    }
    function change() {
        document.getElementsByTagName('body')[0].style.backgroundColor = 'rgb(56, 130, 119)'
        cancel()
    }
    </script>
  </body>
</html>