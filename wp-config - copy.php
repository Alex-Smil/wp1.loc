<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wp1' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Ru%cEEe-,NC@)kM3)W;mYn[75XTyI:KW;dvN4b;<opS};mK`Zk4my|gN=sF)gbmw' );
define( 'SECURE_AUTH_KEY',  '8B$I:.b;T|9q5bdsr6Ww^wq}nmdbyEGO9x76ktijpT>?Cx]*M1p#|KJj3Wu(&&Rt' );
define( 'LOGGED_IN_KEY',    'A3~Y`UB)3Zi~^]PsqjP4#?}O4=fZ6m.S5fbfovuXa/7 lC9b_fKj=kf6p1#:<L<@' );
define( 'NONCE_KEY',        '*$kAI7}?&!4c^Xi1)wKKG^6L4cpv^2ufXE1nlsThIX/k&AW0%VYdy]7n/Bncqg}4' );
define( 'AUTH_SALT',        '4{eeeR)Lz{:b1_rbZbTzKiCNzCw_nF|;mbhH5lId$o@Y]Vq(4E6!&@trs~iFM@_l' );
define( 'SECURE_AUTH_SALT', 'g.ai]76U+zkuj4[#*My`UfU`rk,o~x[=#,K`*fJ=V>_rO3Oe. Jv,j$F/[akQVQR' );
define( 'LOGGED_IN_SALT',   'GE|OI5y-:/}O(i/rOUH=^fSOyc~0k87c?K2Msg|%(E$Adds0PL2.~EGqs^ID=R-3' );
define( 'NONCE_SALT',       '6~]O$ CU0$${/U4GSQafMCRf&V`+kLEt0H4<w~_L`7REFh@UqA69Rx^}ZXlUS9]`' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
