<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="../styles/main.css" />
    <link rel="stylesheet" type="text/css" href="../styles/header.css" />
</head>

<body>
    <header>
        <div id="navbar-animmenu">
            <ul class="show-dropdown main-navbar">
                <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
                <li>
                    <a href="#"><b>Login Page</b></a>
                </li>
            </ul>
        </div>
    </header>
    <div class="container">
        <div class="container-left">
            <img src="../images/login.jpg" alt="Login Image">
        </div>
        <div class="container-right">
            <div class="login_title">
                Login
            </div>
            <div class="login-form">
                <div class="container_F">
                    <div class="screen">
                        <div class="screen__content">
                            <form action="../php/login.php" method="post" class="login">
                                <div class="login__field">
                                    <i class="login__icon fas fa-user"></i>
                                    <input name="username" type="text" class="login__input" placeholder="User name / Email">
                                </div>
                                <div class="login__field">
                                    <i class="login__icon fas fa-lock"></i>
                                    <input name="password" type="password" class="login__input" placeholder="Password">
                                </div>
                                <div class="checkbox-wrapper-13">
                                    <input name="remember" id="c1-13" type="checkbox">
                                    <label for="c1-13">Remember me?</label>
                                </div>
                                <button name="login" value="login" type="submit" class="button login__submit">
                                    <span class="button__text">Log In Now</span>
                                    <i class="button__icon fas fa-chevron-right"></i>
                                </button>	
                                <div class="forgot">
                                    <label>Forgot your password? <a href="#">Reset Password</a></label>
                                </div>			
                            </form>
                        </div>	
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
