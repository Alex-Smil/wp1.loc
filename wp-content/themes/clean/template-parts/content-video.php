<?php if (has_post_thumbnail()) { // если лого есть, то использ. его адрес
    $img_url = get_the_post_thumbnail_url();
} else { // если лого нет, то картинка по умолч.
    $img_url = get_template_directory_uri() . '/assets/images/moon.jpg';
}
?>

<img src="<?php echo $img_url; ?>" alt="">

<div class="fh5co-portfolio-description">
    <h2><?php the_title(); ?></h2>
    VIDEO
    <?php the_content(); ?>
</div>