<main>
<article class="post">
<inner-column>
   <div class="blog-title"><?= $frontMatter["title"] ?></div>

   <?php if(!empty($frontMatter["subtitle"])): ?>
   <p class="blog-subtitle"><?= $frontMatter["subtitle"] ?></p>
   <?php endif; ?>

   <?php if(file_exists(__DIR__ . "/../../public/assets/articles/screenshots/" . $frontMatter["slug"] . ".png")): ?>

      <?php if(!empty($frontMatter["site"])): ?>
         <a href="<?= $frontMatter["site"]?>" target="_blank">
      <?php elseif(!empty($frontMatter["code"])): ?>
         <a href="<?= $frontMatter["code"]?>" target="_blank">
      <?php endif; ?>
         <picture>
            <img
               src="<?= BASE_URL . "assets/articles/screenshots/" . $frontMatter["slug"] ?>.png"
               alt="A screenshot of the interface of <?= $frontMatter["title"] ?>"
            >
         </picture>
      <?php if(!empty($frontMatter["site"]) || !empty($frontMatter["code"])): ?>
      </a>
      <?php endif; ?>
   

   <?php endif; ?>

   <?= $result ?>
   
</inner-column>
</article>
</main>



