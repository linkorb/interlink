<?php

namespace Interlink;

use Interlink\Renderer\RendererInterface;
use Interlink\LabelResolver\LabelResolverInterface;

class Handler
{
    private $url;
    private $labelresolver;
    private $renderer;
    
    public function __construct($url, RendererInterface $renderer, LabelResolverInterface $labelresolver = null)
    {
        $this->url = $url;
        $this->renderer = $renderer;
        $this->labelresolver = $labelresolver;
    }
    
    public function getRenderer()
    {
        return $this->renderer;
    }

    public function getLabelResolver()
    {
        return $this->labelresolver;
    }
    
    public function getUrl()
    {
        return $this->url;
    }
    
    public function transformUrl($reference)
    {
        $url = str_replace('{{reference}}', $reference, $this->url);
        return $url;
    }
}
