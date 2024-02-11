<!--
Author: Toby Goetz, Leeroy Hegwood, Zalman Izak
Date: 2/9/2024
Description:
    Sign In Page that utilizes
    bootstrap, MVC and Fat-Free.
    Allows user to submit username and password to sign
    in to existing account or links to sign Up page where
    user may make an account.
-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In</title>
    <link rel="icon" type="image/x-icon" href="images/lotus-icon.svg">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/homeStyles.css">
</head>
<body>

<header>
    <nav class="navbar sticky-top navbar-expand-md p-3">
        <div class="container">
            <div class="navbar-brand">
                Spa On
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-nav"
                    aria-controls="navbar-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-row-reverse" id="navbar-nav">
                <div class="navbar-nav">
                    <a class="nav-link" href="home">
                        Home
                    </a>
                    <a class="nav-link" href="availability">
                        Availability
                    </a>

                    <a class="nav-link" href="">
                        Gallery
                    </a>
                    <a class="nav-link" href="">
                        Services
                    </a>
                    <a class="nav-link" href="signIn">
                        Sign In
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>

<main>

    <br><br><br>

    <div class="d-flex justify-content-center">

<form>


    <div class="card text-center border border-dark" style="width: 36rem">

        <h2>Sign In</h2>
        <h3>To continue to Spa-On</h3>

    <div class="form-group">
        <label for="inputEmail">Email address</label>
        <input type="email" class="form-control" id="inputEmail" aria-describedby="emailHelp" placeholder="Enter email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>
    <div class="form-group">
        <label for="inputPassword">Password</label>
        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
    </div>

        <br>
        <div class="text-center">
    <button type="submit" class="btn btn-primary text-center" style="width: 18rem">Log in</button>
        </div>
        <br>

    <h4>New User?</h4>
        <div class="text-center">
    <button type="button" class="btn btn-primary text-center" style="width: 18rem">Create Account</button>
        </div>
        <br>

    </div>


</form>

    </div>

    <br><br><br>

</main>

<footer class="p-3 text-center">
    <p>&copy; 2024</p>
</footer>

</body>
</html>