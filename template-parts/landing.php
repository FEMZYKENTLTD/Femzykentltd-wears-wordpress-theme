<?php
$shoe_query = new WP_Query([
    'post_type' => 'tw_shoe',
    'posts_per_page' => 38,
    'orderby' => ['menu_order' => 'ASC', 'date' => 'ASC'],
]);

$order_error = isset($_GET['order']) && $_GET['order'] === 'failed';
$hero_primary_code = tw_get_option('hero_primary_code', '24');
$hero_secondary_code = tw_get_option('hero_secondary_code', '15');
$hero_primary_id = tw_get_shoe_post_id_by_code($hero_primary_code);
$hero_secondary_id = tw_get_shoe_post_id_by_code($hero_secondary_code);
$hero_primary_image = $hero_primary_id ? tw_get_shoe_image_url($hero_primary_id, 'large') : tw_get_demo_shoe_image_url((int) $hero_primary_code);
$hero_secondary_image = $hero_secondary_id ? tw_get_shoe_image_url($hero_secondary_id, 'large') : tw_get_demo_shoe_image_url((int) $hero_secondary_code);
?>
<section class="hero-section site-container">
    <div class="hero-copy">
        <div class="hero-kicker-row">
            <span class="eyebrow"><?php echo esc_html(tw_get_option('trust_text')); ?></span>
            <span class="hero-mini-proof"><?php echo esc_html(tw_get_option('hero_mini_proof', 'Premium drop available now')); ?></span>
        </div>
        <h1><?php echo esc_html(tw_get_option('hero_heading')); ?></h1>
        <p><?php echo esc_html(tw_get_option('hero_copy')); ?></p>
        <div class="hero-actions">
            <a class="btn btn-primary" href="#buy"><?php echo esc_html(tw_get_option('primary_cta')); ?></a>
            <a class="btn btn-secondary" href="#top-picks"><?php echo esc_html(tw_get_option('secondary_cta')); ?></a>
        </div>
        <div class="rating-row">
            <span>★★★★★</span>
            <strong><?php echo esc_html(tw_get_option('rating_text')); ?></strong>
        </div>
        <div class="hero-proof-grid">
            <div><strong>38 Premium Codes</strong><span>Real images already loaded inside the theme</span></div>
            <div><strong>40–46 Fit Range</strong><span>Designed for comfort and confident wear</span></div>
            <div><strong>Call + WhatsApp</strong><span>Fast manual order confirmation before dispatch</span></div>
        </div>
        <ul class="trust-list">
            <li>100% Genuine Leather</li>
            <li>Comfort That Lasts</li>
            <li>Pay on Delivery</li>
        </ul>
    </div>
    <div class="hero-visual">
        <div class="hero-showcase">
            <span class="hero-floating-badge badge-top">Curated Premium Drop</span>
            <span class="hero-floating-badge badge-bottom">Inspect first • Pay later</span>
            <div class="hero-card hero-card-main">
                <span class="hero-card-tag">Premium Men Footwear</span>
                <h2><?php echo esc_html(tw_get_option('brand_name')); ?></h2>
                <p><?php echo esc_html(tw_get_option('hero_showcase_copy', 'Simple, premium, and conversion-focused design preloaded with your real shoe collection and ready for edits inside WordPress.')); ?></p>
                <div class="hero-stat-grid">
                    <div><strong>38</strong><span>shoe slots</span></div>
                    <div><strong>40–46</strong><span>sizes ready</span></div>
                    <div><strong>COD</strong><span>order flow</span></div>
                </div>
            </div>
            <div class="hero-image-frame hero-image-primary">
                <?php if ($hero_primary_image) : ?>
                    <img src="<?php echo esc_url($hero_primary_image); ?>" alt="Femzykentltd Wears premium featured shoe">
                <?php endif; ?>
            </div>
            <div class="hero-side-stack">
                <div class="hero-side-note">
                    <span>Signature Collection</span>
                    <strong>Premium loafers, slides, and sandals for men who want to stand out.</strong>
                </div>
                <div class="hero-image-frame hero-image-secondary">
                    <?php if ($hero_secondary_image) : ?>
                        <img src="<?php echo esc_url($hero_secondary_image); ?>" alt="Femzykentltd Wears signature shoe detail">
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="hero-luxury-strip">
            <div><span>Support line</span><strong><?php echo esc_html(tw_get_option('support_phone')); ?></strong></div>
            <div><span>Order flow</span><strong>Phone & WhatsApp confirmation</strong></div>
        </div>
    </div>
