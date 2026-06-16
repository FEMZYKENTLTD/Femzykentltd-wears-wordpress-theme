<?php
if (!defined('ABSPATH')) {
    exit;
}

function tw_default_options() {
    return [
        'brand_name' => 'Femzykentltd Wears',
        'announcement_left' => 'FREE Nationwide Delivery',
        'announcement_right' => 'Pay Only When Your Shoes Arrive',
        'trust_text' => 'Trusted by 5,850+ Gentlemen',
        'hero_heading' => 'Step Into The Room. Command Every Eye!',
        'hero_copy' => 'Premium men\'s footwear that speaks before you do — from statement loafers to slides and sandals, crafted for style, comfort, and pay-on-delivery confidence.',
        'primary_cta' => 'ORDER NOW - PAY ON DELIVERY',
        'secondary_cta' => 'Browse Top Picks',
        'rating_text' => '4.95 · 5,850+ reviews',
        'quality_heading' => 'Premium Footwear Collection',
        'quality_copy' => 'Built for men who refuse to look ordinary. Every pair is crafted for premium appearance, clean finishing, and everyday confidence.',
        'offer_title' => 'Buy 2 Pairs Or More — Get FREE Gifts!',
        'offer_copy' => 'Order 2 pairs and above today and get a premium shoe polish plus matching socks absolutely free.',
        'pricing_range' => '₦94,000 – ₦149,000',
        'pricing_story' => 'If you try to get this level of quality in boutiques, you may pay significantly more. Order here and enjoy a direct-to-door pay-on-delivery offer while stock lasts.',
        'guarantee_copy' => 'We ship to your doorstep. Inspect it, test the fit, and pay only when satisfied. That is our zero-risk promise.',
        'order_intro' => 'Fill the form only if you are ready to receive and pay within 24 to 48 hours.',
        'support_phone' => '+2349021156310',
        'support_whatsapp' => 'https://chat.whatsapp.com/C1bFI4tibJb7Rd4FYJjspw',
        'support_email' => 'femzykenterprisesltd@gmail.com',
        'thank_you_whatsapp_url' => 'https://chat.whatsapp.com/C1bFI4tibJb7Rd4FYJjspw',
        'hero_primary_code' => '24',
        'hero_secondary_code' => '15',
        'hero_mini_proof' => 'Premium drop available now',
        'hero_showcase_copy' => 'Simple, premium, and conversion-focused design preloaded with your real shoe collection and ready for edits inside WordPress.',
        'products_copy' => 'All 38 shoes are editable from the WordPress admin. Your real product images are bundled in this theme, and you can update titles, prices, sizes, and order in minutes.',
        'quantity_help' => 'Enter 1 or more if you want a custom quantity.',
        'footer_copy' => 'Femzykentltd Wears — Copyright © ' . date('Y') . '. All Rights Reserved.',
        'facebook_disclaimer' => 'This website is not part of Facebook or Meta and is not endorsed by them in any way. Facebook is a trademark of Meta Platforms, Inc.',
        'google_disclaimer' => 'We may use remarketing pixels/cookies to show relevant offers to people who previously visited our site.',
        'thank_you_heading' => 'Thank You For Placing Your Order.',
        'thank_you_copy' => 'A member of our team will contact you shortly to confirm your order details.',
        'thank_you_cta' => 'Join Our WhatsApp Channel',
        'final_cta_heading' => 'Ready to step out with quiet confidence and premium presence?',
        'final_cta_copy' => 'Choose your preferred shoe code, submit your order in minutes, and let Femzykentltd Wears confirm everything fast by call or WhatsApp.',
    ];
}

function tw_get_option($key, $default = '') {
    $options = get_option('tw_options', []);
    $defaults = tw_default_options();

    if (isset($options[$key]) && $options[$key] !== '') {
        return $options[$key];
    }

    return $defaults[$key] ?? $default;
}

function tw_setup_theme() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo');
    add_theme_support('custom-header');

    register_nav_menus([
        'primary' => __('Primary Menu', 'trend-wears-landing'),
    ]);
}
add_action('after_setup_theme', 'tw_setup_theme');

function tw_enqueue_assets() {
    wp_enqueue_style('tw-main', get_template_directory_uri() . '/assets/css/main.css', [], '1.0.0');
    wp_enqueue_script('tw-main', get_template_directory_uri() . '/assets/js/main.js', [], '1.0.0', true);

    wp_localize_script('tw-main', 'twTheme', [
        'brand' => tw_get_option('brand_name', 'Femzykentltd Wears'),
    ]);
}
add_action('wp_enqueue_scripts', 'tw_enqueue_assets');

