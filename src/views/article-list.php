<?php

$tags == $tags ?? [];
$listBy = $listBy ?? "date";
$order = $order ?? "descending";
$style = $style ?? "project";

$articles_front_matter = array_filter($articles_front_matter, function ($article) use ($tags) {
   $boolFlag = true;
   foreach ($tags as $tag) {
       if (! in_array($tag, $article['tags'])) {
           $boolFlag = false;
       }
   }
   return $boolFlag;
});
usort($articles_front_matter, buildSorter($listBy, $order));

?>
<ul class="article-list">
   <?php
   foreach ($articles_front_matter as $article):
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
