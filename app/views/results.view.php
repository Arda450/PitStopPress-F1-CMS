<?php
require('partials/head.php')
?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/result.css" />
    <title>Schedule and Results</title>
  </head>
  <body>
    <div class="container">
    <?php
      require('partials/header.php')
      ?>
      <main>
        <section id="race-results">
          <h1 class="heading-1">2024 Race Results</h1>
    
          <div class="race-results">
              <div class="results-header">
                <div class="result-column">Race</div>
                <div class="result-column date">Date</div>
                <div class="result-column winner">Winner</div>
                <div class="result-column">Team</div>
                <div class="result-column time">Time</div>
                <div class="result-column">Amount of Laps</div>
              </div>
              <?php if (!empty($results)): ?>
                <?php foreach ($results as $result): ?>
                <div class="results-row">
                  <div class="result-column"><?= htmlspecialchars($result['race']) ?></div>
                  <div class="result-column date"><?= htmlspecialchars($result['race_date']) ?></div>
                  <div class="result-column winner"><?= htmlspecialchars($result['winner']) ?></div>
                  <div class="result-column"><?= htmlspecialchars($result['team']) ?></div>
                  <div class="result-column time"><?= htmlspecialchars($result['race_time']) ?></div>
                  <div class="result-column"><?= htmlspecialchars($result['laps']) ?></div>
                </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p>No results found.</p>
              <?php endif; ?>
          </div>
        </section>
      </main>
      <?php
      require('partials/footer.php')
      ?>
    </div>
  </body>
</html>
