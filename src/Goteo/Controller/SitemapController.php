<?php
/*
 * This file is part of the Goteo Package.
 *
 * (c) Platoniq y Fundación Goteo <fundacion@goteo.org>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */

namespace Goteo\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SitemapController extends \Goteo\Core\Controller {

    public function __construct() {
        // Cache & replica read activated in this controller
        \Goteo\Core\DB::cache(true);
        \Goteo\Core\DB::replica(true);
    }
  
    protected function _getHeader() {
        return '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd http://www.google.com/schemas/sitemap-image/1.1 http://www.google.com/schemas/sitemap-image/1.1/sitemap-image.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
    }
  
    protected function _getFooter() {
       return '</urlset>';
    }

    public function indexAction (Request $request) {
      
      $sitemap = '';
      $sitemap .= $this->_getHeader();
      
      $url = $request->getSchemeAndHttpHost();
            
      //Get static urls
      //Home
      $sitemap .= sprintf("<url><loc>%s</loc><lastmod>%s</lastmod></url>", $url, date('c', time()));
      //Ranking
      $sitemap .= sprintf("<url><loc>%s</loc><lastmod>%s</lastmod></url>", $url . '/ranking', date('c', time()));
      //Signup
      $sitemap .= sprintf("<url><loc>%s</loc><lastmod>%s</lastmod></url>", $url . '/signup', date('c', time()));
      //Login
      $sitemap .= sprintf("<url><loc>%s</loc><lastmod>%s</lastmod></url>", $url . '/login', date('c', time()));      
      //Project create
      $sitemap .= sprintf("<url><loc>%s</loc><lastmod>%s</lastmod></url>", $url . '/project/create', date('c', time()));        
      //Blog
      $sitemap .= sprintf("<url><loc>%s</loc><lastmod>%s</lastmod></url>", $url . '/blog', date('c', time()));         
      //Contact
      $sitemap .= sprintf("<url><loc>%s</loc><lastmod>%s</lastmod></url>", $url . '/contact', date('c', time()));        
      
      $sitemap .= $this->_getFooter();

      return $this->rawResponse($sitemap, 'text/xml');
    }
}