function tw_register_post_types() {
    register_post_type('tw_shoe', [
        'labels' => [
            'name' => __('Shoes', 'trend-wears-landing'),
            'singular_name' => __('Shoe', 'trend-wears-landing'),
            'add_new_item' => __('Add New Shoe', 'trend-wears-landing'),
            'edit_item' => __('Edit Shoe', 'trend-wears-landing'),
        ],
        'public' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-products',
        'supports' => ['title', 'thumbnail', 'editor', 'excerpt', 'page-attributes'],
        'has_archive' => false,
        'rewrite' => ['slug' => 'shoe'],
    ]);

    register_post_type('tw_order', [
        'labels' => [
            'name' => __('Orders', 'trend-wears-landing'),
            'singular_name' => __('Order', 'trend-wears-landing'),
        ],
        'public' => false,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_icon' => 'dashicons-clipboard',
        'supports' => ['title'],
    ]);
}
add_action('init', 'tw_register_post_types');

function tw_add_shoe_metaboxes() {
    add_meta_box('tw_shoe_details', __('Shoe Details', 'trend-wears-landing'), 'tw_render_shoe_metabox', 'tw_shoe', 'normal', 'high');
    add_meta_box('tw_order_details', __('Order Details', 'trend-wears-landing'), 'tw_render_order_metabox', 'tw_order', 'normal', 'high');
}
add_action('add_meta_boxes', 'tw_add_shoe_metaboxes');

function tw_render_shoe_metabox($post) {
    wp_nonce_field('tw_save_shoe_meta', 'tw_shoe_meta_nonce');
    $code = get_post_meta($post->ID, '_tw_code', true);
    $price = get_post_meta($post->ID, '_tw_price', true);
    $old_price = get_post_meta($post->ID, '_tw_old_price', true);
    $badge = get_post_meta($post->ID, '_tw_badge', true);
    $sizes = get_post_meta($post->ID, '_tw_sizes', true);
    $button = get_post_meta($post->ID, '_tw_button_text', true);
    ?>
    <p><label><strong><?php esc_html_e('Shoe Code', 'trend-wears-landing'); ?></strong></label><br>
        <input type="text" name="tw_code" value="<?php echo esc_attr($code); ?>" class="regular-text" placeholder="1"></p>
    <p><label><strong><?php esc_html_e('Price', 'trend-wears-landing'); ?></strong></label><br>
        <input type="text" name="tw_price" value="<?php echo esc_attr($price); ?>" class="regular-text" placeholder="₦94,000 or Set in admin"></p>
    <p><label><strong><?php esc_html_e('Old Price / Reference Price', 'trend-wears-landing'); ?></strong></label><br>
        <input type="text" name="tw_old_price" value="<?php echo esc_attr($old_price); ?>" class="regular-text" placeholder="₦105,000 or Optional"></p>
    <p><label><strong><?php esc_html_e('Badge', 'trend-wears-landing'); ?></strong></label><br>
        <input type="text" name="tw_badge" value="<?php echo esc_attr($badge); ?>" class="regular-text" placeholder="Top Pick"></p>
    <p><label><strong><?php esc_html_e('Available Sizes', 'trend-wears-landing'); ?></strong></label><br>
        <input type="text" name="tw_sizes" value="<?php echo esc_attr($sizes); ?>" class="regular-text" placeholder="40 - 46"></p>
    <p><label><strong><?php esc_html_e('Button Text', 'trend-wears-landing'); ?></strong></label><br>
        <input type="text" name="tw_button_text" value="<?php echo esc_attr($button ?: 'ORDER NOW'); ?>" class="regular-text"></p>
    <?php
}

