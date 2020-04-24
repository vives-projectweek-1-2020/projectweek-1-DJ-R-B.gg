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
            //$query = $db->prepare("SELECT password FROM users WHERE username = ?");
            //$query->bind_param("s", $_POST['username']);
            //$result = $query->execute();
            
            $result = DB::connection('mysql')->select("SELECT password FROM users WHERE username = ?", [ $_POST["username"] ]);

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

                //$query = $db->prepare("INSERT INTO users (username, password, rank) VALUES (?, ?, ?)");
                //$query->bind_param("ssi", $_POST['username'], $password, $rank);
                //$query->execute();

                DB::connection('mysql')->insert("INSERT INTO users (username, password, rank) VALUES (?, ?, ?)", [ $_POST["username"], $password, $rank ]);

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
    <div class="carousel-inner" role="listbox">
        <div class="carousel-item active">
            <div class="view">
                <img class="d-block w-100" src="https://mdbootstrap.com/img/Photos/Slides/img%20(68).jpg" alt="Nice image" Height="200px">
                <div class="mask rgba-black-light"></div>
            </div>
            <div class="carousel-caption">
                <h3 class="h3-responsive">Grademe</h3>
                <input type="button" class="btn btn btn-secondary" value="Home" onclick="window.location.href='/';" />
                <input type="button" class="btn btn btn-secondary" value="View own issues" onclick="window.location.href='/?own';" />
                <div class="dropdown inline">
                    <button class="btn btn-secondary dropdown-toggle" id="categoryDropDown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </button>
                    <div class="dropdown-menu" aria-labelledby="categoryDropDown">
                    <?php
                        $categories = DB::connection('mysql')->select("SELECT id, name FROM categories");
                        for ($i = 0; $i < count($categories); $i++)
                        {
                    ?>
                        <a class="dropdown-item" href="/?category=<?= $categories[$i]->id ?>"><?= $categories[$i]->name ?></a>
                    <?php
                        }
                    ?>
                    </div>
                </div>
                <?php if (isset($_SESSION["username"]) && $_SESSION["username"]) { ?>
                    <form method="POST" action="/file" class="inline">
                        @csrf
                        <input type="submit" value="Upload Files" class="btn btn-success" />
                    </form>
                    <form method="POST" action="/" class="inline">
                        @csrf
                        <input type="hidden" name="logout" value="true" />
                        <input type="submit" value="Logout" class="btn btn-danger" />

                        <p id="welcome">Welcome <?= $_SESSION["username"] ?></p>
                    </form>
                <?php } else { ?>
                    <button data-toggle="modal" data-target="#logincontainer" class="btn btn-primary">Login</button>
                    <button data-toggle="modal" data-target="#registercontainer" class="btn btn-primary">Register</button>
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
<form class="modal fade" id="logincontainer" tabindex="-1" role="dialog" aria-hidden="true" method="POST" action="/">
    @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="username1">Username</label>
                    <input type="text" name="username" id="username1" placeholder="Your name" minlength="3" required="true" />
                </div>
                <div class="form-group">
                    <label for="password3">Password</label>
                    <input type="password" name="password" id="password3" placeholder="Password" minlength="6" required="true" pattern="^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success" onclick="">Login</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</form>

<form class="modal fade" id="registercontainer" tabindex="-1" role="dialog" aria-hidden="true" method="POST" action="/">
    @csrf
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success" onclick="">Register</button>
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</form>