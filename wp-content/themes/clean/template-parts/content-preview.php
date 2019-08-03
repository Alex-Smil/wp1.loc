<?php if (has_post_thumbnail()) { // если лого есть, то использ. его адрес
    $img_url = get_the_post_thumbnail_url();
} else { // если лого нет, то картинка по умолч.
    $img_url = get_template_directory_uri() . '/assets/images/moon.jpg';
}
global $i;
?>

<div class="fh5co-portfolio-item <?php if ($i % 2 === 0) { echo 'fh5co-img-right'; } ?>">
    <div class="fh5co-portfolio-figure animate-box" style="background-image: url(<?php echo $img_url; ?>);"></div>
    <div class="fh5co-portfolio-description">
        <h2><?php the_title(); ?></h2>
        <?php the_content(''); ?>
        <p><a href="<?php the_permalink(); ?>" class="btn btn-primary"><?php _e('Read more', 'clean'); ?></a></p>
    </div>
</div>