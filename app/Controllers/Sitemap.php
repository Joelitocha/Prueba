<?php namespace App\Controllers;

class Sitemap extends BaseController
{
    public function index()
    {
        $data = [
            'urls' => [
                ['loc' => base_url(), 'lastmod' => date('c'), 'priority' => '1.0'],
                ['loc' => base_url('/login'), 'priority' => '0.8'],
                ['loc' => base_url('/register'), 'priority' => '0.7']
            ]
        ];
        
        return $this->response->setXML(view('sitemap', $data));
    }
}