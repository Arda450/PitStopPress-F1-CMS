<nav class="sidebar">
        
    <a href="<?=ROOT?>/dashboard/home">Dashboard</a>
    <a href="<?=ROOT?>/dashboard/articles">Home Articles</a>
    <a href="<?=ROOT?>/dashboard/blog">Blogs</a>
    <a href="<?=ROOT?>/dashboard/results">Race Results</a>
    <a href="#">Settings</a>

               
            
    <form method="POST" action="<?=ROOT?>/logout" class="logout-btn">
        <button type="submit" class="sidebar-btn">Logout</button>
            </form>

</nav>

<nav class="mobile-nav">

        <label for="checkbox">
        <div class="burger-menu">
            <div class="burger-bar"></div>
            <div class="burger-bar"></div>
            <div class="burger-bar"></div>
        </div>
        </label>

            <input type="checkbox" id="checkbox"/>
        
            <div class="dropdown-wrapper">
                <div>
                    <div class="dropdown">
                        <div class="align">
                        <a href="<?=ROOT?>/dashboard/home">Dashboard</a>
                        <a href="<?=ROOT?>/dashboard/articles">Home Articles</a>
                        <a href="<?=ROOT?>/dashboard/blog">Blogs</a>
                        <a href="<?=ROOT?>/dashboard/results">Race Results</a>
                        <a href="#">Settings</a>
                        <form method="POST" action="<?=ROOT?>/logout" class="logout-btn">
                            <button type="submit" class="sidebar-btn">Logout</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
</nav>
