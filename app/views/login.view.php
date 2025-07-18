<?php
require('partials/head.php');
?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/login.register.css" />
    <title>Login</title>
  </head>
  <body>
    <div class="container">
    <?php
      require('partials/header.php');
      ?>
      <main>
        <h1 class="heading-1">Admin Login</h1>
        <section class="login">

        <?php
            // Get errors and input values from URL
            $errors = [];
            $inputValues = [];
            if (isset($_SERVER['QUERY_STRING'])) {
                parse_str($_SERVER['QUERY_STRING'], $queryArray);
                foreach ($queryArray as $key => $value) {
                    if (strpos($key, 'Error') !== false || $key ==='login') {
                        $errors[$key] = $value;
                    } else {
                        $inputValues[$key] = $value;
                    }
                }
            }
            ?>

            <form class="form" method="POST" action="<?=ROOT?>/login/authenticate">
                <div class="labels">

                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Your Username"
                           value="<?= isset($inputValues['username']) ? htmlspecialchars($inputValues['username']) : '' ?>"/>
                    <?php if (!empty($errors['username'])): ?>

                        <span class="error"><?= htmlspecialchars($errors['username']) ?></span>
                    <?php endif; ?>

                    <label class="up-padding" for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Your Password"/>
                    
                    <?php if (!empty($errors['password'])): ?>
                        <span class="error"><?= htmlspecialchars($errors['password']) ?></span>
                    <?php endif; ?>
                </div>

                <?php if (isset($errors['login'])): ?>
                <span class="error"><?= htmlspecialchars($errors['login']) ?></span>
            <?php endif; ?>

                <a class="forgot" href="#">Forgot your Password?</a>
                <button type="submit" aria-label="Login" class="login-register-btn">Login</button>
            </form>

           

            <div class="login-texts">
                <a class="register-now" href="<?=ROOT?>/home/register">Create an account</a>
            </div>
        </section>
    </main>
    <?php require('partials/footer.php'); ?>
</div>
</body>
</html>