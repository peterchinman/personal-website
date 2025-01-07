<main>
   <section class="bio">
      <inner-column>
         <p class="loud-voice">Poet-turned-coder building tools for manipulating&nbsp;language.</p>
      </inner-column>
   </section>
   <section class="featured-projects">
      <inner-column>
         <h1 class="attention-voice section-title">Featured Projects</h1>
         <?php
            $tags = ["project", "featured"];
            displayArticleList($articles, $tags, "coolness");
         ?>
      </inner-column>
   </section>
</main>
