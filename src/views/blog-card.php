<blog-card>
   <div class="title">
      <a href="/blog/<?= $article["slug"] ?>">
         <?= $article["title"] ?>
      </a>
   </div>
   <?php if(array_key_exists("subtitle", $article)): ?>
   <p class="description"><?= $article["subtitle"] ?></p>
   <?php endif; ?>
</blog-card>
