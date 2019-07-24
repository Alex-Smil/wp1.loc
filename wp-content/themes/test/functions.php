<?php
/**
 * Created by PhpStorm.
 * User: Smile
 * Date: 05.07.2019
 * Time: 0:21
 */

require_once __DIR__ . '/Classes/Test_Menu.php';

/*Вспомогательная функц. для разраба, форматированный вывод ассоц. массива*/
function debug( $data ) {
    echo '<pre>' . print_r( $data, 1 ) . '</pre>';
}

function test_scripts() {
    /* Подключаем стили */
    wp_enqueue_style('test-bootstrap', get_template_directory_uri() . '/' .
        'assets/bootstrap/css/bootstrap.min.css');
    //wp_enqueue_style('test-style', get_stylesheet_uri());// В Chrome не работает !!! см.решение ниже
    wp_enqueue_style('test-style', get_stylesheet_uri(), array(), filemtime( get_template_directory()));

    /* Подключаем Last.ver - JQuery */
    wp_deregister_script('jquery'); // Отключ. старую версию jQuery - Версия по умолч.
    wp_register_script( // Регистрируем новую версию jquery
        'jquery', // наименование
        get_template_directory_uri() . '/assets/js/jquery-3.4.1.min.js',
        array(),
        false,
        true
    );

    /*
     * wp_enqueue_script('jquery');
     * Подключать новую версию jquery на прямую не обязательно,
     * библ. jquery можно подгрузить в виде зависимости для скрипта popper.min.js
     * */

    /* Подключаем bootstrap скрипты */
    wp_enqueue_script(
        'test_popper',
        get_template_directory_uri() . '/assets/bootstrap/js/popper.min.js',
        array('jquery'),
        false,
        true);

    wp_enqueue_script(
        'test_boostrap_js',
        get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js',
        array('jquery'),
        false,
        true
    );
}

/* Подключение скриптов и стилей вешаем на хук 'wp_enqueue_scripts' */
add_action('wp_enqueue_scripts', 'test_scripts');


/*
 * Регистрирует поддержку новых возможностей темы в WordPress
 * (поддержка миниатюр, форматов записей и т.д.).
 * */
function test_setup() {
    /*Подключение доп.возможностей*/
    $features = array(
        'post-thumbnails', // Вкл.поддержку миниатюры
        'title-tag', // Вкл. автоматический. динамический <title>
    );

    foreach($features as $f) {
        add_theme_support($f);
    }

    /* Вкл. логотип */
    add_theme_support('custom-logo', array(
        'width' => '150',
        'height' => '40'
    ) );

    /* Вкл. background-color для body */
    add_theme_support('custom-background', array(
        'default-color' => 'dbdbdb', // цвет по умолч. !цвет без знака #
        'default-image' => get_template_directory_uri() . '/assets/images/background.png' // Фоновое изображение по умолчанию
    ) );

    /*Вкл. background-image для шапки */
    add_theme_support('custom-header', array(
        'default-image' => get_template_directory_uri() . '/assets/images/coffee.jpg', // Фон.карт.по умолч.
        'width' => '2000',
        'height' => '1300'
    ) );

    /* Добавляем польз. размер миниатюр */
    add_image_size('my-thumb', 100, 100);

    /* Меню - регистрация */
    register_nav_menus( array(
        'header_menu1' => 'Меню в шапке 1',
        'footer_menu2' => 'Меню в футере 2'
    ) );
}
/*
 * Вызываем test_setup() во время события after_setup_theme
 * */
add_action( 'after_setup_theme', 'test_setup' );

/* удаляет H2 из шаблона пагинации */
add_filter( 'navigation_markup_template', 'my_navigation_template', 10, 2 );