function tw_render_order_metabox($post) {
    wp_nonce_field('tw_save_order_meta', 'tw_order_meta_nonce');
    $fields = [
        'name' => get_post_meta($post->ID, '_tw_order_name', true),
        'phone' => get_post_meta($post->ID, '_tw_order_phone', true),
        'shoe_code' => get_post_meta($post->ID, '_tw_order_shoe_code', true),
        'size' => get_post_meta($post->ID, '_tw_order_size', true),
        'quantity' => get_post_meta($post->ID, '_tw_order_quantity', true),
        'email' => get_post_meta($post->ID, '_tw_order_email', true),
        'address' => get_post_meta($post->ID, '_tw_order_address', true),
        'referrer' => get_post_meta($post->ID, '_tw_order_referrer', true),
    ];
    ?>
    <table class="form-table" role="presentation">
        <tbody>
            <tr><th><label for="tw_order_name">Customer Name</label></th><td><input id="tw_order_name" type="text" name="tw_order_name" value="<?php echo esc_attr($fields['name']); ?>" class="regular-text"></td></tr>
            <tr><th><label for="tw_order_phone">Phone</label></th><td><input id="tw_order_phone" type="text" name="tw_order_phone" value="<?php echo esc_attr($fields['phone']); ?>" class="regular-text"></td></tr>
            <tr><th><label for="tw_order_shoe_code">Shoe Code</label></th><td><input id="tw_order_shoe_code" type="text" name="tw_order_shoe_code" value="<?php echo esc_attr($fields['shoe_code']); ?>" class="regular-text"></td></tr>
            <tr><th><label for="tw_order_size">Shoe Size</label></th><td><input id="tw_order_size" type="text" name="tw_order_size" value="<?php echo esc_attr($fields['size']); ?>" class="regular-text"></td></tr>
            <tr><th><label for="tw_order_quantity">Quantity</label></th><td><input id="tw_order_quantity" type="number" min="1" step="1" name="tw_order_quantity" value="<?php echo esc_attr($fields['quantity']); ?>" class="small-text"></td></tr>
            <tr><th><label for="tw_order_email">Email</label></th><td><input id="tw_order_email" type="email" name="tw_order_email" value="<?php echo esc_attr($fields['email']); ?>" class="regular-text"></td></tr>
            <tr><th><label for="tw_order_address">Address</label></th><td><textarea id="tw_order_address" name="tw_order_address" rows="5" class="large-text"><?php echo esc_textarea($fields['address']); ?></textarea></td></tr>
            <tr><th><label for="tw_order_referrer">Source URL</label></th><td><input id="tw_order_referrer" type="text" name="tw_order_referrer" value="<?php echo esc_attr($fields['referrer']); ?>" class="large-text"></td></tr>
        </tbody>
    </table>
    <?php
}

