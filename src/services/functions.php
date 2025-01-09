<?php
use League\CommonMark\MarkdownConverter;
use League\CommonMark\Extension\FrontMatter\Output\RenderedContentWithFrontMatter;
use League\CommonMark\Extension\FrontMatter\Data\LibYamlFrontMatterParser;
use League\CommonMark\Extension\FrontMatter\Data\SymfonyYamlFrontMatterParser;
use League\CommonMark\Extension\FrontMatter\FrontMatterParser;


function parseRequestURI($request_uri) {
   // Use parse_url to break down the URI into components
   $parsed_url = parse_url($request_uri);

   // Get the path or default to '/'
   $path = $parsed_url['path'] ?? '/';

   // Get the query string and parse it into an associative array
   $query_params = [];
   if (isset($parsed_url['query'])) {
       parse_str($parsed_url['query'], $query_params);
   }

   // Return the path and query parameters
   return [
       'path' => $path,
       'query' => $query_params,
   ];
}

function validTags($article, $tags){
   $valid = True;
   foreach($tags as $tag){
      if (!in_array($tag, $article["tags"])){
         $valid = False;
      }
   }
   return $valid;
}
function buildSorter($key, $order){
   return function ($a, $b) use ($key, $order) {
      if ($a[$key] == $b[$key]) {
         return 0;
      }
      if ($order === "descending") {
         return ($a[$key] > $b[$key]) ? -1 : 1;
      }
      else {
         return ($a[$key] < $b[$key]) ? -1 : 1;
      } 
      
  };
   
}
// this has been moved from a function into just raw PHP
// function renderArticleList($articles_front_matter, $tags, $listBy = "date", $order = "descending", $style = "project"){
//    $articles_front_matter = array_filter($articles_front_matter, function ($article) use ($tags) {
//       $boolFlag = true;
//       foreach ($tags as $tag) {
//           if (! in_array($tag, $article['tags'])) {
//               $boolFlag = false;
//           }
//       }
//       return $boolFlag;
//    });
//    usort($articles_front_matter, buildSorter($listBy, $order));
//    include __DIR__ . "/../views/article-list.php";
// }
function getMarkdownFiles($folder = __DIR__ . '/../../public/assets/articles/'){
   // Ensure the folder exists
   if (!is_dir($folder)) {
      return [];
  }

  // Scan the folder for files
  $files = scandir($folder);

  // Filter only .md files
  $markdownFiles = array_filter($files, function ($file) use ($folder) {
      return is_file($folder . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'md';
  });
  // Return the list of .md files
  return array_values($markdownFiles);
}

// TODO: instead of running this live each time we need to serve, we should generate an array of front-matter as part of a deployment action. But for now, it's snappy and still works.
function getMarkdownFrontMatter(){

   $markdownFiles = getMarkdownFiles();

   // For `symfony/yaml`
   $frontMatterParser = new FrontMatterParser(new SymfonyYamlFrontMatterParser());
   
   $articles_front_matter = [];

   foreach ($markdownFiles as $file) {
      $path = __DIR__ .'/../../public/assets/articles/'. $file;
      $content = file_get_contents($path);
      $frontMatter = $frontMatterParser->parse($content)->getFrontMatter();
      $articles_front_matter[] = $frontMatter;
   }

   return $articles_front_matter;
}

// Converts the markdown in articles/$slug.md to HTML, and adds it the article-template
function showArticle($slug, $config, $environment) {

   $projectFile = __DIR__ . '/../../public/assets/articles/' . $slug . '.md';

    // Check if the requested project page exists
   if (file_exists($projectFile)) {

      // Parse the Markdown content
      $markdownContent = file_get_contents($projectFile);

      $converter = new MarkdownConverter($environment);

      $result = $converter->convert($markdownContent);
      // Grab the front matter:
      if ($result instanceof RenderedContentWithFrontMatter) {
         $frontMatter = $result->getFrontMatter();
      }


      // article-template.php wraps $htmlContent in an <article>, and runs javascript afterwards
      include __DIR__ . '/../views/article-template.php';
   } else {
      // If the project file doesn't exist, show a 404 page
      include __DIR__ . '/../views/404.php';
   }
}
