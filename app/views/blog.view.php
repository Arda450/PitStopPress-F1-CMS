<?php
require('partials/head.php')

?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/blog.css" />
    <title>Blogs</title>
  </head>
  <body>
  <?php
      require('partials/header.php')
      ?>
    <main>
      <div class="max-width">
        <h1 class="heading-1">Formula 1 Blogs</h1>
        <div class="blog-container">

          <?php if (isset($blogs) && !empty($blogs)): ?>
            <?php foreach ($blogs as $blog): ?>

              <div class="blog">
                <div class="img-title">

                    <picture>
                        <source srcset="<?=ROOT?>/assets/images/blog.images/<?= htmlspecialchars($blog['src']) ?>"
                        alt="<?= isset($blog['alt_text']) ? htmlspecialchars($blog['alt_text']) : 'default alt text' ?>"
                        />
                        <img 
                          class="blog-img" 
                          src="<?=ROOT?>/assets/images/blog.images/<?= htmlspecialchars($blog['src']) ?>"
                          alt="<?= htmlspecialchars($blog['alt_text']) ?>"/>
                    </picture>

                    <h1 class="blog-title"><?= htmlspecialchars($blog['title']) ?></h1>

                </div>

                <div class="read-more-date">
                    <a href="#" class="read-more">Read More</a>
                    <span class="blog-date"> <?= date('d.m.Y', strtotime($blog['date'])) ?></span>
                </div>
    
                <p class="blog-content">
                  <?= nl2br(htmlspecialchars($blog['content'])) ?></p>
              </div>

            <?php endforeach; ?>
          <?php else: ?>
            <p>No Blogs found.</p>
          <?php endif; ?>
        </div>
      </div>
    </main>
    <?php
      require('partials/footer.php');
      ?>
  </body>
</html>
