<?php
require __DIR__ . '/../vendor/autoload.php';  // Include Composer's autoloader
require __DIR__ . '/../src/services/commonmark.php'; // Commonmark functions
require __DIR__ . '/../src/services/functions.php';

// Define the base URL
define('BASE_URL', '/');

// get array of projects
$articles = getMarkdownFrontMatter();
include __DIR__ . '/../src/views/header.php';

// Get the requested URI
$request_uri = $_SERVER['REQUEST_URI'];


switch (true) {
   // Home Page
   case ($request_uri === BASE_URL || $request_uri === '/index.php'):
      include __DIR__ . '/../src/views/home.php';
      break;

   // Blog Page
      case (preg_match('/^\/blog(\/.*)?$/', $request_uri)):
         if ($request_uri === '/blog') {
            include __DIR__ . '/../src/views/blog.php';  // Show the projects list
         } else {
            // Handle individual project pages
            $slug = trim(str_replace('/blog/', '', $request_uri), '/');
            showArticle($slug, $config, $environment);
         }
         break;

   // Projects Page
   case (preg_match('/^\/projects(\/.*)?$/', $request_uri)):
      if ($request_uri === '/projects') {
         include __DIR__ . '/../src/views/projects.php';  // Show the projects list
      } else {
         // Handle individual project pages
         $slug = trim(str_replace('/projects/', '', $request_uri), '/');
         showArticle($slug, $config, $environment);
      }
      break;

   // 404 Not Found
   default:
      include __DIR__ . '/../src/views/404.php';
      break;
}

include __DIR__ . '/../src/views/footer.php';

