#!/usr/bin/env php
<?php

use Interlink\Parser;
use Interlink\Handler;
use Interlink\Renderer\HyperlinkRenderer;
use Interlink\Renderer\ImageRenderer;
use Interlink\Renderer\TemplateRenderer;
use Interlink\LabelResolver\UppercaseLabelResolver;

require_once(__DIR__ . '/../vendor/autoload.php');

$text = file_get_contents(__DIR__ . '/simple.md');


$parser = new Parser();

// Register the 'google' handler, a simple hyperlink
$renderer = new HyperlinkRenderer();
$handler = new Handler("http://www.google.com/?q={{reference}}", $renderer);
$parser->registerHandler("google", $handler);

// Register a custom template renderer example
$renderer = new TemplateRenderer('<a href="{{url}}" class="{{classname}}">{{label}}</a>');
$renderer->setData("classname", "example");
$handler = new Handler("http://www.bing.com/search?q={{reference}}", $renderer);
$parser->registerHandler("bing", $handler);

// Registering the 'wikipedia' handler, with example labelresolver
$renderer = new HyperlinkRenderer();
$resolver = new UppercaseLabelResolver(); // This will uppercase the reference
$handler = new Handler("http://www.wikipedia.com/?q={{reference}}", $renderer);
$parser->registerHandler("wikipedia", $handler, $resolver);

// Registering the 'snag.gy' image handler, adding an <img /> tag
$renderer = new ImageRenderer();
$handler = new Handler("http://i.snag.gy/{{reference}}.jpg", $renderer);
$parser->registerHandler("snag.gy", $handler);

echo $parser->parse($text);
