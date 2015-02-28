<?php

namespace Interlink\LabelResolver;

class BugzillaLabelResolver implements LabelResolverInterface
{
    private $baseurl;
    private $guzzle;
    
    public function __construct($guzzle, $baseurl)
    {
        $this->guzzle = $guzzle;
        $this->baseurl = $baseurl;
    }
    
    public function resolve($reference)
    {
        $res = $this->guzzle->get($this->baseurl . 'rest/bug/'. $reference);
        $data = $res->json();
        if (isset($data['bugs'])) {
            $label = $data['bugs'][0]['summary'];
            return $label;
        }
        return null;
    }
}
