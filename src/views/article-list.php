<?php

$tags == $tags ?? [];
$listBy = $listBy ?? "date";
$order = $order ?? "descending";
$style = $style ?? "project";

$articles = array_filter($articles, function ($article) use ($tags) {
   $boolFlag = true;
   foreach ($tags as $tag) {
       if (! in_array($tag, $article['tags'])) {
           $boolFlag = false;
       }
   }
   return $boolFlag;
});
usort($articles, buildSorter($listBy, $order));

?>
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
