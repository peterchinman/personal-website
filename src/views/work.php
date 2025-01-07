

<main class="work-page">
   <section class="projects-section">
      <inner-column>
      <h1 class="attention-voice section-title">All of My Projects</h1>
      <?php
         $tags = ["project"];
         renderArticleList($articles, $tags, "date", "descending");
      ?>
      </inner-column>
   </section>
</main>
