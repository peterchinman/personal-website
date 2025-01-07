<ul class="article-list">
   <?php
   foreach ($articles as $article):
      if (validTags($article, $tags)): ?>
   <li>
      <?php 
      if ($style == "project") {
         include __DIR__ . "/project-card.php"; 
      }
      if ($style == "blog") {
         include __DIR__ . "/blog-card.php";
      }
      ?>
   </li>
      <?php endif; ?>
   <?php endforeach; ?>
</ul>
