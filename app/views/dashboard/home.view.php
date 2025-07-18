  <?php
  include_once('../app/views/partials/head.php');
  include_once('../app/controllers/Auth.php');

$username = isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'User';
?>

    <title>Dashboard</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/dashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/nav.dashboard.css">

</head>
<body>
    <div class="dashboard-container">
    <?php
  require_once('../app/views/partials/nav.dashboard.php');
  ?>
        <div class="content">
            <header>
                <h1>Dashboard</h1>
                <p class="welcome">Welcome to the dashboard, <?= htmlspecialchars($username) ?></p>
                
            </header>
            <div class="welcome-div">
                <p class="welcome1">Welcome to the dashboard, <?= htmlspecialchars($username) ?></p>
            </div>
            <section id="home">

              <div class="placeholder-div">
                    <h2>Latest Article</h2>
                    <p>This is the latest article content.</p>
                    <img src="<?= ROOT ?>/assets/images/homepage.images/article-image.webp" alt="Article Image" class="item-image">
              </div>
              <div class="placeholder-div">
                    <h2>Latest Blog</h2>
                    <p>This is the latest blog content.</p>
                    <img src="<?= ROOT ?>/assets/images/homepage.images/blog-image.webp" alt="Blog Image" class="item-image">
                </div>
                <div class="placeholder-div">
                    <h2>Upcoming Race</h2>
                    <p>Round 13:</p>
                    <p>Hungarian GP</p>
                    <p>Date: 19 - 21 July</p>
                </div>
            </section>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
