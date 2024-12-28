<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'vendor/autoload.php';  // Include Composer's autoloader

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\MarkdownConverter;




// Define the base URL
define('BASE_URL', '/');

include 'views/header.php';

// Get the requested URI
$request_uri = $_SERVER['REQUEST_URI'];


switch (true) {
   // Home Page
   case ($request_uri === BASE_URL || $request_uri === '/index.php'):
      include 'views/home.php';
      break;

   // Blog Page
   case (preg_match('/^\/blog(\/.*)?$/', $request_uri)):
      include 'views/blog.php';
      break;

   // Projects Page
   case (preg_match('/^\/projects(\/.*)?$/', $request_uri)):
      if ($request_uri === '/projects') {
         include 'views/projects.php';  // Show the projects list
      } else {
         // Handle individual project pages
         $slug = trim(str_replace('/projects/', '', $request_uri), '/');
         showProjectPage($slug);
      }
      break;

   // 404 Not Found
   default:
      include '404.php';
      break;
}

include 'views/footer.php';

// Configures League\CommonMark, converts the markdown in $slug.md to HTML, and adds it the project-template
function showProjectPage($slug) {
   // Define your configuration, if needed
   // Extension defaults are shown below
   // If you're happy with the defaults, feel free to remove them from this array
   $config = [
      'footnote' => [
         'backref_class'      => 'footnote-backref',
         'backref_symbol'     => '↩',
         'container_add_hr'   => false,
         'container_class'    => 'footnotes',
         'ref_class'          => 'footnote-ref',
         'ref_id_prefix'      => 'fnref:',
         'footnote_class'     => 'footnote',
         'footnote_id_prefix' => 'fn:',
      ],
      'heading_permalink' => [
         'html_class' => 'heading-permalink',
         'id_prefix' => 'content',
         'apply_id_to_heading' => false,
         'heading_class' => '',
         'fragment_prefix' => 'content',
         'insert' => 'after',
         'min_heading_level' => 1,
         'max_heading_level' => 4,
         'title' => 'Permalink',
         'symbol' => HeadingPermalinkRenderer::DEFAULT_SYMBOL,
         'aria_hidden' => true,
      ],
      'table_of_contents' => [
         'html_class' => 'table-of-contents',
         'position' => 'top',
         'style' => 'bullet',
         'min_heading_level' => 1,
         'max_heading_level' => 6,
         'normalize' => 'relative',
         'placeholder' => null,
     ],

   ];
   // Configure the Environment with all the CommonMark parsers/renderers
   $environment = new Environment($config);
   $environment->addExtension(new CommonMarkCoreExtension());

   $environment->addExtension(new FootnoteExtension());
   $environment->addExtension(new HeadingPermalinkExtension());
   $environment->addExtension(new TableOfContentsExtension());

   $projectFile = __DIR__ . '/projects/' . $slug . '.md';

    // Check if the file exists
   if (file_exists($projectFile)) {
      // Parse the Markdown content
      $markdownContent = file_get_contents($projectFile);

      // Initialize the Markdown parser
      $converter = new MarkdownConverter($environment);

      // Convert the Markdown content to HTML
      $htmlContent = $converter->convert($markdownContent);

      // Project-template page wraps $htmlContent in an <article>
      include 'views/project-template.php';
   } else {
      // If the project file doesn't exist, show a 404 page
      include '404.php';
   }
}
