<?php
/**
 * Created by PhpStorm.
 * User: Smile
 * Date: 05.07.2019
 * Time: 0:21
 */


function test_scripts() {
    // Подключаем стили
    wp_enqueue_style('test-bootstrap', get_template_directory_uri() . '/' .
        'assets/bootstrap/css/bootstrap.min.css');
    //wp_enqueue_style('test-style', get_stylesheet_uri());// В Chrome не работает !!! см.решение ниже
    wp_enqueue_style('test-style', get_stylesheet_uri(), array(), filemtime( get_template_directory()));

//    wp_enqueue_style('test_style', get_template_directory_uri() . '/' . 'style.css');
//    echo 'TEST ---' . get_template_directory_uri() . '/' . 'style.css<br>';
//    echo 'TEST ------' . get_template_directory_uri();

    // Подключаем Last.ver - JQuery
    wp_deregister_script('jquery'); // Версия по умолч.
    wp_register_script('jquery', get_template_directory_uri() . '/' . 'jquery-3.3.1.slim.min.js', array(),
                        false, true);// Новая версия
    //wp_enqueue_script('jquery'); //Вешаем на хук новую версию, эту часть подгрузим в виде зависимости для popper.min.js

    // Подключаем скрипты
    wp_enqueue_script('test_popper', get_template_directory_uri() . '/' . 'assets/bootstrap/js/popper.min.js', array('jquery'),
                        false, true);
    wp_enqueue_script('test_boostrap_js', get_template_directory_uri() . '/' . 'assets/bootstrap/js/bootstrap.min.js', array('jquery'),
                        false, true);
}

add_action('wp_enqueue_scripts', 'test_scripts');

// Регистрирует поддержку новых возможностей темы в WordPress
// (поддержка миниатюр, форматов записей и т.д.).
function test_setup() {
    add_theme_support('post-thumbnails');
    add_image_size('my-thumb', 100, 100);
}

// Вызываем test_setup() во время события after_setup_theme
add_action( 'after_setup_theme', 'test_setup' );

// удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2 );
function my_navigation_template( $template, $class ){
    /*
    Вид базового шаблона:
    <nav class="navigation %1$s" role="navigation">
        <h2 class="screen-reader-text">%2$s</h2>
        <div class="nav-links">%3$s</div>
    </nav>
    */

    return '
    <!--Отсавляем только class="navigation"-->    
	<nav class="navigation" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

// выводим пагинацию
the_posts_pagination( array(
    'end_size' => 2,
) );


