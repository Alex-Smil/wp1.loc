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
                                <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                    <?php _e('Читать далее', 'test'); // 2й параметр это text domain?>
                                </a><!-- Ссылка на текущий пост -->
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

<?php
/*
 * Выводим список записей по рубрике,
 * пользовательский цикл с использ объекта класса WP_Query
 * */
    $query = new WP_Query( array(
        //'cat' => '21, 31', // ID рубрики
        'category_name' => 'edge-case-2, markup',// выбирать записи можно указав слаг, вместо id
        'posts_per_page' => -1, // кол-во записей в пагинации
        'order_by' => 'title', // По какому элементу сортируем
        'order' => 'ASC' // ASC - по возрастанию; DESC - по убыванию
    ) );

    //$query = new WP_Query( 'cat=21,31&posts_per_page=-1');

    if($query->have_posts()) : while($query->have_posts()) : $query->the_post(); ?>
        <!-- post -->
        <h3><?php  the_title(); ?></h3>
    <?php endwhile; ?>
        <!-- post navigation -->
    <?php else: ?>
        <!-- no posts found -->
    <?php endif;

    wp_reset_postdata();
?>

<?php get_footer(); ?>