function tw_save_shoe_meta($post_id) {
    if (!isset($_POST['tw_shoe_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['tw_shoe_meta_nonce'])), 'tw_save_shoe_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = [
        '_tw_code' => 'tw_code',
        '_tw_price' => 'tw_price',
        '_tw_old_price' => 'tw_old_price',
        '_tw_badge' => 'tw_badge',
        '_tw_sizes' => 'tw_sizes',
        '_tw_button_text' => 'tw_button_text',
    ];

    foreach ($fields as $meta_key => $field_name) {
        if (isset($_POST[$field_name])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field(wp_unslash($_POST[$field_name])));
        }
    }
}
add_action('save_post_tw_shoe', 'tw_save_shoe_meta');

function tw_save_order_meta($post_id) {
    if (!isset($_POST['tw_order_meta_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['tw_order_meta_nonce'])), 'tw_save_order_meta')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $text_fields = [
        '_tw_order_name' => 'tw_order_name',
        '_tw_order_phone' => 'tw_order_phone',
        '_tw_order_shoe_code' => 'tw_order_shoe_code',
        '_tw_order_size' => 'tw_order_size',
        '_tw_order_referrer' => 'tw_order_referrer',
    ];

    foreach ($text_fields as $meta_key => $field_name) {
        if (isset($_POST[$field_name])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field(wp_unslash($_POST[$field_name])));
        }
    }

    if (isset($_POST['tw_order_quantity'])) {
        update_post_meta($post_id, '_tw_order_quantity', max(1, absint(wp_unslash($_POST['tw_order_quantity']))));
    }

    if (isset($_POST['tw_order_email'])) {
        update_post_meta($post_id, '_tw_order_email', sanitize_email(wp_unslash($_POST['tw_order_email'])));
    }

    if (isset($_POST['tw_order_address'])) {
        update_post_meta($post_id, '_tw_order_address', sanitize_textarea_field(wp_unslash($_POST['tw_order_address'])));
    }
}
add_action('save_post_tw_order', 'tw_save_order_meta');

function tw_order_columns($columns) {
    return [
        'cb' => $columns['cb'],
        'title' => __('Order', 'trend-wears-landing'),
        'phone' => __('Phone', 'trend-wears-landing'),
        'shoe' => __('Shoe Code', 'trend-wears-landing'),
        'size' => __('Size', 'trend-wears-landing'),
        'quantity' => __('Qty', 'trend-wears-landing'),
        'address' => __('Address', 'trend-wears-landing'),
        'date' => __('Date', 'trend-wears-landing'),
    ];
}
add_filter('manage_tw_order_posts_columns', 'tw_order_columns');

function tw_order_column_content($column, $post_id) {
    $map = [
        'phone' => '_tw_order_phone',
        'shoe' => '_tw_order_shoe_code',
        'size' => '_tw_order_size',
        'quantity' => '_tw_order_quantity',
        'address' => '_tw_order_address',
    ];

    if (isset($map[$column])) {
        $value = get_post_meta($post_id, $map[$column], true);
        if ($column === 'address' && $value) {
            $value = wp_trim_words($value, 10, '...');
        }
        echo esc_html($value);
    }
}
add_action('manage_tw_order_posts_custom_column', 'tw_order_column_content', 10, 2);

function tw_register_settings() {
    register_setting('tw_options_group', 'tw_options');
}
add_action('admin_init', 'tw_register_settings');

function tw_add_theme_options_page() {
    add_theme_page(
        __('Femzykentltd Wears Settings', 'trend-wears-landing'),
        __('Femzykentltd Wears Settings', 'trend-wears-landing'),
        'manage_options',
        'tw-theme-settings',
        'tw_render_theme_settings_page'
    );
}
add_action('admin_menu', 'tw_add_theme_options_page');

function tw_render_theme_settings_page() {
    $options = get_option('tw_options', []);
    $defaults = tw_default_options();
    $fields = [
        'brand_name' => 'Brand Name',
        'announcement_left' => 'Announcement Left',
        'announcement_right' => 'Announcement Right',
        'trust_text' => 'Trust Text',
        'hero_heading' => 'Hero Heading',
        'hero_copy' => 'Hero Copy',
        'primary_cta' => 'Primary CTA',
        'secondary_cta' => 'Secondary CTA',
        'rating_text' => 'Rating Text',
        'quality_heading' => 'Quality Heading',
        'quality_copy' => 'Quality Copy',
        'offer_title' => 'Offer Title',
        'offer_copy' => 'Offer Copy',
        'pricing_range' => 'Pricing Range',
        'pricing_story' => 'Pricing Story',
        'guarantee_copy' => 'Guarantee Copy',
        'order_intro' => 'Order Intro',
        'support_phone' => 'Support Phone',
        'support_whatsapp' => 'WhatsApp URL',
        'support_email' => 'Support Email',
        'thank_you_whatsapp_url' => 'Thank You WhatsApp URL',
        'hero_primary_code' => 'Hero Primary Shoe Code',
        'hero_secondary_code' => 'Hero Secondary Shoe Code',
        'hero_mini_proof' => 'Hero Mini Proof',
        'hero_showcase_copy' => 'Hero Showcase Copy',
        'products_copy' => 'Products Section Copy',
        'quantity_help' => 'Quantity Help Text',
        'final_cta_heading' => 'Final CTA Heading',
        'final_cta_copy' => 'Final CTA Copy',
        'footer_copy' => 'Footer Copyright',
        'facebook_disclaimer' => 'Facebook Disclaimer',
        'google_disclaimer' => 'Google Disclaimer',
        'thank_you_heading' => 'Thank You Heading',
        'thank_you_copy' => 'Thank You Copy',
        'thank_you_cta' => 'Thank You CTA Text',
    ];
    ?>
    <div class="wrap">
        <h1><?php esc_html_e('Femzykentltd Wears Theme Settings', 'trend-wears-landing'); ?></h1>
        <form method="post" action="options.php">
            <?php settings_fields('tw_options_group'); ?>
            <table class="form-table" role="presentation">
                <tbody>
                <?php foreach ($fields as $key => $label) :
                    $value = $options[$key] ?? $defaults[$key] ?? '';
                    $is_textarea = in_array($key, ['hero_copy', 'hero_showcase_copy', 'products_copy', 'quality_copy', 'offer_copy', 'pricing_story', 'guarantee_copy', 'order_intro', 'facebook_disclaimer', 'google_disclaimer', 'thank_you_copy', 'final_cta_copy'], true);
                    ?>
                    <tr>
                        <th scope="row"><label for="tw_<?php echo esc_attr($key); ?>"><?php echo esc_html($label); ?></label></th>
                        <td>
                            <?php if ($is_textarea) : ?>
                                <textarea id="tw_<?php echo esc_attr($key); ?>" name="tw_options[<?php echo esc_attr($key); ?>]" rows="4" class="large-text"><?php echo esc_textarea($value); ?></textarea>
                            <?php else : ?>
                                <input id="tw_<?php echo esc_attr($key); ?>" type="text" name="tw_options[<?php echo esc_attr($key); ?>]" value="<?php echo esc_attr($value); ?>" class="regular-text">
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function tw_create_page_if_missing($args) {
    $existing = get_page_by_path($args['post_name']);
    if ($existing) {
        if (!empty($args['page_template'])) {
            update_post_meta($existing->ID, '_wp_page_template', $args['page_template']);
        }
        return $existing->ID;
    }

    $page_id = wp_insert_post([
        'post_type' => 'page',
        'post_status' => 'publish',
        'post_title' => $args['post_title'],
        'post_name' => $args['post_name'],
        'post_content' => $args['post_content'] ?? '',
    ]);

    if ($page_id && !is_wp_error($page_id) && !empty($args['page_template'])) {
        update_post_meta($page_id, '_wp_page_template', $args['page_template']);
    }

    return $page_id;
}

function tw_demo_shoe_catalog() {
    return [
        1 => ['title' => 'White Signature Flip Flop', 'excerpt' => 'Minimal premium flip flop with a clean white finish and statement hardware.', 'badge' => 'Top Pick'],
        2 => ['title' => 'Black Crystal Slide', 'excerpt' => 'Dressy black slide designed for standout casual luxury.', 'badge' => 'Top Pick'],
        3 => ['title' => 'White Double Strap Sandal', 'excerpt' => 'Clean white sandal with a refined buckle detail and rich finishing.', 'badge' => 'Top Pick'],
        4 => ['title' => 'Black Leather Mule', 'excerpt' => 'Sharp black closed mule built for effortless premium style.', 'badge' => ''],
        5 => ['title' => 'Brown Closed Mule', 'excerpt' => 'Smooth brown mule with a structured silhouette and easy slip-on comfort.', 'badge' => ''],
        6 => ['title' => 'Brown Statement Sandal', 'excerpt' => 'A premium open sandal with bold hardware and modern finishing.', 'badge' => ''],
        7 => ['title' => 'White Croc Double Strap Slide', 'excerpt' => 'Textured white slide made for relaxed luxury and clean looks.', 'badge' => ''],
        8 => ['title' => 'Royal Blue Tiger Loafer', 'excerpt' => 'Statement velvet-style loafer with bold embroidered tiger detailing.', 'badge' => 'Top Pick'],
        9 => ['title' => 'Monochrome Patent Loafer', 'excerpt' => 'High-contrast patent loafer that delivers a polished premium finish.', 'badge' => ''],
        10 => ['title' => 'Emerald Velvet Loafer', 'excerpt' => 'Elegant green loafer with a soft luxe finish and refined silhouette.', 'badge' => 'Top Pick'],
        11 => ['title' => 'White Croc Metal Loafer', 'excerpt' => 'Textured white loafer elevated with a rich metal accent.', 'badge' => ''],
        12 => ['title' => 'Black Chunky Patent Loafer', 'excerpt' => 'Bold black loafer with a thicker sole for a stronger presence.', 'badge' => ''],
        13 => ['title' => 'Red Tiger Velvet Loafer', 'excerpt' => 'A vivid red statement loafer crafted to turn heads immediately.', 'badge' => ''],
        14 => ['title' => 'Green Tiger Velvet Loafer', 'excerpt' => 'Deep green tiger loafer for confident event and occasion styling.', 'badge' => ''],
        15 => ['title' => 'Black Studded Slip-On', 'excerpt' => 'Black slip-on finished with all-over stud detailing for elevated shine.', 'badge' => 'Top Pick'],
        16 => ['title' => 'Green Studded Slip-On', 'excerpt' => 'Premium green slip-on built for bold dressing and standout looks.', 'badge' => ''],
        17 => ['title' => 'Purple Tiger Velvet Loafer', 'excerpt' => 'Rich purple statement loafer with embroidered tiger art.', 'badge' => ''],
        18 => ['title' => 'Black Patent Metal Loafer', 'excerpt' => 'Glossy black loafer with sleek metal detail and occasion-ready appeal.', 'badge' => ''],
        19 => ['title' => 'Black Tiger Velvet Loafer', 'excerpt' => 'Dark velvet-style loafer with bold embroidery and luxury presence.', 'badge' => ''],
        20 => ['title' => 'Bronze Studded Slip-On', 'excerpt' => 'Warm bronze slip-on with detailed stud finish and premium texture.', 'badge' => ''],
        21 => ['title' => 'Red Studded Slip-On', 'excerpt' => 'Bright red slip-on crafted for standout styling and event wear.', 'badge' => ''],
        22 => ['title' => 'Black Woven Slide', 'excerpt' => 'Refined woven slide that balances comfort with rich visual texture.', 'badge' => ''],
        23 => ['title' => 'Burgundy Patent Bit Loafer', 'excerpt' => 'Deep burgundy loafer with polished shine and elegant metal detail.', 'badge' => ''],
        24 => ['title' => 'Black Medusa Patent Loafer', 'excerpt' => 'Glossy black loafer with striking gold-detail finish.', 'badge' => 'Top Pick'],
        25 => ['title' => 'Pattern Double Strap Slide', 'excerpt' => 'Fashion-forward slide with bold pattern straps and a cushioned base.', 'badge' => ''],
        26 => ['title' => 'Tan Studded Slip-On', 'excerpt' => 'Warm tan slip-on with dense premium stud finishing.', 'badge' => ''],
        27 => ['title' => 'Green-Red Strap Flip Flop', 'excerpt' => 'Premium striped flip flop made for effortless casual luxury.', 'badge' => ''],
        28 => ['title' => 'Black Patent Croc Loafer', 'excerpt' => 'Glossy black loafer with croc-texture detailing and premium shine.', 'badge' => 'Top Pick'],
        29 => ['title' => 'Blue Studded Slip-On', 'excerpt' => 'Electric blue slip-on with rich studded texture for standout appeal.', 'badge' => ''],
        30 => ['title' => 'Plum Patent Bit Loafer', 'excerpt' => 'Rich plum-toned patent loafer designed for stylish occasion wear.', 'badge' => ''],
        31 => ['title' => 'Monogram Double Strap Slide', 'excerpt' => 'Luxury-inspired monogram slide with bold straps and comfort base.', 'badge' => ''],
        32 => ['title' => 'White Signature Flip Flop II', 'excerpt' => 'Clean white flip flop with a premium signature-inspired finish.', 'badge' => ''],
        33 => ['title' => 'Ivory Studded Slip-On', 'excerpt' => 'Soft ivory slip-on with bright stud finishing and polished style.', 'badge' => ''],
        34 => ['title' => 'Brown Croc Slide', 'excerpt' => 'Structured brown slide with textured upper and premium look.', 'badge' => ''],
        35 => ['title' => 'Tan Buckle Comfort Slide', 'excerpt' => 'Comfort-focused tan slide with rich buckle detail and modern shape.', 'badge' => ''],
        36 => ['title' => 'White Closed Mule', 'excerpt' => 'Minimal white mule with a crisp structured look and slip-on ease.', 'badge' => ''],
        37 => ['title' => 'White Minimal Flip Flop', 'excerpt' => 'Sleek white flip flop with a modern understated premium finish.', 'badge' => ''],
        38 => ['title' => 'Tan Minimal Flip Flop', 'excerpt' => 'Soft tan flip flop designed for clean premium everyday wear.', 'badge' => ''],
    ];
}

function tw_get_shoe_code_number($post_id) {
    $code = get_post_meta($post_id, '_tw_code', true);
    $number = absint(preg_replace('/[^0-9]/', '', (string) $code));

    if (!$number) {
        $number = absint(get_post_field('menu_order', $post_id));
    }

    return $number;
}

function tw_get_demo_shoe_image_url($number) {
    $number = absint($number);
    if (!$number) {
        return '';
    }

    $file = sprintf('assets/demo-shoes/shoe-%02d.jpeg', $number);
    $path = trailingslashit(get_template_directory()) . $file;

    if (file_exists($path)) {
        return trailingslashit(get_template_directory_uri()) . $file;
    }

    return '';
}

function tw_get_shoe_image_url($post_id, $size = 'large') {
    if (has_post_thumbnail($post_id)) {
        $url = get_the_post_thumbnail_url($post_id, $size);
        if ($url) {
            return $url;
        }
    }

    return tw_get_demo_shoe_image_url(tw_get_shoe_code_number($post_id));
}

function tw_get_shoe_post_id_by_code($code) {
    $posts = get_posts([
        'post_type' => 'tw_shoe',
        'post_status' => 'publish',
        'posts_per_page' => 1,
        'fields' => 'ids',
        'meta_key' => '_tw_code',
        'meta_value' => (string) $code,
    ]);

    return !empty($posts) ? (int) $posts[0] : 0;
}

function tw_seed_demo_shoes() {
    $existing = get_posts([
        'post_type' => 'tw_shoe',
        'post_status' => 'any',
        'numberposts' => 1,
    ]);

    if ($existing) {
        return;
    }

    $catalog = tw_demo_shoe_catalog();

    for ($i = 1; $i <= 38; $i++) {
        $number = str_pad((string) $i, 2, '0', STR_PAD_LEFT);
        $item = $catalog[$i] ?? [
            'title' => 'Femzykentltd Wears Shoe ' . $number,
            'excerpt' => 'Premium footwear with clean finishing and standout style.',
            'badge' => '',
        ];

        $post_id = wp_insert_post([
            'post_type' => 'tw_shoe',
            'post_status' => 'publish',
            'post_title' => $item['title'],
            'post_excerpt' => $item['excerpt'],
            'menu_order' => $i,
        ]);

        if ($post_id && !is_wp_error($post_id)) {
            update_post_meta($post_id, '_tw_code', (string) $i);
            update_post_meta($post_id, '_tw_price', 'Set in admin');
            update_post_meta($post_id, '_tw_old_price', 'Optional');
            update_post_meta($post_id, '_tw_badge', $item['badge']);
            update_post_meta($post_id, '_tw_sizes', '40 - 46');
            update_post_meta($post_id, '_tw_button_text', 'ORDER NOW');
        }
    }
}

function tw_after_switch_theme() {
    $home_id = tw_create_page_if_missing([
        'post_title' => 'Home',
        'post_name' => 'home',
        'post_content' => '',
    ]);

    $thank_id = tw_create_page_if_missing([
        'post_title' => 'Thank You',
        'post_name' => 'thank-you',
        'post_content' => '',
        'page_template' => 'template-thank-you.php',
    ]);

    tw_create_page_if_missing([
        'post_title' => 'Privacy Policy',
        'post_name' => 'privacy-policy',
        'page_template' => 'template-info-page.php',
        'post_content' => "<h2>Information We Collect</h2>\n<p>When you place an order, we may collect your name, phone number, email address, delivery address, shoe code, size, and quantity. We only collect the information needed to process and confirm your order.</p>\n\n<h2>How We Use Your Information</h2>\n<ul><li>To confirm your order by phone or WhatsApp</li><li>To arrange delivery to your address</li><li>To provide post-order support if needed</li><li>To improve customer service and order accuracy</li></ul>\n\n<h2>Marketing & Remarketing</h2>\n<p>We may use pixels, cookies, or similar tools to measure ad performance and show relevant offers to people who previously visited our site.</p>\n\n<h2>Data Protection</h2>\n<p>[trend_wears_brand] does not sell your personal information. Your details are used only for business operations related to your order and customer support.</p>\n\n<h2>Your Rights</h2>\n<p>If you need your details corrected or removed, contact us through the phone number or email shown on our Contact page.</p>",
    ]);

    tw_create_page_if_missing([
        'post_title' => 'Terms & Conditions',
        'post_name' => 'terms-and-conditions',
        'page_template' => 'template-info-page.php',
        'post_content' => "<h2>Order Confirmation</h2>\n<p>All orders are subject to confirmation by phone call or WhatsApp before dispatch.</p>\n\n<h2>Product Availability</h2>\n<p>Products are available while stock lasts. In rare cases, a selected shoe may become unavailable before confirmation is completed.</p>\n\n<h2>Pricing</h2>\n<p>Prices displayed on the website may change at any time without prior notice. The final agreed price is the one confirmed with you at the time of order processing.</p>\n\n<h2>Customer Information</h2>\n<p>By placing an order, you confirm that all submitted information is correct, including your name, phone number, address, shoe code, size, and quantity.</p>\n\n<h2>Delivery & Payment</h2>\n<p>Delivery timelines may vary by location. Where pay-on-delivery is available, customers are expected to be available to receive their package and complete payment as agreed.</p>\n\n<h2>Promotions</h2>\n<p>Free gifts, special offers, or campaign promotions may change or end without notice.</p>",
    ]);

    tw_create_page_if_missing([
        'post_title' => 'Delivery & Returns',
        'post_name' => 'delivery-returns',
        'page_template' => 'template-info-page.php',
        'post_content' => "<h2>Delivery Coverage</h2>\n<p>We offer delivery to customers across Nigeria where service is available through our dispatch partners.</p>\n\n<h2>Delivery Timeline</h2>\n<p>Delivery timelines depend on your location and current order volume. Most orders are confirmed quickly and dispatched after confirmation.</p>\n\n<h2>Pay on Delivery</h2>\n<p>Where applicable, customers can inspect their order on arrival before completing payment, subject to courier and delivery arrangements.</p>\n\n<h2>Dispatch Errors</h2>\n<p>If you receive the wrong item, wrong size, or there is a clear dispatch issue, contact our support team immediately with your order details.</p>\n\n<h2>Returns & Resolution</h2>\n<p>Because our products are fashion items, return handling depends on the condition of the item and the nature of the issue reported. Contact support quickly so we can review and resolve the case appropriately.</p>",
    ]);

    tw_create_page_if_missing([
        'post_title' => 'Contact',
        'post_name' => 'contact',
        'page_template' => 'template-contact-page.php',
        'post_content' => '<h2>Customer Support</h2><p>For order confirmation, delivery questions, shoe selection help, or support after ordering, please use any of the contact options on this page.</p><p><strong>Phone:</strong> ' . tw_get_option('support_phone', '+2349021156310') . '</p><p><strong>Email:</strong> ' . tw_get_option('support_email', 'femzykenterprisesltd@gmail.com') . '</p><p><strong>WhatsApp:</strong> ' . tw_get_option('support_whatsapp', 'https://chat.whatsapp.com/C1bFI4tibJb7Rd4FYJjspw') . '</p>',
    ]);

    update_option('tw_seed_demo_shoes_pending', 1);

    if ($home_id) {
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    if ($thank_id) {
        update_option('tw_thank_you_page_id', $thank_id);
    }

    flush_rewrite_rules();
}
add_action('after_switch_theme', 'tw_after_switch_theme');

function tw_seed_pending_content() {
    if (get_option('tw_seed_demo_shoes_pending')) {
        tw_seed_demo_shoes();
        delete_option('tw_seed_demo_shoes_pending');
    }
}
add_action('init', 'tw_seed_pending_content', 20);

function tw_render_placeholder_media($code = '') {
    echo '<div class="tw-placeholder-media">';
    echo '<span>' . esc_html($code ?: 'Femzykentltd Wears') . '</span>';
    echo '</div>';
}

function tw_handle_order_form() {
    if (!isset($_POST['tw_order_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['tw_order_nonce'])), 'tw_submit_order')) {
        wp_safe_redirect(home_url('/?order=failed'));
        exit;
    }

    $name = isset($_POST['full_name']) ? sanitize_text_field(wp_unslash($_POST['full_name'])) : '';
    $phone = isset($_POST['phone_number']) ? sanitize_text_field(wp_unslash($_POST['phone_number'])) : '';
    $shoe_code = isset($_POST['shoe_code']) ? sanitize_text_field(wp_unslash($_POST['shoe_code'])) : '';
    $shoe_size = isset($_POST['shoe_size']) ? sanitize_text_field(wp_unslash($_POST['shoe_size'])) : '';
    $quantity = isset($_POST['quantity']) ? max(1, absint(wp_unslash($_POST['quantity']))) : 0;
    $email = isset($_POST['email_address']) ? sanitize_email(wp_unslash($_POST['email_address'])) : '';
    $address = isset($_POST['full_address']) ? sanitize_textarea_field(wp_unslash($_POST['full_address'])) : '';
    $consent = isset($_POST['consent']) ? sanitize_text_field(wp_unslash($_POST['consent'])) : '';

    if (!$name || !$phone || !$shoe_code || !$shoe_size || !$quantity || $consent !== 'yes') {
        wp_safe_redirect(home_url('/?order=failed#buy'));
        exit;
    }

    $order_id = wp_insert_post([
        'post_type' => 'tw_order',
        'post_status' => 'private',
        'post_title' => $name . ' - ' . $shoe_code,
    ]);

    if ($order_id && !is_wp_error($order_id)) {
        update_post_meta($order_id, '_tw_order_name', $name);
        update_post_meta($order_id, '_tw_order_phone', $phone);
        update_post_meta($order_id, '_tw_order_shoe_code', $shoe_code);
        update_post_meta($order_id, '_tw_order_size', $shoe_size);
        update_post_meta($order_id, '_tw_order_quantity', $quantity);
        update_post_meta($order_id, '_tw_order_email', $email);
        update_post_meta($order_id, '_tw_order_address', $address);
        update_post_meta($order_id, '_tw_order_referrer', isset($_POST['current_url']) ? esc_url_raw(wp_unslash($_POST['current_url'])) : '');
    }

    $to = tw_get_option('support_email', get_option('admin_email'));
    $subject = sprintf('New %s Order: %s', tw_get_option('brand_name', 'Femzykentltd Wears'), $shoe_code);
    $message = "Name: {$name}\nPhone: {$phone}\nShoe Code: {$shoe_code}\nSize: {$shoe_size}\nQuantity: {$quantity}\nEmail: {$email}\nAddress: {$address}";
    wp_mail($to, $subject, $message);

    $thank_you_page_id = (int) get_option('tw_thank_you_page_id');
    $redirect_url = $thank_you_page_id ? get_permalink($thank_you_page_id) : home_url('/thank-you/');
    wp_safe_redirect($redirect_url ?: home_url('/thank-you/'));
    exit;
}
add_action('admin_post_nopriv_tw_submit_order', 'tw_handle_order_form');
add_action('admin_post_tw_submit_order', 'tw_handle_order_form');

function tw_brand_shortcode() {
    return esc_html(tw_get_option('brand_name', 'Femzykentltd Wears'));
}
add_shortcode('trend_wears_brand', 'tw_brand_shortcode');
