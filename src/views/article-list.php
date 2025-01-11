<?php

$tags == $tags ?? [];
$listBy = $listBy ?? "published";
$order = $order ?? "descending";
$style = $style ?? "project";

// Filter by Tags
if(count($tags) > 0) {
   $articles_front_matter = array_filter($articles_front_matter, function ($article) use ($tags) {
      $boolFlag = true;
      foreach ($tags ?? [] as $tag) {
         if (! in_array($tag, $article['tags'] ?? [])) {
            $boolFlag = false;
         }
      }    
      return $boolFlag;
   });
} 

usort($articles_front_matter, buildSorter($listBy, $order));

?>
<ul class="article-list">
   <?php foreach ($articles_front_matter as $article):?>
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
   <?php endforeach; ?>
</ul>
