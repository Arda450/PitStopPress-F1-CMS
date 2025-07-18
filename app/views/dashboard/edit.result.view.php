<?php require('../app/views/partials/head.php') ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.pages.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/nav.dashboard.css">

<title>Edit Result</title>


</head>
<body>
  <div class="dashboard-container">
    <?php require_once('../app/views/partials/nav.dashboard.php'); ?>
    <div class="content">
        <header>
          <h1 class="heading-1">Edit Result</h1>
        </header>
        <section>

        <?php include_once('../app/helpers/Messages.php'); ?>


            <form class="db-form" action="<?= ROOT ?>/dashboard/editResult" method="POST">
            <input type="hidden" name="result_id" value="<?= htmlspecialchars($result['id'] ?? '') ?>">

                <label for="race">Race:</label>
                <input type="text" id="race" name="race" value="<?= htmlspecialchars($result['race'] ?? '') ?>">
               
                <label for="race_date">Race Date:</label>
                <input type="text" id="race_date" name="race_date" value="<?= htmlspecialchars($result['race_date'] ?? '') ?>">
                
                <label for="winner">Winner:</label>
                <input type="text" id="winner" name="winner" value="<?= htmlspecialchars($result['winner'] ?? '') ?>">
                    
                <label for="team">Team:</label>
                <input type="text" id="team" name="team" value="<?= htmlspecialchars($result['team'] ?? '') ?>">
                    
                <label for="race_time">Race Time:</label>
                <input type="text" id="race_time" name="race_time" value="<?= htmlspecialchars($result['race_time'] ?? '') ?>">
                    
                <label for="laps">Laps:</label>
                <input type="number" id="laps" name="laps" value="<?= htmlspecialchars($result['laps'] ?? '') ?>">
                    
                <button type="submit" class="btn add-btn">Save Result</button>

            </form>
            
        </section>
    </div>
  </div>
    <footer>
    </footer>
</body>
</html>
