<?php

namespace Tests;

use DOMDocument;

trait AutomatedTestTrait
{
    private $bulkUrls = [];

    private function checkAllLinks($html)
    {
        $links = $this->getLinksFromHtml($html);
        //dd($links);

        foreach ($links as $url) {
            $req = $this->get($url);
            //if ($this->loggedIn && '/logout' === $url) {
            if (str_contains($url, [
                'logout',
                'export',
                'spss',
                'remove',
                'delete',
                'approve',
                'duplicate',
                'undraft',
            ])) {
                //$this->assertEquals(302, $req->baseResponse->status(), $url);
                continue;
            }
            if (302 === $req->getStatusCode()) {
                dump($url);
                dd($req->getContent());
            }
            if (301 === $req->getStatusCode()) {
                dump($url);
                dd($req->getContent());
            }
            if($req->baseResponse->status() !== 200){
                dd($req->baseResponse->content());
            }
            $this->assertEquals(200, $req->baseResponse->status(), $url);
            $this->checkAllLinks($req->baseResponse->content());
        }
        //$this->bulkUrls = [];
    }

    public function getLinksFromHtml($html)
    {
        $dom = new DOMDocument();

        @$dom->loadHTML($html);

        $urls = [];
        $links = $dom->getElementsByTagName('a');
        foreach ($links as $link) {
            $url = $link->getAttribute('href');
            if (starts_with($url, [config('app.url'), '/'])) {
                $url = str_replace(config('app.url'), '', $url);
                if (!in_array($url, $this->bulkUrls, true)) {
                    $this->bulkUrls[] = $url;
                    $urls[] = $url;
                }
            }
        }

        return $urls;
    }
}
