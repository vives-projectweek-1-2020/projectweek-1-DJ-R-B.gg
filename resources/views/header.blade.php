<?php
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
    else if (isset($_POST["logout"]))
    {
        $_SESSION["username"] = false;
        $status = "Successfully logged out";
        $type = "alert-success";
    }
?>

<?php if ($status) { ?>
    <div class="alert <?= $type ?>" id="status">
        <?= $status ?>
    </div>
<?php } ?>

<!-- CAROUSEL GEDEELTE -->
<div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#carousel" data-slide-to="0" class="active"></li>
        <li data-target="#carousel" data-slide-to="1"></li>
        <li data-target="#carousel" data-slide-to="2"></li>
    </ol>

    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="view">
                <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(68).jpg" alt="Nice image" Height="200px">
                <div class="mask rgba-black-light"></div>
            </div>
            <div class="carousel-caption">
                <h3 class="h3-responsive">Grademe</h3>
                <input type="button" class="btn btn-outline-success" value="Home"/>
                <?php if (isset($_SESSION["username"]) && $_SESSION["username"]) { ?>
                    <form method="POST" action="/" class="inline">
                        @csrf
                        <input type="hidden" name="logout" value="true" />
                        <input type="submit" value="Logout" class="btn btn-outline-danger" />
                    </form>
                <?php } else { ?>
                    <button onclick="showPopupLogin()" class="btn btn-outline-success">Login</button>
                    <button onclick="showPopupRegister()" class="btn btn-outline-success">Register</button>
                <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<!-- LOGIN GEDEELTE -->
<form id="logincontainer" method="POST" action="/">
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

<form id="registercontainer" method="POST" action="/">
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