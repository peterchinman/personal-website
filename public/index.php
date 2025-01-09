<?php
require __DIR__ . '/../vendor/autoload.php';  // Include Composer's autoloader
require __DIR__ . '/../src/services/commonmark.php'; // Commonmark functions
require __DIR__ . '/../src/services/functions.php';

// Define the base URL
define('BASE_URL', '/');
define('CODE_URL', '/code');


// get array of projects
$articles = getMarkdownFrontMatter();


// Get the requested URI
$request_uri = $_SERVER['REQUEST_URI'];
$request_uri = parseRequestURI($request_uri);


switch (true) {
   // Code
   case ($request_uri['path'] === BASE_URL || $request_uri['path'] === '/index.php' || $request_uri['path'] === CODE_URL):
      $source = "code";
      include __DIR__ . '/../src/views/header.php';
      include __DIR__ . '/../src/views/code-home.php';
      break;

   case (preg_match('/^\/work(\/.*)?$/', $request_uri['path'])):
      include __DIR__ . '/../src/views/header.php';
      include __DIR__ . '/../src/views/work.php';
      break;
   
   case ($request_uri['path'] === '/bio'):
      include __DIR__ . '/../src/views/header.php';
      include __DIR__ . '/../src/views/bio.php';
      break;
      
   // Blog Page
   // Blog is cross-site, but gets passed a ?source=x query parameter, which tells: 1) the header which site nav to use, and 2) tells the blog what content to display.
   // TODO have this tag listed on the blog page, with a link to click "show all"
   case (preg_match('/^\/blog(\/.*)?$/', $request_uri['path'])):
      $source = $request_uri['query']['source'] ?? "blog";
      // TODO priority very low: should key be a single string, or possibly an array of keys? So that we can re-use this for all searches
      // TODO priority high: make this $key work for showing only posts tagged "code" in blog
      // issue of how to encode array into query parameters, internet suggests that: `?key[]=code&key[]=literature` would work
      $key = $request_uri['query']['key'] ?? '';

      include __DIR__ . '/../src/views/header.php';
      if ($request_uri['path'] === '/blog') {
         include __DIR__ . '/../src/views/blog.php';  // Show the projects list
      } else {
         // Handle individual project pages
         $slug = trim(str_replace('/blog/', '', $request_uri['path']), '/');
         showArticle($slug, $config, $environment);
      }
      break;

   // 404 Not Found
   default:
      include __DIR__ . '/../src/views/404.php';
      break;
}

include __DIR__ . '/../src/views/footer.php';

