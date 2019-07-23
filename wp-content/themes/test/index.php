<?php get_header(); ?>

<div class = 'container'>
    <div class = 'row'>
        <!-- class="col" займет всю достпную ширину, достп. с BS 4-->
        <div class="col">
            <div class="row">
                <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
                    <!-- post -->
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h5>
                            </div>
                            <div class="card-body">
                                <?php if(has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('thumbnail', array('class'=>'float-left mr-3')); ?><!--Если к посту иммется миниатюра-->
                                    </a>
                                <?php else: ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="/wp-content/uploads/2019/07/Bear-150x150.jpg" class="float-left mr-3" width="150" height="150"><!--Миниатюра по умолч.-->
                                    </a>
                                <?php endif; ?>
                                <p class="card-text"> <?php the_excerpt();?> </p>
                            </div>
                            <div class="card-footer">
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Go somewhere</a><!-- Ссылка на текущий пост -->

                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
                    <!-- post navigation -->
                    <?php the_posts_pagination(array(
                        'show_all'  => false,
                        'end_size'  => 1,
                        'mid_size'  => 2,
                        'type'      =>'list'
                    )) ?>
                <?php else: ?>
                    <!-- no posts found -->
                    <p>Постов нет ...</p>
                <?php endif; ?>
            </div>
        </div>
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>


