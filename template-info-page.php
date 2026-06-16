<?php
/*
Template Name: Info Page
*/
get_header();

$slug = get_post_field('post_name', get_the_ID());
$intro_map = [
    'privacy-policy' => 'Your privacy matters to Femzykentltd Wears. This page explains what information we collect, how we use it, and how we protect it.',
    'terms-and-conditions' => 'Please review these terms before placing an order. They explain how confirmation, delivery, pricing, and support work.',
    'delivery-returns' => 'Everything you need to know about delivery timelines, order confirmation, inspection on arrival, and issue resolution.',
];
$intro = $intro_map[$slug] ?? 'Important information about ordering from Femzykentltd Wears.';
?>
<section class="inner-hero site-container narrow">
    <span class="eyebrow">Femzykentltd Wears Information</span>
    <h1><?php the_title(); ?></h1>
    <p><?php echo esc_html($intro); ?></p>
</section>

<section class="site-container info-layout">
    <article class="info-card entry-content">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </article>

    <aside class="info-sidebar">
        <div class="sidebar-card">
            <h3>Need support?</h3>
            <p>Call, email, or message Femzykentltd Wears if you need help before or after placing an order.</p>
            <a class="mini-link" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', tw_get_option('support_phone'))); ?>"><?php echo esc_html(tw_get_option('support_phone')); ?></a>
            <a class="mini-link" href="mailto:<?php echo esc_attr(tw_get_option('support_email')); ?>"><?php echo esc_html(tw_get_option('support_email')); ?></a>
        </div>

        <div class="sidebar-card quick-links">
            <h3>Quick links</h3>
            <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a>
            <a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>">Terms &amp; Conditions</a>
            <a href="<?php echo esc_url(home_url('/delivery-returns/')); ?>">Delivery &amp; Returns</a>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Page</a>
        </div>

        <div class="sidebar-card mini-cta">
            <span class="eyebrow">Ready to order?</span>
            <h3>See our premium collection</h3>
            <p>Go back to the landing page and choose your preferred shoe code.</p>
            <a class="btn btn-primary" href="<?php echo esc_url(home_url('/#top-picks')); ?>">Browse Shoes</a>
        </div>
    </aside>
</section>
<?php
get_footer();
