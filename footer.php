</main>
<?php $tw_is_front = is_front_page() || is_page_template('template-landing.php'); ?>
<footer class="site-footer">
    <?php if ($tw_is_front) : ?>
        <section class="site-container prefooter-cta">
            <div class="prefooter-copy">
                <span class="eyebrow">Final Call To Order</span>
                <h2><?php echo esc_html(tw_get_option('final_cta_heading')); ?></h2>
                <p><?php echo esc_html(tw_get_option('final_cta_copy')); ?></p>
                <div class="prefooter-actions">
                    <a class="btn btn-primary" href="<?php echo esc_url(home_url('/#buy')); ?>"><?php echo esc_html(tw_get_option('primary_cta')); ?></a>
                    <a class="btn btn-secondary" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', tw_get_option('support_phone'))); ?>">Call <?php echo esc_html(tw_get_option('support_phone')); ?></a>
                </div>
            </div>
            <div class="prefooter-proof-grid">
                <div><span>Pay on Delivery</span><strong>Inspect before you pay</strong></div>
                <div><span>Fast Response</span><strong>Phone and WhatsApp confirmation</strong></div>
                <div><span>Sizes Ready</span><strong>40 – 46 available</strong></div>
            </div>
        </section>
    <?php endif; ?>

    <div class="site-container footer-shell">
        <div class="footer-topline">
            <div>
                <span class="footer-kicker">Femzykentltd Wears</span>
                <h2 class="footer-heading">Premium footwear built for men who want to look unforgettable.</h2>
            </div>
            <a class="footer-top-cta" href="<?php echo esc_url($tw_is_front ? home_url('/#buy') : home_url('/')); ?>"><?php echo esc_html($tw_is_front ? 'Order Your Pair' : 'Back to Home'); ?></a>
        </div>

        <div class="footer-grid">
            <div class="footer-brand-col">
                <div class="footer-brand"><?php echo esc_html(tw_get_option('brand_name')); ?></div>
                <p><?php echo esc_html(tw_get_option('footer_copy')); ?></p>
                <div class="footer-inline-proof">
                    <span>Premium Styles</span>
                    <span>Nationwide Delivery</span>
                    <span>Trusted Support</span>
                </div>
            </div>
            <div>
                <h3>Support</h3>
                <p><a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', tw_get_option('support_phone'))); ?>"><?php echo esc_html(tw_get_option('support_phone')); ?></a></p>
                <p><a href="mailto:<?php echo esc_attr(tw_get_option('support_email')); ?>"><?php echo esc_html(tw_get_option('support_email')); ?></a></p>
                <p><a href="<?php echo esc_url(tw_get_option('support_whatsapp')); ?>" target="_blank" rel="noopener">WhatsApp Support</a></p>
            </div>
            <div>
                <h3>Policies</h3>
                <p><a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>">Privacy Policy</a></p>
                <p><a href="<?php echo esc_url(home_url('/terms-and-conditions/')); ?>">Terms &amp; Conditions</a></p>
                <p><a href="<?php echo esc_url(home_url('/delivery-returns/')); ?>">Delivery &amp; Returns</a></p>
                <p><a href="<?php echo esc_url(home_url('/contact/')); ?>">Contact Page</a></p>
            </div>
        </div>

        <div class="disclaimers">
            <p><strong>FACEBOOK DISCLAIMER</strong> <?php echo esc_html(tw_get_option('facebook_disclaimer')); ?></p>
            <p><strong>GOOGLE DISCLAIMER</strong> <?php echo esc_html(tw_get_option('google_disclaimer')); ?></p>
        </div>
    </div>
</footer>
<div class="mobile-cta-bar">
    <?php if ($tw_is_front) : ?>
        <a class="mobile-cta-call" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', tw_get_option('support_phone'))); ?>">Call Now</a>
        <a class="mobile-cta-order" href="#buy"><?php echo esc_html(tw_get_option('primary_cta')); ?></a>
    <?php else : ?>
        <a class="mobile-cta-call" href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', tw_get_option('support_phone'))); ?>">Call Now</a>
        <a class="mobile-cta-order" href="<?php echo esc_url(home_url('/')); ?>">Back Home</a>
    <?php endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>
