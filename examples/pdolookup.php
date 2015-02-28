#!/usr/bin/env php
<?php

use Interlink\Parser;
use Interlink\Handler;
use Interlink\Renderer\HyperlinkRenderer;
use Interlink\LabelResolver\PdoLookupLabelResolver;
use PDO;

require_once(__DIR__ . '/../vendor/autoload.php');

$parser = new Parser();

// Creating a PDO connection
$pdo = new PDO('mysql:host=127.0.0.1;dbname=exampledb', 'username', 'password');

// Register the 'acme-faq' handler, with advanced LabelResolver
$renderer = new HyperlinkRenderer();

// This resolver will lookup the faq record where `id`=reference, and return the value in the `title` column
$resolver = new PdoLookupLabelResolver($pdo, 'faq', 'id', 'title');
$handler = new Handler("http://www.acme.web/faq/{{reference}}", $renderer, $resolver);
$parser->registerHandler("acme-faq", $handler);

// Register the 'acme-wiki' handler, with advanced LabelResolver
$renderer = new HyperlinkRenderer();
$resolver = new PdoLookupLabelResolver($pdo, 'wikipage', 'code', 'title');
$handler = new Handler("http://www.acme.web/wiki/{{reference}}", $renderer, $resolver);
$parser->registerHandler("acme-wiki", $handler);

$text = file_get_contents(__DIR__ . '/pdolookup.md');
echo $parser->parse($text);
