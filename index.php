<?php
get_header();
?>
<section class="site-container narrow page-content">
    <h1><?php bloginfo('name'); ?></h1>
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
            </article>
        <?php endwhile; ?>
    <?php else : ?>
        <p>No content found.</p>
    <?php endif; ?>
</section>
<?php
get_footer();
