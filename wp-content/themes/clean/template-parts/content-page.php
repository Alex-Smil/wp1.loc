<?php if (has_post_thumbnail()) { // если лого есть, то использ. его адрес
    the_post_thumbnail();
} // если лого нет, то ничего не делаем, так как страница может не содержать миниатюру
?>

<div class="fh5co-portfolio-description">
    <h2><?php the_title(); ?></h2>
    <?php the_content(); ?>
</div>
