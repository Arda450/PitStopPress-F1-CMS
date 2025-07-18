<?php require('../app/views/partials/head.php') ?>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.pages.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/nav.dashboard.css">
<script type="module" src="<?=ROOT?>/assets/js/drag.drop.js" defer></script>

<title>Add Blog</title>

</head>
<body>
  <div class="dashboard-container">
    <?php require_once('../app/views/partials/nav.dashboard.php'); ?>
    <div class="content">
        <header>
          <h1 class="heading-1">Add New Blog</h1>
        </header>
        <section>

        <?php include_once('../app/helpers/Messages.php'); ?>


            <form class="db-form" action="<?= ROOT ?>/dashboard/addBlog" method="POST" enctype="multipart/form-data">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title">
                
                <label for="image">Image:</label>
                <div class="drag-container" ondrop="handleDrop(event)" ondragover="handleDragOver(event)">
                        Drag & drop image here or click to upload<br>
                        <input type="file" id="myFile" name="myFile" accept="image/*" >
                        <img id="image-preview" src="" style="max-width: 100%; max-height: 200px; margin-top: 10px;">
                </div>
                
                <label for="alt_text">Alt Text:</label>
                 <input type="text" id="alt_text" name="alt_text">
                
                 <label for="content">Content:</label>
                 <textarea id="content" name="content"></textarea>

                 <label for="date">Date (dd.mm.yyyy):</label>
                 <input type="text" id="date" name="date" pattern="\d{2}\.\d{2}\.\d{4}">

                <button type="submit" class="btn add-btn">Add Blog</button>
            </form>
        </section>
    </div>
  </div>
    <footer>
    </footer>
</body>
</html>
