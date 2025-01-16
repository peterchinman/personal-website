

<main>
   <section class="blog-listing article-padding">
      <inner-column>
      <h1 class="loud-voice section-title">Posts</h1>
      <p>Click #tags to filter.</p>
      <!-- TODO clear #tag buttion -->
      <!-- TODO  it would be nice to gather all the tags that are used in articles and display them at the top here -->
      <?php
         $style = "blog";
         include __DIR__ . "/../views/article-list.php";
      ?>
      </inner-column>
   </section>
</main>
