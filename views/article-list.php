<ul class="article-list">
   <?php
   foreach ($articles as $article):
      if (validTags($article, $tags)): ?>
   <li>
      <?php include __DIR__ . "/article-card.php"; ?>
   </li>
      <?php endif; ?>
   <?php endforeach; ?>
</ul>
