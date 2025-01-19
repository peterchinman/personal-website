<project-card>
   <div class="title">
      <a href="/blog/<?= $article["slug"] ?>">
         <?= $article["title"] ?>
      </a>
   </div>
   <?php if(file_exists(__DIR__ . "/../../public/assets/articles/screenshots/" . $article["slug"] . ".png")): ?>
   <picture>
      <a href="/blog/<?= $article["slug"] ?>">
         <img src="<?= BASE_URL . "assets/articles/screenshots/" . $article["slug"] ?>.png" alt="A screenshot of the interface of <?= $article["title"] ?>">
      </a>
   </picture>
   <?php endif; ?>
   <?php if($article["subtitle"]): ?>
   <p class="description"><?= $article["subtitle"] ?></p>
   <?php endif; ?>
   <?php if(in_array("project", $article["tags"])): ?>
   <ul class="link-list">
      <li><a href="/blog/<?= $article["slug"] ?>" class="read-me">read me</a></li>
      <?php if (!empty($article["site"])): ?>
         <li><a href="<?= $article["site"] ?>" class="site" target="_blank">site</a></li>
      <?php endif; ?>
      <?php if (!empty($article["code"])): ?>
         <li><a href="<?= $article["code"] ?>" target="_blank">code</a></li>
      <?php endif; ?>
   </ul>
   <?php endif; ?>
</project-card>
