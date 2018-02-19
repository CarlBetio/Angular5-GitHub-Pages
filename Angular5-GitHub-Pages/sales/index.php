<!doctype html>
<html lang="en" class="fullscreen-bg">

    <head>
        <title>Sales Order Management System</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link rel="stylesheet" href="assets2/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets2/vendor/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets2/css/main.css">
        <link rel="stylesheet" href= "assets2/vendor/bootstrap/css/style2.css">
        <link rel="icon" type="image/png" sizes="96x96" href="assets/images/project_logo.png">
    </head>

    <body>
        <!-- WRAPPER -->
        <div id="wrapper">
            <div class="vertical-align-wrap">
                <div class="vertical-align-middle">
                    <div class="auth-box">
                        <div class="left">
                            <div class="content">
                                <div class="header">
                                    <div class="logo text-center"><img style="height:100px;width:100px;" src="assets2/img/boss.png" alt="BC Logo"></div>
                                    <p class="lead">Login to your account</p>
                                </div>
                                <form class="form-auth-small" action="actions/login.php" method="POST">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input class="form-control" name="username" placeholder="Username" type="text" required autofocus>
                                    </div> <br>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                        <input class="form-control" name="password" placeholder="Password" type="password" required>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                                    <div class="bottom">
                                        <span class="helper-text"><a href="registration_form.php">Register Now</a></span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="right">
                            <div class="overlay"></div>
                            <div class="content text">
                                <h1 class="heading"><strong>Sales Order Management System</strong></h1>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- END WRAPPER -->
    </body>

</html>
