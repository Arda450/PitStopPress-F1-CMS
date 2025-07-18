<?php
if (isset($_GET['success'])) {
    $success = $_GET['success'];
}
?>

<?php include_once('../app/views/partials/head.php'); ?>
<title>Articles</title>
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.css">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.pages.css">
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/nav.dashboard.css">


</head>
<body>
    <div class="dashboard-container">
        <?php require_once('../app/views/partials/nav.dashboard.php'); ?>
        <div class="content">
            <header class="db-page-header">
                <h1 class="db-h1">Articles</h1>
                <a href="<?= ROOT ?>/dashboard/addArticleForm" class="btn btn-create">Create New Article</a>
            </header>
            <section>


            <?php include_once('../app/helpers/Messages.php'); ?>


                <!-- Überprüfe, ob Artikel vorhanden sind -->
                <?php if (!empty($articles)): ?>
                    <?php foreach ($articles as $article): ?>

                <article class="article-item">

                    <div class="title-content">
                            <label for="article-title<?= $article['id'] ?>">Article Title:</label>
                            <input type="text" id="article-title<?= $article['id'] ?>" value="<?= htmlspecialchars($article['title']) ?>" readonly>

                            <label for="article-content<?= $article['id'] ?>">Article Text:</label>
                            <textarea id="article-content<?= $article['id'] ?>" readonly><?= htmlspecialchars($article['content']) ?></textarea>
                        </div>

                        <div class="article-img">
                            <?php if (!empty($article['src'])): ?>
                                <img src="<?= ROOT ?>/assets/images/homepage.images/<?= htmlspecialchars($article['src']) ?>" alt="<?= htmlspecialchars($article['alt_text']) ?>" class="article-image">
                            <?php endif; ?>
                                
                        </div>
                           
                            
                               
                    </article>
                    
                        <div class="edit-delete">
                            <a href="<?= ROOT ?>/dashboard/editArticleForm/<?= $article['id'] ?>" class="button btn-edit">Edit</a>
                            <a href="<?= ROOT ?>/dashboard/deleteArticle/<?= $article['id'] ?>" class="button btn-delete" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
                        </div>

                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No articles found.</p>
                <?php endif; ?>
            </section>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
