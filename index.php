<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'vendor/autoload.php';  // Include Composer's autoloader
require 'commonmark.php'; // Commonmark functions
require 'functions.php';

// Define the base URL
define('BASE_URL', '/');

// get array of projects
$articles = getMarkdownFrontMatter();
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
      if ($request_uri === '/blog') {
         include 'views/blog.php';  // Show the projects list
      } else {
         // Handle individual project pages
         $slug = trim(str_replace('/blog/', '', $request_uri), '/');
         showArticle($slug, $config, $environment);
      }
      break;

   // Projects Page
   case (preg_match('/^\/projects(\/.*)?$/', $request_uri)):
      if ($request_uri === '/projects') {
         include 'views/projects.php';  // Show the projects list
      } else {
         // Handle individual project pages
         $slug = trim(str_replace('/projects/', '', $request_uri), '/');
         showArticle($slug, $config, $environment);
      }
      break;

   // 404 Not Found
   default:
      include '404.php';
      break;
}

include 'views/footer.php';

