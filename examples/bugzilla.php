#!/usr/bin/env php
<?php

use Interlink\Parser;
use Interlink\Handler;
use Interlink\Renderer\HyperlinkRenderer;
use Interlink\LabelResolver\BugzillaLabelResolver;
use GuzzleHttp\Client as GuzzleClient;

require_once(__DIR__ . '/../vendor/autoload.php');

$parser = new Parser();

// Register the 'mozilla-bugzilla' handler, with advanced LabelResolver
$guzzle = new GuzzleClient();
$resolver = new BugzillaLabelResolver($guzzle, 'https://bugzilla.mozilla.org/');
$renderer = new HyperlinkRenderer();
$handler = new Handler("https://bugzilla.mozilla.org/show_bug.cgi?id={{reference}}", $renderer, $resolver);
$parser->registerHandler("mozilla-bugzilla", $handler);

$text = file_get_contents(__DIR__ . '/bugzilla.md');
echo $parser->parse($text);
