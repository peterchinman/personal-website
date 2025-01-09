

<main>
   <section class="blog-listing">
      <inner-column>
      <h1 class="attention-voice section-title">Things I've Written About</h1>
      <?php
         $tags = [];
         $style = "blog";
         include __DIR__ . "/../views/article-list.php";
         // renderArticleList($articles_front_matter, $tags, "date", "descending", "blog");
      ?>
      </inner-column>
   </section>
</main>
