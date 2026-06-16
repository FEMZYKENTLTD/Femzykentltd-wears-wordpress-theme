<?php
get_header();
?>
<section class="site-container narrow page-content">
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
            <h1><?php the_title(); ?></h1>
            <?php $tw_single_image = tw_get_shoe_image_url(get_the_ID(), 'large'); ?>
            <?php if ($tw_single_image) : ?>
                <div class="single-media"><img src="<?php echo esc_url($tw_single_image); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></div>
            <?php endif; ?>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
            <p><a class="btn btn-primary" href="<?php echo esc_url(home_url('/#buy')); ?>">Order This Shoe</a></p>
        </article>
    <?php endwhile; ?>
</section>
<?php
get_footer();
