<?php

namespace Interlink\Renderer;

use Interlink\LabelResolver\LabelResolverInterface;
use InvalidArgumentException;

class TemplateRenderer implements RendererInterface
{
    private $template;
    
    public function __construct($template)
    {
        $this->template = $template;
    }

    private $data = array();

    public function setData($key, $value)
    {
        $this->data[$key] = $value;
    }
    
    public function render($url, $label)
    {
        $data = $this->data;
        $data['url'] = $url;
        $data['label'] = $label;
        
        $html = $this->template;
        foreach ($data as $key => $value) {
            $html = str_replace("{{" . $key . "}}", $value, $html);
        }
        
        return $html;
    }

}
