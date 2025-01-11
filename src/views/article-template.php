<main>
<article class="project-content">
<inner-column>
   <div class="blog-title"><?= $frontMatter["title"] ?></div>

   <p class="blog-subtitle"><?= $frontMatter["subtitle"] ?></p>

   <?php if(file_exists(__DIR__ . "/../../public/assets/articles/screenshots/" . $frontMatter["slug"] . ".png")): ?>

   <a href="<?= $frontMatter["site"]?>">
      <picture>
         <img src="<?= BASE_URL . "assets/articles/screenshots/" . $frontMatter["slug"] ?>.png" alt="A screenshot of the interface of <?= $frontMatter["title"] ?>">
      </picture>
</a>
   

   <?php endif; ?>

   <?= $result ?>
   
</inner-column>
</article>
</main>

<script src="<?= BASE_URL ?>assets/javascript/article-functions.js"></script>