</section>

<section class="feature-section site-container">
    <div class="section-heading centered">
        <span class="eyebrow"><?php echo esc_html(tw_get_option('quality_heading')); ?></span>
        <h2>Built for men who refuse to look ordinary.</h2>
        <p><?php echo esc_html(tw_get_option('quality_copy')); ?></p>
    </div>
    <div class="feature-grid">
        <article class="feature-card">
            <h3>100% Genuine Leather</h3>
            <p>No plastic. No cheap finish. Just rich materials that age beautifully.</p>
        </article>
        <article class="feature-card">
            <h3>Handcrafted Quality</h3>
            <p>Each pair is finished for a refined look that works for events, office, and weekends.</p>
        </article>
        <article class="feature-card">
            <h3>Comfort That Lasts</h3>
            <p>Soft inner lining and supportive sole designed for long wear.</p>
        </article>
        <article class="feature-card">
            <h3>Pay On Delivery</h3>
            <p>Inspect your shoes first and pay only when you receive them.</p>
        </article>
    </div>
</section>

<section id="top-picks" class="products-section site-container">
    <div class="section-heading centered">
        <span class="eyebrow">Today's Top Picks</span>
        <h2>Choose Your Power Pair</h2>
        <p><?php echo esc_html(tw_get_option('products_copy', 'All 38 shoes are editable from the WordPress admin. Your real product images are bundled in this theme, and you can update titles, prices, sizes, and order in minutes.')); ?></p>
    </div>
    <div class="product-grid">
        <?php if ($shoe_query->have_posts()) : ?>
            <?php while ($shoe_query->have_posts()) : $shoe_query->the_post(); ?>
                <?php
                $shoe_id = get_the_ID();
                $code = get_post_meta($shoe_id, '_tw_code', true);
                $price = get_post_meta($shoe_id, '_tw_price', true);
                $old_price = get_post_meta($shoe_id, '_tw_old_price', true);
                $badge = get_post_meta($shoe_id, '_tw_badge', true);
                $sizes = get_post_meta($shoe_id, '_tw_sizes', true);
                $button = get_post_meta($shoe_id, '_tw_button_text', true) ?: 'ORDER NOW';
                $image_url = tw_get_shoe_image_url($shoe_id, 'large');
                ?>
                <article class="product-card">
                    <div class="product-media-wrap">
                        <div class="product-media-topline">
                            <span class="product-code-badge">CODE <?php echo esc_html($code); ?></span>
                            <?php if ($badge) : ?><span class="product-badge"><?php echo esc_html($badge); ?></span><?php endif; ?>
                        </div>
                        <?php if ($image_url) : ?>
                            <div class="product-media"><img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>"></div>
                        <?php else : ?>
                            <?php tw_render_placeholder_media($code); ?>
                        <?php endif; ?>
                        <div class="product-media-bottomline">Inspect first • Pay later</div>
                    </div>
                    <div class="product-body">
                        <div class="product-topline">
                            <span class="product-collection">Femzykentltd Wears Select</span>
                            <span class="product-size-chip"><?php echo esc_html($sizes ?: '40 - 46'); ?></span>
                        </div>
                        <h3><?php the_title(); ?></h3>
                        <p class="product-copy"><?php echo esc_html(get_the_excerpt() ?: 'Premium men\'s footwear with statement-making style.'); ?></p>
                        <div class="product-feature-pills">
                            <span>Premium finish</span>
                            <span>Fast confirmation</span>
                            <span>Pay on delivery</span>
                        </div>
                        <div class="price-row">
                            <div class="price-stack">
                                <small>Order Price</small>
                                <strong><?php echo esc_html($price ?: 'Set in admin'); ?></strong>
                                <?php if ($old_price && strtolower($old_price) !== 'optional') : ?><span><?php echo esc_html($old_price); ?></span><?php endif; ?>
                            </div>
                            <div class="availability-pill">Free Delivery</div>
                        </div>
                        <a class="btn btn-product js-order-btn" href="#buy" data-code="<?php echo esc_attr($code); ?>" data-title="<?php echo esc_attr(get_the_title()); ?>" data-price="<?php echo esc_attr($price); ?>"><span><?php echo esc_html($button); ?></span><small>Choose this pair</small></a>
                    </div>
                </article>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        <?php else : ?>
            <p>Add your shoes in WordPress Admin → Shoes.</p>
        <?php endif; ?>
    </div>
