<?php

include __DIR__ . '/head.php';

?>

<body class="<?= $source ?>">
   <header>
      <div class="title">
         <inner-column>
            <div class="page-name"><a href="<?= BASE_URL ?>">Peter Chinman</a></div>
         </inner-column>
      </div>

      <nav>
         <inner-column>
            <?php if ($source === "code" || (($request_uri['query']['key'] ?? null) === "code")): ?>
            <ul class="site-nav">
               <li><a href="<?= BASE_URL ?>code/work">Work</a></li>
               <li><a href="<?= BASE_URL ?>blog?source=<?= $source ?? '' ?>">Blog</a></li>
               <li><a href="<?= BASE_URL ?>code/bio">Bio</a></li>
            </ul>
            <?php endif; ?>
         </inner-column>
      </nav>
   </header>

