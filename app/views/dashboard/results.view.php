<?php
if (isset($_GET['success'])) {
    $success = $_GET['success'];
}
?>

<?php include_once('../app/views/partials/head.php'); ?>
<title>Race Results</title>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.css">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.pages.css">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/nav.dashboard.css">

</head>
<body>
    <div class="dashboard-container">
        <?php require_once('../app/views/partials/nav.dashboard.php'); ?>
        <div class="content">
            <header class="db-page-header">
                <h1 class="db-h1">Race Results</h1>
                <a href="<?= ROOT ?>/dashboard/addResultForm" class="btn btn-create">Create New Result</a>
            </header>
            <section>

            <?php include_once('../app/helpers/Messages.php'); ?>

        <section id="race-results">
    
          <div class="race-results">
              <div class="results-header">
                <div class="result-column">Race</div>
                <div class="result-column">Date</div>
                <div class="result-column">Winner</div>
                <div class="result-column">Team</div>
                <div class="result-column">Time</div>
                <div class="result-column">Amount of Laps</div>
              </div>
              <?php if (!empty($results)): ?>
                <?php foreach ($results as $result): ?>
                <div class="results-row">
                  <div class="result-column"><?= htmlspecialchars($result['race']) ?></div>
                  <div class="result-column"><?= htmlspecialchars($result['race_date']) ?></div>
                  <div class="result-column"><?= htmlspecialchars($result['winner']) ?></div>
                  <div class="result-column"><?= htmlspecialchars($result['team']) ?></div>
                  <div class="result-column"><?= htmlspecialchars($result['race_time']) ?></div>
                  <div class="result-column"><?= htmlspecialchars($result['laps']) ?></div>
                </div>
            <div class="edit-delete">
                <a href="<?= ROOT ?>/dashboard/editResultForm/<?= $result['id'] ?>" class="button btn-edit">Edit</a>
                <a href="<?= ROOT ?>/dashboard/deleteResult/<?= $result['id'] ?>" class="button btn-delete" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
            </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p>No results found.</p>
              <?php endif; ?>
          </div>
        </section>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
