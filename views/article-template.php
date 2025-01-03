<article class="project-content">
   <inner-column>
      <div class="blog-title"><?= $frontMatter["title"] ?></div>
      <p class="blog-subtitle"><?= $frontMatter["subtitle"] ?></p>
      <?php if(file_exists(__DIR__ . "/../articles/" . $frontMatter["slug"] . ".png")): ?>
      <picture>
         <img src="<?= BASE_URL . "articles/" . $frontMatter["slug"] ?>.png" alt="A screenshot of the interface of <?= $frontMatter["title"] ?>">
      </picture>
      <?php endif; ?>
      <?= $result ?>
   </inner-column>
</article>

<script src="<?= BASE_URL ?>javascript/article-functions.js"></script>
