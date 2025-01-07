<main class="home">
   <section class="bio">
      <inner-column>
         <p class="loud-voice">Poet-turned-coder building tools for manipulating&nbsp;language.</p>
      </inner-column>
   </section>
   <section class="projects-section">
      <inner-column>
         <h1 class="attention-voice section-title">Featured Projects</h1>
         <?php
            $tags = ["project", "featured"];
            renderArticleList($articles, $tags, "coolness");
         ?>
      </inner-column>
   </section>
</main>
