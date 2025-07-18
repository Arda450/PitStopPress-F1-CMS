<?php require('../app/views/partials/head.php') ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.pages.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/nav.dashboard.css">


<script src="<?= ROOT ?>/assets/js/add-blog.js" defer></script>
<title>Add Result</title>

</head>
<body>
  <div class="dashboard-container">
    <?php require_once('../app/views/partials/nav.dashboard.php'); ?>
    <div class="content">
        <header>
          <h1 class="heading-1">Add New Result</h1>
        </header>
        <section>

        <?php include_once('../app/helpers/Messages.php'); ?>


            <form class="db-form" action="<?= ROOT ?>/dashboard/addResult" method="POST" >

            

                <label for="race">Race:</label>
                <input class="race-input" type="text" id="race" name="race" >
               
                <label for="race_date">Race Date (dd.mm.yyyy):</label>
                <input type="text" class="race-input" id="race_date" name="race_date" pattern="\d{2}\.\d{2}\.\d{4}">
                
                <label for="winner">Winner:</label>
                <input class="race-input" type="text" id="winner" name="winner" >
                    
                <label for="team">Team:</label>
                <input class="race-input" type="text" id="team" name="team" >
                    
                <label for="race_time">Race Time:</label>
                <input class="race-input" type="text" id="race_time" name="race_time" >
                    
                <label for="laps">Laps:</label>
                <input class="race-input" id="laps" name="laps" >

           
                    
                <button type="submit" class="btn add-btn">Add Result</button>

            </form>
            
        </section>
    </div>
  </div>
    <footer>
    </footer>
</body>
</html>
