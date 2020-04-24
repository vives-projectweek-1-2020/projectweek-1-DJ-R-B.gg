<?php
    session_start();
    // message for the user
    $status = false;
    $type = "alert-danger";
    
    if (isset($_POST["username"]))
    {
        // database connection
        //$db = new mysqli("127.0.0.1", "root", "", "pieter");
        $username = htmlspecialchars($_POST['username']);

        if (isset($_POST["password"])) // login
        {
            //$query = $db->prepare("SELECT password FROM accounts WHERE username = ?");
            //$query->bind_param("s", $_POST['username']);
            //$result = $query->execute();
            
            $result = DB::connection('mysql')->select("SELECT password FROM accounts WHERE username = ?", [ $_POST["username"] ]);

            if (count($result) > 0)
            {
                $row = $result[0];
            
                if (password_verify($_POST["password"], $row->password))
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
                $password = password_hash($_POST["password1"], PASSWORD_DEFAULT);
                $rank = 0;

                //$query = $db->prepare("INSERT INTO accounts (username, password, rank) VALUES (?, ?, ?)");
                //$query->bind_param("ssi", $_POST['username'], $password, $rank);
                //$query->execute();

                DB::connection('mysql')->insert("INSERT INTO accounts (username, password, rank) VALUES (?, ?, ?)", [ $_POST["username"], $password, $rank ]);

                $status = "Successfully registered '$username'";
                $type = "alert-success";
            }
        }

        // $db->close();
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    

    <link href="{{ asset('css/login.css') }}" type="text/css" rel="stylesheet" />
    <script src="{{ asset('js/app.js') }}"></script>
    <title>Login testing</title>
  </head>
  <body>
    <?php if ($status) { ?>
        <div class="alert <?= $type ?>" id="status">
            <?php echo $status; ?>
        </div>
    <?php } ?>
    <button onclick="showPopupLogin()" class="btn btn-outline-success">Login</button>
    <form id="logincontainer" method="POST" action="/login">
        @csrf
        <div class="popup">
            <div class="title">
                Login
                <input type="button" class="btn btn-danger" value="X" onclick="cancelLogin()"/>
            </div>
            <div id="login">
                <div class="form-group">
                    <label for="username1">Username</label>
                    <input type="text" name="username" id="username1" placeholder="Your name" minlength="3" required="true" />
                </div>
                <div class="form-group">
                    <label for="password3">Password</label>
                    <input type="password" name="password" id="password3" placeholder="Password" minlength="6" required="true" pattern="^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$" />
                </div>
            </div>
            <div class="actions">
                <input type="submit" class="btn btn-outline-success" value="Login" />
                <input type="button" class="btn btn-outline-danger" value="Cancel" onclick="cancelLogin()" />
            </div>
        </div>
    </form>

    
    <button onclick="showPopupRegister()" class="btn btn-outline-success">Register</button>
    <form id="registercontainer" method="POST" action="/login">
        @csrf
        <div class="popup">
            <div class="title">
                Register
                <input type="button" class="btn btn-danger" value="X" onclick="cancelRegister()"/>
            </div>
            <div id="register">
                <div class="form-group">
                    <label for="username2">Username</label>
                    <input type="text" name="username" id="username2" placeholder="Your name" minlength="3" required="true" />
                </div>
                <div class="form-group">
                    <label for="password4">Password</label>
                    <input type="password" name="password1" id="password4" placeholder="Password" minlength="6" required="true" pattern="^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$" />
                </div>
                <div class="form-group">
                    <label for="password5">Repeat</label>
                    <input type="password" name="password2" id="password5" placeholder="Password" minlength="6" required="true" pattern="^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$" />
                </div>
            </div>
            <div class="actions">
                <input type="submit" class="btn btn-outline-success" value="Register" />
                <input type="button" class="btn btn-outline-danger" value="Cancel" onclick="cancelRegister()" />
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>