<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'sistemas_esbuenisimo_blog');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'sistemas_ebroot');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'DyCEnA4RpXdZS01W');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'f|<vW}k*.Z>wYJa,:7I$]zB^;tC-L(o>p2kswn1/jr{Vk/Y;L}@.nV-8AJj[jbs|');
define('SECURE_AUTH_KEY', 'x7xCjBiw#V$QtW@K?r;-h2@fwf[Zz1E#V[qiQ;`8;EFW<ZnAuZpgl8%BKorG)lNU');
define('LOGGED_IN_KEY', '.@ N*lHb}sd:vXi):&=wcX+WXK1I<pH;B#MOYUSCNmH{<!IwFgt6c8&4C6G y_H7');
define('NONCE_KEY', 'c1-^to33j8z6vml8_b1(CFnvM[|HWBZ%A<o_eWwfm8 f|Ek}pc+6:mH?lU/| ^#y');
define('AUTH_SALT', 'b(]xP@{hbBvdbBI3$t9~MN#h?vG_Z#lff3]6 My0WhvhgwV:I`5>X7dRvfW{n&Px');
define('SECURE_AUTH_SALT', '`$ W;Q,@cku18wP:-TlqgZ!Ogj.<Q-~]k]s6~2:S[#@`D%5/Hk)dTAx2=k_wBR*H');
define('LOGGED_IN_SALT', ',L<>}K4%Oy-yKK7WNr*<7@n-1VWVx8$zt0mP,F%`y4T_jM;*tKe@#U/bHgrywy=^');
define('NONCE_SALT', '#qJVP>p6g@W+k_S:fGtB6s? R*o#dFZMF >`Cl}b@z)RRd:0_Ggv=91n;(%i-%T~');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

