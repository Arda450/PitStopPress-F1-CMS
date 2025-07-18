<?php
if (isset($_GET['success'])) {
    $success = $_GET['success'];
}
?>

<?php include_once('../app/views/partials/head.php');?>
<title>Blogposts</title>
    <link rel="stylesheet" href="<?=ROOT?>/assets/css/pages/dashboard.css">
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/dashboard.pages.css" />
<link rel="stylesheet" href="<?= ROOT ?>/assets/css/pages/nav.dashboard.css">


</head>
<body>
    <div class="dashboard-container">
    <?php require_once('../app/views/partials/nav.dashboard.php');?>
        <div class="content">
            <header class="db-page-header">
                <h1 class="db-h1">Blogposts</h1>
                <a href="<?= ROOT ?>/dashboard/addBlogForm" class="btn btn-create">Create New Blog</a>
            </header>
            <section>

            <?php include_once('../app/helpers/Messages.php'); ?>


                <!-- Überprüfe, ob Artikel vorhanden sind -->
                <?php if (!empty($blogs)): ?>
                    <?php foreach ($blogs as $blog): ?>
                    <article class="article-item">
                        <div class="title-content">
                            <label for="blog-title<?= $blog['id'] ?>">Blog Title:</label>
                            <input type="text" id="blog-title<?= $blog['id'] ?>" value="<?= htmlspecialchars($blog['title']) ?>" readonly>

                            <label for="blog-content<?= $blog['id'] ?>">Blog Text:</label>
                            <textarea id="blog-content<?= $blog['id'] ?>" rows="4" readonly><?= htmlspecialchars($blog['content']) ?></textarea>

                            <p>Created on: <?= htmlspecialchars($blog['date']) ?></p>

                        </div>
                           
                        <div class="blog-img">
                            <?php if (!empty($blog['src'])): ?>
                                <img class="blog-image" src="<?= ROOT ?>/assets/images/blog.images/<?= htmlspecialchars($blog['src']) ?>" alt="<?= htmlspecialchars($blog['alt_text']) ?>" class="blog-image">
                            <?php endif; ?>
                        </div>
                           

                          

                    </article>
                        <div class="edit-delete">
                            <a href="<?= ROOT ?>/dashboard/editBlogForm/<?= $blog['id'] ?>" class="button btn-edit">Edit</a>
                            <a href="<?= ROOT ?>/dashboard/deleteBlog/<?= $blog['id'] ?>" class="button btn-delete" onclick="return confirm('Are you sure you want to delete this article?')">Delete</a>
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
