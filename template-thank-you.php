<?php
/*
Template Name: Thank You Page
*/
get_header();
?>
<section class="thank-you-page site-container">
    <div class="thank-you-shell">
        <div class="thank-you-main thank-you-card">
            <span class="thank-you-badge">Order Received</span>
            <h1><?php echo esc_html(tw_get_option('thank_you_heading')); ?></h1>
            <p class="thank-you-lead"><?php echo esc_html(tw_get_option('thank_you_copy')); ?></p>
            <p class="thank-you-phone">Support line: <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', tw_get_option('support_phone'))); ?>"><?php echo esc_html(tw_get_option('support_phone')); ?></a></p>

            <div class="thank-you-steps">
                <div><span>01</span><strong>Order received</strong><p>Your details have been submitted successfully.</p></div>
                <div><span>02</span><strong>We confirm fast</strong><p>Our team will contact you by phone or WhatsApp shortly.</p></div>
                <div><span>03</span><strong>Delivery arranged</strong><p>Once confirmed, your package is prepared for dispatch.</p></div>
            </div>

            <div class="thank-you-actions">
                <a class="btn btn-primary" href="<?php echo esc_url(home_url('/')); ?>">Back to Home</a>
                <a class="btn btn-secondary" href="<?php echo esc_url(tw_get_option('thank_you_whatsapp_url', tw_get_option('support_whatsapp'))); ?>" target="_blank" rel="noopener"><?php echo esc_html(tw_get_option('thank_you_cta')); ?></a>
            </div>
        </div>

        <aside class="thank-you-side">
            <div class="thank-you-mini-card">
                <span class="eyebrow">What happens next</span>
                <h3>Stay available for confirmation</h3>
                <p>Please keep your phone reachable so we can confirm your order details quickly and avoid delay.</p>
            </div>
            <div class="thank-you-mini-card dark-card">
                <span class="eyebrow">Need immediate help?</span>
                <h3>Contact Femzykentltd Wears Support</h3>
                <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', tw_get_option('support_phone'))); ?>"><?php echo esc_html(tw_get_option('support_phone')); ?></a></p>
                <p><a href="mailto:<?php echo esc_attr(tw_get_option('support_email')); ?>"><?php echo esc_html(tw_get_option('support_email')); ?></a></p>
                <a class="btn btn-secondary thank-you-side-btn" href="<?php echo esc_url(tw_get_option('support_whatsapp')); ?>" target="_blank" rel="noopener">WhatsApp Support</a>
            </div>
        </aside>
    </div>
</section>
<?php
get_footer();
