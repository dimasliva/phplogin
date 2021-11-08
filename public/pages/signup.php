<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<title>Signup</title>
</head>

<body>
	<?php
	if (!isset($_SESSION)) {
		include "../../app/helpers/session_helper.php";
	} else
		include_once "../include/navbar.php"
	?>

	<div class="container">
		<div class="row">
			<div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
				<div class="card border-0 shadow rounded-3 my-5">
					<div class="card-body p-4 p-sm-5">
						<h5 class="card-title text-center mb-5 fw-light fs-5">Sign Up</h5>
						<?php flash("register") ?>
						<form method="POST" action="../../app/controllers/Users.php" novalidate>
							<div class="form-floating mb-3">
								<input type="hidden" name="type" value="register">
								<input type="name" name="usersName" class="form-control" id="floatingusersName" placeholder="Password">
								<label for="floatingusersName">Full name</label>
							</div>
							<div class="form-floating mb-3">
								<input type="email" name="usersEmail" class="form-control" id="floatingInput" placeholder="name@example.com">
								<label for="floatingInput">Email address</label>
							</div>

							<div class="form-floating mb-3">
								<input type="name" name="usersUid" class="form-control" id="floatingPassword" placeholder="Password">
								<label for="floatingPassword">Username</label>
							</div>

							<div class="form-floating mb-3">
								<input type="password" name="usersPwd" class="form-control" id="floatingPassword" placeholder="Password">
								<label for="floatingPassword">Password</label>
							</div>
							<div class="form-floating mb-3">
								<input type="password" name="pwdRepeat" class="form-control" id="floatingPassword" placeholder="Password">
								<label for="floatingPassword">Repeat password</label>
							</div>

							<div class="form-check mb-3">
								<input class="form-check-input" type="checkbox" value="" id="rememberPasswordCheck">
								<label class="form-check-label" for="rememberPasswordCheck">
									Remember password
								</label>
							</div>
							<div class="d-grid">
								<button class="btn btn-primary btn-login text-uppercase fw-bold" type="submit" name="submit">Sign up</button>
							</div>
							<hr class="my-4">
							<div class="d-grid mb-2">
								<button class="btn btn-google btn-login text-uppercase fw-bold" type="submit">
									<i class="fab fa-google me-2"></i> Sign up with Google
								</button>
							</div>
							<div class="d-grid">
								<button class="btn btn-facebook btn-login text-uppercase fw-bold" type="submit">
									<i class="fab fa-facebook-f me-2"></i> Sign up with Facebook
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>