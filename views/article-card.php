<article-card>
   <div class="title">
      <a href="/blog/<?= $article["slug"] ?>">
         <?= $article["title"] ?>
      </a>
   </div>
   <?php if(file_exists(__DIR__ . "/../articles/" . $article["slug"] . ".png")): ?>
   <picture>
      <a href="/blog/<?= $article["slug"] ?>">
         <img src="<?= BASE_URL . "articles/" . $article["slug"] ?>.png" alt="A screenshot of the interface of <?= $article["title"] ?>">
      </a>
   </picture>
   <?php endif; ?>
   <?php if($article["subtitle"]): ?>
   <p class="description"><?= $article["subtitle"] ?></p>
   <?php endif; ?>
   <?php if(in_array("project", $article["tags"])): ?>
   <ul class="link-list">
      <li><a href="/blog/<?= $article["slug"] ?>" class="read-me">read me</a></li>
      <li><a href="<?= $article["site"] ?>" class="site">site</a></li>
      <li><a href="<?= $article["code"] ?>">code</a></li>
   </ul>
   <?php endif; ?>
</article-card>
