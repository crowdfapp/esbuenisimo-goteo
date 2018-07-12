<input id="<?php
/*
 * This file is part of the Goteo Package.
 *
 * (c) Platoniq y Fundación Goteo <fundacion@goteo.org>
 *
 * For the full copyright and license information, please view the README.md
 * and LICENSE files that was distributed with this source code.
 */

echo htmlspecialchars($this['id']) ?>" name="<?php echo htmlspecialchars($this['name']) ?>" type="password"<?php

if (isset($this['class'])) echo ' class="' . htmlspecialchars($this['class']) . '"';

if (isset($this['size'])) echo ' size="' . ((int) $this['size']) . '"';

if (isset($this['autocomplete'])) echo ' autocomplete="' . htmlspecialchars($this['autocomplete']) . '"';

if($this['data'] && is_array($this['data'])) {
    foreach($this['data'] as $key => $val) {
        echo ' data-' . $key . '="' . htmlspecialchars($val) . '"';
    }
}

?> value="<?php if (isset($this['value'])) echo htmlspecialchars($this['value']) ?>" />
