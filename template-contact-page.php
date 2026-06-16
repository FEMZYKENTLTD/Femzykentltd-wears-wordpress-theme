<?php
/*
Template Name: Contact Page
*/
get_header();
?>
<section class="inner-hero site-container narrow">
    <span class="eyebrow">Contact Femzykentltd Wears</span>
    <h1><?php the_title(); ?></h1>
    <p>Reach out for order confirmation, delivery support, size questions, or any help you need before placing your order.</p>
</section>

<section class="site-container contact-grid-page">
    <div class="contact-card contact-highlight">
        <span class="contact-label">Call us</span>
        <h3><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', tw_get_option('support_phone'))); ?>"><?php echo esc_html(tw_get_option('support_phone')); ?></a></h3>
        <p>Speak directly with our support team for fast order assistance.</p>
    </div>

    <div class="contact-card">
        <span class="contact-label">Email</span>
        <h3><a href="mailto:<?php echo esc_attr(tw_get_option('support_email')); ?>"><?php echo esc_html(tw_get_option('support_email')); ?></a></h3>
        <p>Best for follow-up details, order records, and support requests.</p>
    </div>

    <div class="contact-card">
        <span class="contact-label">WhatsApp</span>
        <h3><a href="<?php echo esc_url(tw_get_option('support_whatsapp')); ?>" target="_blank" rel="noopener">Join / Chat on WhatsApp</a></h3>
        <p>Use our WhatsApp link for updates, confirmations, and quick support.</p>
    </div>
</section>

<section class="site-container info-layout single-column-layout">
    <article class="info-card entry-content">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </article>
</section>
<?php
get_footer();
