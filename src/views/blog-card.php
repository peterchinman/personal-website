<blog-card>
   <div class="title">
      <a href="/blog/<?= $article["slug"] ?>?key=<?= $source ?? '' ?>">
         <?= $article["title"] ?><?php if(array_key_exists("subtitle", $article) && $article["subtitle"]) : ?>: <?= $article["subtitle"] ?>
         <?php endif; ?>
      </a>
   </div>
   <!-- <?php if(array_key_exists("subtitle", $article)): ?>
   <p class="description"><?= $article["subtitle"] ?></p>
   <?php endif; ?> -->
   <?php // checking if array_key_exists as overkill, we should only be pulling articles that have a published date
   if(array_key_exists("published", $article)): ?>
   <p class="date"><?= date('Y-m-d', $article["published"]) ?></p>
   <?php endif; ?>

   <?php if(array_key_exists("tags", $article)): ?>
      <ul class="tags mono">
         <?php foreach($article["tags"] ?? [] as $tag): ?>
            <li><a href="?tag=<?= $tag ?>">#<?= $tag ?></a></li>
         <?php endforeach; ?>
      </ul>

   
   
   <?php endif; ?>

   <!-- TODO calculate number of minutes to read -->
   
   
</blog-card>
