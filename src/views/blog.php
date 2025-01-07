

<main class="blog-page">
   <section class="projects-section">
      <inner-column>
      <h1 class="attention-voice section-title">Things I've Written About</h1>
      <?php
         $tags = [];
         renderArticleList($articles, $tags, "date", "descending", "blog");
      ?>
      </inner-column>
   </section>
</main>
