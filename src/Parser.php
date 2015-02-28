<?php

namespace Interlink;

use Interlink\Renderer\RendererInterface;
use Interlink\LabelResolver\LabelResolverInterface;

class Parser
{
    private $handlers = array();
    
    public function registerHandler($name, Handler $handler)
    {
        $this->handlers[$name] = $handler;
    }
    
    public function getHandlers()
    {
        return $this->handlers;
    }
    
    public function parseLink($link)
    {
        $part = explode('|', $link);
        $link = $part[0];
        $label = null;
        if (count($part)>1) {
            $label = $part[1];
        }

        $part = explode(':', $link);
        $handlername = $part[0];
        $reference = $part[1];
        
        $handler = $this->getHandlerByName($handlername);
        if (!$handler) {
            return $link;
        }
        
        $renderer = $handler->getRenderer();
        
        if (!$label) {
            $label = $reference;
            $labelresolver = $handler->getLabelResolver();
            if ($labelresolver) {
                $label = $labelresolver->resolve($reference);
            }
        }
        
        $url = $handler->transformUrl($reference);
        
        $html = $renderer->render($url, $label);

        return $html;
    }
    
    private function getHandlerByName($name)
    {
        if (isset($this->handlers[$name])) {
            return $this->handlers[$name];
        }
        return null;
    }
    
    public function parse($text)
    {
        preg_match_all('/\[\[(.+?)\]\]/u', $text, $matches);
        foreach ($matches[1] as $link) {
            $parsed = $this->parseLink($link);
            $text = str_replace('[[' . $link . ']]', $parsed, $text);
        }
        return $text;
    }
}
