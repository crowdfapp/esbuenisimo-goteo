<ul>
    <?php
/*
 * This file is part of the Goteo Package.
 *
 * (c) Platoniq y Fundación Goteo <fundacion@goteo.org>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */ foreach ($this['options'] as $radio): ?>
    <li<?php if (isset($radio->class)) echo ' class="' . htmlspecialchars($radio->class) . '"' ?>><?php echo $radio->getInnerHTML() ?></li>
    <?php endforeach ?>
</ul>