</section>

<section id="offer" class="offer-section site-container">
    <div class="offer-box">
        <div>
            <span class="eyebrow">Special Offer</span>
            <h2><?php echo esc_html(tw_get_option('offer_title')); ?></h2>
            <p><?php echo esc_html(tw_get_option('offer_copy')); ?></p>
            <ul class="offer-list">
                <li>Premium shoe polish kit</li>
                <li>Matching quality socks</li>
                <li>Free nationwide delivery</li>
            </ul>
        </div>
        <div class="offer-highlight">
            <span>FREE GIFT</span>
            <strong>Worth extra value when you buy 2 pairs or more</strong>
        </div>
    </div>
</section>

<section class="story-section site-container">
    <div class="story-card">
        <span class="eyebrow">Why Order Now</span>
        <h2><?php echo esc_html(tw_get_option('pricing_range')); ?></h2>
        <p><?php echo esc_html(tw_get_option('pricing_story')); ?></p>
        <p class="story-note">Stock is limited. Offer remains valid while this page is active.</p>
    </div>
    <div class="guarantee-card">
        <span class="eyebrow">Our Guarantee</span>
        <h2>See it. Touch it. Try it. Then pay.</h2>
        <p><?php echo esc_html(tw_get_option('guarantee_copy')); ?></p>
        <div class="guarantee-points">
            <div><strong>Free Delivery</strong><span>Nationwide where available</span></div>
            <div><strong>Fast Follow-up</strong><span>Phone or WhatsApp confirmation</span></div>
            <div><strong>Zero-Risk Feel</strong><span>Built for COD conversion</span></div>
        </div>
    </div>
</section>

<section class="how-section site-container">
    <div class="section-heading centered">
        <span class="eyebrow">How To Order</span>
        <h2>Simple 3-step landing-page flow</h2>
    </div>
    <div class="how-grid">
        <article><span>1</span><h3>Pick a Shoe</h3><p>Click any order button under the pair you want and we will prefill the bold shoe code in the form.</p></article>
        <article><span>2</span><h3>Fill Your Details</h3><p>Submit your name, phone, size, quantity, email, and delivery address.</p></article>
        <article><span>3</span><h3>Confirm & Receive</h3><p>Our team calls or messages you, confirms the details, and dispatches your order.</p></article>
    </div>
</section>

