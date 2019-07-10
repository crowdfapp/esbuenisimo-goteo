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

use Goteo\Model\Project;

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
  
    protected function _getProjectFilters($filter, $vars = []) {
        $filters = $ofilters = [
            'status' => [Project::STATUS_IN_CAMPAIGN, Project::STATUS_FUNDED, Project::STATUS_FULFILLED],
            'published_since' => (new \DateTime('-6 month'))->format('Y-m-d')
        ];

        $filters['order'] = 'project.status ASC, project.published DESC, project.name ASC';
        if($vars['q']) {
            $filters['global'] = $vars['q'];
            unset($filters['published_since']);
            $filters['status'] = [ Project::STATUS_IN_CAMPAIGN, Project::STATUS_FUNDED, Project::STATUS_FULFILLED, Project::STATUS_UNFUNDED ];
        }
        elseif($vars['category']) {
            $filters['category'] = $vars['category'];
            unset($filters['published_since']);
            $filters['status'] = [ Project::STATUS_IN_CAMPAIGN, Project::STATUS_FUNDED, Project::STATUS_FULFILLED, Project::STATUS_UNFUNDED ];
        }
        elseif($vars['location'] || ($vars['latitude'] && $vars['longitude'])) {
            // $filters['location'] = $vars['location'];
            unset($filters['published_since']);
            $filters['location'] = new ProjectLocation([ 'location' => $vars['location'], 'latitude' => $vars['latitude'], 'longitude' => $vars['longitude'], 'radius' => 300 ]);
            $filters['status'] = [ Project::STATUS_IN_CAMPAIGN, Project::STATUS_FUNDED, Project::STATUS_FULFILLED, Project::STATUS_UNFUNDED ];
            $filters['order'] = 'Distance ASC, project.status ASC, project.published DESC, project.name ASC';
        }
        elseif($filter === 'near') {
            // Nearby defined as 300Km distance
            // Any LocationInterface will do (UserLocation, ProjectLocation, ...)
            $filters['location'] = new ProjectLocation([ 'latitude' => $vars['latitude'], 'longitude' => $vars['longitude'], 'radius' => 300 ]);
            $filters['order'] = 'Distance ASC, project.status ASC, project.published DESC, project.name ASC';
        } elseif($filter === 'outdated') {
            $filters['type'] = 'outdated';
            $filters['status'] = Project::STATUS_IN_CAMPAIGN;
            $filters['order'] = 'project.days ASC, project.published DESC, project.name ASC';
        } elseif($filter === 'promoted') {
            $filters['type'] = 'promoted';
            $filters['status'] = Project::STATUS_IN_CAMPAIGN;
            $filters['order'] = 'promote.order ASC, project.published DESC, project.name ASC';
        } elseif($filter === 'popular') {
            $filters['type'] = 'popular';
            $filters['status'] = Project::STATUS_IN_CAMPAIGN;
            $filters['order'] = 'project.popularity DESC, project.published DESC, project.name ASC';
        } elseif($filter === 'succeeded') {
            $filters['type'] = 'succeeded';
            $filters['status'] = [Project::STATUS_FUNDED, Project::STATUS_FULFILLED];
            $filters['order'] = 'project.published DESC, project.name ASC';
            // $filters['published_since'] = (new \DateTime('-12 month'))->format('Y-m-d');
            unset($filters['published_since']);
        } elseif($filter === 'fulfilled') {
            $filters['status'] = [Project::STATUS_FULFILLED];
            $filters['order'] = 'project.published DESC, project.name ASC';
            // $filters['published_since'] = (new \DateTime('-24 month'))->format('Y-m-d');
            unset($filters['published_since']);
        } elseif($filter === 'archived') {
            $filters['status'] = [Project::STATUS_UNFUNDED];
            $filters['order'] = 'project.published DESC, project.name ASC';
            $filters['published_since'] = (new \DateTime('-24 month'))->format('Y-m-d');
        } elseif($filter === 'matchfunding') {
            $filters['type'] = 'matchfunding';
            // $filters['published_since'] = (new \DateTime('-24 month'))->format('Y-m-d');
            unset($filters['published_since']);
        } elseif($filter === 'recent') {
            $filters['type'] = 'recent'; 
        }

        if($vars['review']) {
            $filters['status'] = [ Project::STATUS_EDITING, Project::STATUS_REVIEWING, Project::STATUS_IN_CAMPAIGN, Project::STATUS_FUNDED, Project::STATUS_FULFILLED, Project::STATUS_UNFUNDED ];
            $filters['is_draft'] = true;
            // unset($filters['published_since']);
        }
        return $filters;
    }
  
    protected function _getProjects(Request $request) {
        $limit = 12;
        $q = $request->query->get('q');
        $location = $request->query->get('location');
        $latitude = $request->query->get('latitude');
        $longitude = $request->query->get('longitude');
        $category = $request->query->get('category');
        $vars = ['q' => $q, 'category' => $category, 'location' => $location, 'latitude' => $latitude, 'longitude' => $longitude];

        $filters = $this->_getProjectFilters($filter, $vars);

        $projects = Project::getList($filters, null, 0, $limit);
      
        return $projects;
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
      
      //Get dinamic urls for projects
      $projects = $this->_getProjects($request);
      
      foreach($projects as $project)
        $sitemap .= sprintf("<url><loc>%s</loc><lastmod>%s</lastmod></url>", $url . '/project/' . $project->id, date('c', time()));
      
      $sitemap .= $this->_getFooter();

      return $this->rawResponse($sitemap, 'text/xml');
    }
}