<?php
if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php $tw_contact_page = get_page_by_path('contact'); ?>
<header class="site-header">
    <div class="site-container topbar">
        <div class="topbar-pill"><?php echo esc_html(tw_get_option('announcement_left')); ?></div>
        <div class="topbar-pill"><?php echo esc_html(tw_get_option('announcement_right')); ?></div>
        <div class="topbar-pill topbar-pill-strong">Call: <?php echo esc_html(tw_get_option('support_phone')); ?></div>
    </div>
    <div class="site-container navbar">
        <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
            <span class="brand-stack">
                <span class="brand-overline">Premium Footwear</span>
                <span class="brand-name"><?php echo esc_html(tw_get_option('brand_name')); ?></span>
            </span>
        </a>
        <nav class="nav-links" aria-label="Primary">
            <a href="#top-picks">Top Picks</a>
            <a href="#offer">Offer</a>
            <a href="#buy">Order</a>
            <a href="<?php echo esc_url($tw_contact_page ? get_permalink($tw_contact_page) : home_url('/contact/')); ?>">Contact</a>
        </nav>
        <a class="header-cta" href="#buy">Order Premium Picks</a>
    </div>
</header>
<main class="site-main">
