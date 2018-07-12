<?php
/*
 * This file is part of the Goteo Package.
 *
 * (c) Platoniq y Fundación Goteo <fundacion@goteo.org>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */

namespace Goteo\Console;

use Goteo\Core\Traits\StaticLoggerTrait;

/**
 * This is a transitional class to be used for legacy static classes
*/
abstract class AbstractCommandController {
    use StaticLoggerTrait;
}
