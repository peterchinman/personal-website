<main>
   <section class="bio">
      <inner-column>
         <p class="loud-voice">Poet-turned-coder building tools for manipulating language.</p>
      </inner-column>
   </section>
   <section>
      <inner-column>
         <?php
            $tags = ["project", "featured"];
            displayArticleList($articles, $tags, "coolness");
         ?>
      </inner-column>
   </section>
</main>
