<?php
require('partials/head.php')
?>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/style.css" />
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/index.css" />
    <script type="module" src="<?=ROOT?>/assets/js/image.slider.js" defer></script>
    <title>Homepage</title>
  </head>
  <body>
    <div class="container">
      <?php
      require('partials/header.php')
      ?>
      <main>
        <div class="max-width">
          <div class="hero-section">

            <div class="image-slider">
              
                <img class="slider-img" src="" alt="" />

                  <div class="buttons-and-index-container">

                    <div class="buttons">
                      <button class="btn btn-back" type="button" aria-label="Back">
                        <i class="fa-solid fa-chevron-left"></i>
                      </button>

                      <button
                        class="btn btn-forward"
                        type="button"
                        aria-label="Forward">
                        <i class="fa-solid fa-chevron-right"></i>
                      </button>

                      <button
                        class="btn-play-pause"
                        type="button"
                        aria-label="Play-Pause-Button">
                        <i class="fa-solid fa-play" id="playpause-icon"></i>
                      </button>
                    </div>
              
                      <div class="index-container">
                        <span class="index"></span>
                        <span>/</span>
                        <span class="index-total"></span>
                      </div>

                  </div>

            </div>
<!-- image slider ends here -->
                <div class="main-heading">
                  <h1 id="main-heading"></h1>
                </div>

                <div id="hero-paragraph">
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic
                    dicta sint, ipsam sunt nobis deserunt dignissimos rem animi,
                    fugit voluptate ipsa. Alias aspernatur cum beatae laboriosam
                    sequi? Eius, et perferendis enim tempora
                  </p>
                  <a href="#" id="read-more">Read More</a>
                </div>
          </div>
          <!-- hero section ends here -->

          <?php if(isset($articles) && is_array($articles)): ?>

          <?php foreach ($articles as $index => $article): ?>

            <section class="news-article <?= $index % 2 == 0 ? 'article-even' : 'article-odd' ?>">
            <div>
              <picture>
                <source
                  class="article-image"
                   srcset="<?= ROOT ?>/assets/images/homepage.images/<?= $article['src'] ?>"
                  alt="<?= isset($article['alt_text']) ? htmlspecialchars($article['alt_text']) : 'default alt text' ?>"
                />
                <img
                  class="article-image"
                  src="<?= ROOT ?>/assets/images/homepage.images/<?= $article['src'] ?>"
                  alt="<?= isset($article['alt_text']) ? htmlspecialchars($article['alt_text']) : 'default alt text' ?>"
                  />
              </picture>
            </div>
            <div class="article-texts">
              <h2 class="article-heading">
              <?= isset($article['title']) ? htmlspecialchars($article['title']) : 'Default Title' ?>
              </h2>
              <p class="article-paragraph">
              <?= isset($article['content']) ? htmlspecialchars($article['content']) : 'Default content.' ?>
              </p>
              <a href="#" class="read-more">Read More</a>
            </div>
          </section>

          <!-- Repeat for other articles -->
        <?php endforeach; ?>
      <?php else: ?>
        <p>No articles found.</p>
      <?php endif; ?>
        </div>
      </main>
      <?php
      require('partials/footer.php')
      ?>
    </div>
  </body>
</html>
