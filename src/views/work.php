

<main>
   <section class="projects-section">
      <inner-column>
      <h1 class="attention-voice section-title">All of My Projects</h1>
      <?php
         $tags = ["project"];
         include __DIR__ . "/../views/article-list.php";
         // renderArticleList($articles_front_matter, $tags, "date", "descending");
      ?>
      </inner-column>
   </section>
</main>
