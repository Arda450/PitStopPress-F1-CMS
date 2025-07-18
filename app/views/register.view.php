<?php


$errors = [];
$inputs = [];

parse_str($_SERVER['QUERY_STRING'], $queryArray);

foreach ($queryArray as $key => $value) {
    if (strpos($key, 'Error') !== false) {
        $errors[$key] = htmlspecialchars($value);
    } else {
        $inputs[$key] = htmlspecialchars($value);
    }
}
?>

<?php require('partials/head.php');?>
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/style.css" />
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/login.register.css" />
  <title>Register</title>
</head>
<body>
    <div class="container">
        <?php require('partials/header.php'); ?>
        <main>
            <h1 class="heading-1">Create an Account</h1>
            <section class="login">
                <form class="form" method="POST" action="<?=ROOT?>/register/register">
                    <div class="labels">

                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Your Email Address" value="<?= isset($inputs['email']) ? htmlspecialchars($inputs['email']) : '' ?>" />
                        <?php if (!empty($errors['emailError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['emailError']) ?></span>
                        <?php endif; ?>

                        <label class="up-padding" for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Your Password"/>
                        <?php if (!empty($errors['passwordEmptyError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['passwordEmptyError']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($errors['passwordLongError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['passwordLongError']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($errors['passwordLowercaseError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['passwordLowercaseError']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($errors['passwordUppercaseError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['passwordUppercaseError']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($errors['passwordOnedigitError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['passwordOnedigitError']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($errors['passwordSpecialcharsError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['passwordSpecialcharsError']) ?></span>
                        <?php endif; ?>

                        <label class="up-padding" for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password"/>
                        <?php if (!empty($errors['passwordMismatchError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['passwordMismatchError']) ?></span>
                        <?php endif; ?>

                        <label class="up-padding" for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="Choose a Username" value="<?= isset($inputs['username']) ? htmlspecialchars($inputs['username']) : '' ?>" />
                        <?php if (!empty($errors['usernameEmptyError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['usernameEmptyError']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($errors['usernameLengthError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['usernameLengthError']) ?></span>
                        <?php endif; ?>
                        <?php if (!empty($errors['usernameSpaceError'])): ?>
                            <span class="error"><?= htmlspecialchars($errors['usernameSpaceError']) ?></span>
                        <?php endif; ?>
                    </div>

                    <button type="submit" aria-label="Register" class="login-register-btn">Register</button>
                </form>
            </section>
        </main>
        <?php require('partials/footer.php'); ?>
    </div>
</body>
</html>