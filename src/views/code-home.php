<main>
   <section class="bio">
      <inner-column>
         <p class="loud-voice">Poet-turned-coder building tools for manipulating language.</p>
      </inner-column>
   </section>
   <section class="projects-section">
      <inner-column>
         <h1 class="attention-voice section-title">Featured Projects</h1>
         <?php
            $tags = ["project", "featured"];
            $listBy = "coolness";
            include __DIR__ . "/article-list.php";
            // renderArticleList($articles_front_matter, $tags, "coolness");
         ?>
      </inner-column>
   </section>
</main>