function my_navigation_template( $template, $class ) {
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

/*Регистрируем сайд бар*/
function test_widgets_init() {
    register_sidebar( array(
        'name'        => 'Сайдбар справа',
        'id'          => 'right-sidebar',
        'description' => 'Область для виджетов в сайдбаре справа'
    ) );
}
/*
 * Вызываем test_widgets_init() при событии 'widgets_init'*/
add_action('widgets_init', 'test_widgets_init');


/*
 * Customizer
 * Определим новую настройку и элемент управл. и добавим их в уже предустановленную в WP секцию 'colors'
 * Через данную функцию мы работаем с 3мя основными элементами кастомайзера секция - эл.управл. - настройка
 * Добавление и редактирование настроек осущ. посредством методов объекта
 * $wp_customize - объект класса WP_Customize_Manager
 * */
function test_customize_register( $wp_customize ) {
    $wp_customize->add_setting( // добавляем в объект $wp_customize настройку
        'test_link_color',// Наименование настройки
        array( // массив настроек
            'default'           => '#007bff', // цвет по умолч.
            'sanitize_callback' => 'sanitize_hex_color',// валидирует цвета - sanitize_hex_color - встроенная функц. ПРОЧИТАТЬ ПРО ЭТО В ОФ.ДОК. опционально
            'transport'         => 'postMessage' // асинхрон. перезагрузка части страницы
    ) );

    /* control(элемент управления) в который будет выведенна настройка 'test_link_color' */
    $wp_customize->add_control( // далее добавим элемент управления
        new WP_Customize_Color_Control( // объект этого класса использ. для настроек цвета
            $wp_customize, // объект класса WP_Customize_Manager
            'test_link_color', // ID
            array( // массив настроек
                'label'   => 'Цвет ссылок', // подпись данного поля
                'section' => 'colors', // секция куда мы хотим добав. наш новый control; colors - предустановленная секция WP.
                'setting' => 'test_link_color' // наименование настройки которая будет выведенна в данном control, определенна выше.
            )
        )
    );

    /*
     * Les 23 - adding custom section
     * */
    $wp_customize->add_section( 'test_site_data', array(
        'title'    => 'Информация сайта',
        'priority' => 30 // Порядковый номер места среди других секций.
    ) );

    $wp_customize->add_setting( 'test_phone', array(
        'default'   => '',
        'transport' => 'postMessage' // асинхрон. перезагрузка части страницы
    ) );

    //unset( $wp_customize->test_phone_set );
    //delete_option('test_phone_set');
    //$wp_customize->remove_setting('test_phone_set');
    //remove_theme_mod( 'test_phone_set' );
    //unset( $wp_customize->settings[ 'test_phone_set' ] );
    //remove_theme_mod('test_phone_set');

    $wp_customize->add_control( 'test_phone', array(
        'label'   => 'Телефон',
        'section' => 'test_site_data', // id секции, куда поместить
        'type'    => 'text' // by default
    ) );


    /**/
    $wp_customize->add_setting( 'test_show_phone', array(
        'default'   => true, // true или false в данном параметре говорит WP, что мы хотим использ. именно checkbox
        'transport' => 'postMessage' // асинхрон. перезагрузка части страницы
    ) );

    $wp_customize->add_control( 'test_show_phone', array(
        'label'   => 'Показывать Телефон',
        'section' => 'test_site_data', // id секции, куда поместить
        'type'    => 'checkbox'
    ) );
}
/* вешаем 'test_customize_register' на хук 'customize_register' */
add_action('customize_register', 'test_customize_register');



/*
 * Для того чтобы вносимые изменения во вновь созданной настройке 'test_link_color'
 * применялись к нужному нам html элементу и отображались в браузере
 * необходимо еще описать функц. test_customize_css() в которой будут описаны стили css.
 * test_customize_css() необходимо повесить на хук 'wp_head',
 * это нужно для того чтобы стили были выведенны в <header> и могли использоваться в <body>
 *  */
function test_customize_css() {
    $test_link_color = get_theme_mod('test_link_color');
    echo <<<HEREDOC
<style type="text/css">
a { color: $test_link_color; }
</style>
HEREDOC;

}
/*
 * хук 'wp_head' генерируется в том месте,
 * где стоит функц.метка wp_head(); - см. в <header> в файле header.php
 * */
add_action('wp_head', 'test_customize_css');


/* Подключение файла test-customize.js для асинхронной работы настроек в кастомайзере*/
function test_customize_js() {
    wp_enqueue_script( // подключение js скрипта для асинхорон. работы кастомайзера
        'test-customizer', // ID
        get_template_directory_uri() . '/assets/js/test-customize.js', // путь к файлу
        array( 'jquery', 'customize-preview' ), // массив зависимостей, которые будут полключ. перед загрузкой скрипта test-customize.js
        '',
        true // подключаем скрипт в футере
    );
}
/* вешаем на хук */
add_action('customize_preview_init', 'test_customize_js');