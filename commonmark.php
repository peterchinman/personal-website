<?php 

use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\FrontMatter\FrontMatterExtension;

use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkRenderer;
use League\CommonMark\Extension\TableOfContents\TableOfContentsExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;




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
     'smartpunct' => [
        'double_quote_opener' => '“',
        'double_quote_closer' => '”',
        'single_quote_opener' => '‘',
        'single_quote_closer' => '’',
    ],
     

   ];

   $environment = new Environment($config);
   $environment->addExtension(new CommonMarkCoreExtension());
   // add extensions
   $environment->addExtension(new FootnoteExtension());
   $environment->addExtension(new HeadingPermalinkExtension());
   $environment->addExtension(new TableOfContentsExtension());
   $environment->addExtension(new FrontMatterExtension());
   $environment->addExtension(new SmartPunctExtension());