<section id="buy" class="order-section site-container">
    <div class="section-heading centered">
        <span class="eyebrow">Order Form</span>
        <h2>Ready to order your next compliment?</h2>
        <p><?php echo esc_html(tw_get_option('order_intro')); ?></p>
    </div>

    <?php if ($order_error) : ?>
        <div class="form-message error">Please complete all required fields and confirm that your information is correct.</div>
    <?php endif; ?>

    <div class="order-shell">
        <div class="order-layout">
            <div class="selected-product-card" id="selected-product-card">
                <span class="selected-label">Selected pair</span>
                <div class="selected-code-pill" id="selected-product-pill">CODE —</div>
                <h3 id="selected-product-name">Choose any shoe above</h3>
                <p id="selected-product-code">Bold shoe code will appear here automatically.</p>
                <strong id="selected-product-price">Price placeholder updates when you click ORDER NOW.</strong>

                <div class="selected-meta-grid">
                    <div>
                        <span>Payment</span>
                        <strong>Pay on Delivery</strong>
                    </div>
                    <div>
                        <span>Delivery</span>
                        <strong>Nationwide</strong>
                    </div>
                    <div>
                        <span>Sizes</span>
                        <strong>40 – 46</strong>
                    </div>
                </div>

                <div class="selected-help-box">
                    <p class="selected-help-title">Need help before ordering?</p>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', tw_get_option('support_phone'))); ?>"><?php echo esc_html(tw_get_option('support_phone')); ?></a>
                    <a href="mailto:<?php echo esc_attr(tw_get_option('support_email')); ?>"><?php echo esc_html(tw_get_option('support_email')); ?></a>
                </div>
            </div>

            <form class="order-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                <?php wp_nonce_field('tw_submit_order', 'tw_order_nonce'); ?>
                <input type="hidden" name="action" value="tw_submit_order">
                <input type="hidden" name="current_url" value="<?php echo esc_url(home_url(isset($_SERVER['REQUEST_URI']) ? wp_unslash($_SERVER['REQUEST_URI']) : '/')); ?>">

                <div class="form-intro-bar">
                    <span>Quick order form</span>
                    <span>24–48hrs confirmation</span>
                    <span>Premium support</span>
                </div>

                <div class="form-grid">
                    <label>
                        <span>Full Name *</span>
                        <input type="text" name="full_name" required placeholder="Your name">
                    </label>
                    <label>
                        <span>Phone Number *</span>
                        <input type="tel" name="phone_number" required placeholder="080...">
                    </label>
                    <label>
                        <span>Shoe Code *</span>
                        <input type="text" id="shoe_code" name="shoe_code" required placeholder="e.g. 1">
                    </label>
                    <label>
                        <span>Shoe Size *</span>
                        <select name="shoe_size" required>
                            <option value="">Select size</option>
                            <option>40</option>
                            <option>41</option>
                            <option>42</option>
                            <option>43</option>
                            <option>44</option>
                            <option>45</option>
                            <option>46</option>
                        </select>
                    </label>
                    <label>
                        <span>Quantity *</span>
                        <input type="number" name="quantity" min="1" step="1" required placeholder="1">
                        <small class="field-help"><?php echo esc_html(tw_get_option('quantity_help', 'Enter 1 or more if you want a custom quantity.')); ?></small>
                    </label>
                    <label>
                        <span>Email Address</span>
                        <input type="email" name="email_address" placeholder="your@email.com">
                    </label>
                    <label class="full-width">
                        <span>Full Address</span>
                        <textarea name="full_address" rows="5" placeholder="Delivery address"></textarea>
                    </label>
                    <label class="full-width consent-check">
                        <input type="checkbox" name="consent" value="yes" required>
                        <span>I confirm that all my information is correct.</span>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary btn-submit"><?php echo esc_html(tw_get_option('primary_cta')); ?></button>
                <div class="form-security-note">
                    <strong>Safe order process:</strong> our team confirms every order by call or WhatsApp before dispatch.
                </div>
            </form>
        </div>
    </div>
</section>

<section class="faq-section site-container narrow">
    <div class="section-heading centered">
        <span class="eyebrow">FAQ</span>
        <h2>Questions buyers usually ask first</h2>
    </div>
    <div class="faq-list">
        <details open>
            <summary>Do I really pay only when I receive the shoes?</summary>
            <p>Yes. This theme is designed for a landing-page cash-on-delivery flow just like your reference funnel.</p>
        </details>
        <details>
            <summary>How do I change the 38 products later?</summary>
            <p>Go to WordPress Admin → Shoes. Edit the title, featured image, price, code, excerpt, and sizes for each shoe slot.</p>
        </details>
        <details>
            <summary>Can this become a full store later?</summary>
            <p>Yes. The theme structure is intentionally simple so your landing page can later map into WooCommerce product and checkout pages.</p>
        </details>
    </div>
</section>
