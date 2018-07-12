<?php
/*
 * This file is part of the Goteo Package.
 *
 * (c) Platoniq y Fundación Goteo <fundacion@goteo.org>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */

namespace Goteo\Model\Location;

interface LocationInterface {
    public static function get($id);
    public function validate(&$errors = array());
    public function save(&$errors = array());
    public static function setProperty($user, $prop, $value, &$errors = array());
    public static function getProperty($id, $prop, &$errors = array());
}
