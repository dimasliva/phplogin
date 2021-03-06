<?php
session_start();
?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark px-4">
    <!-- Brand -->
    <a class="navbar-brand" href="/mvc/index.php">DmitryPHP</a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link home" href="../mvc/index.php">Home</a>
            </li>

            <!-- User don't logged -->
            <?php if (!isset($_SESSION['usersId'])) : ?>

                <li class="nav-item">
                    <a class="nav-link" href="/mvc/public/pages/signup.php">Sign up</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/mvc/public/pages/signin.php">Sign in</a>
                </li>

                <!-- User logged -->
            <?php else : ?>

                <li class="nav-item">
                    <a class="nav-link " href="/mvc/app/controllers/Users.php?q=logout">Logout</a>
                </li>

            <?php endif; ?>

        </ul>
    </div>
</nav>