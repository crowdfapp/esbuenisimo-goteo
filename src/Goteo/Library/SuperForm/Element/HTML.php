<?php
/*
 * This file is part of the Goteo Package.
 *
 * (c) Platoniq y Fundación Goteo <fundacion@goteo.org>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */

namespace Goteo\Library\SuperForm\Element {
    
    class HTML extends \Goteo\Library\SuperForm\Element {
        
        public 
            $view = false,
            $html = '';
        
         public function getInnerHTML () {             
             return $this->html;
        }                
        
    }
    
}