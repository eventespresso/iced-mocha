<?php
/*
 * Theme hooks
 *
 * @package iced_mocha
 * @subpackage Functions
 */

/**
 * HEADER.PHP HOOKS
*/

// Before wp_head hook
function espresso_theme_header_hook() {
    do_action('espresso_theme_header_hook');
}
// Meta hook
function espresso_theme_meta_hook() {
    do_action('espresso_theme_meta_hook');
}

// Before wrapper
function espresso_theme_body_hook() {
    do_action('espresso_theme_body_hook');
}

// Inside wrapper
function espresso_theme_wrapper_hook() {
    do_action('espresso_theme_wrapper_hook');
}

// Topbar
function espresso_theme_topbar_hook() {
    do_action('espresso_theme_topbar_hook');
}

// Before masthead
function espresso_theme_masthead_hook() {
    do_action('espresso_theme_masthead_hook');
}

// Inside branding
function espresso_theme_branding_hook() {
    do_action('espresso_theme_branding_hook');
}

// Inside header for widgets
function espresso_theme_header_widgets_hook() {
    do_action('espresso_theme_header_widgets_hook');
}

// Inside access
function espresso_theme_access_hook() {
    do_action('espresso_theme_access_hook');
}

// Inside main
function espresso_theme_main_hook() {
    do_action('espresso_theme_main_hook');
}

// Inside forbottom
function espresso_theme_forbottom_hook() {
    do_action('espresso_theme_forbottom_hook');
}

// Breadcrumbs
function espresso_theme_breadcrumbs_hook() {
    do_action('espresso_theme_breadcrumbs_hook');
}

/**
 * FOOTER.PHP HOOKS
*/

// Footer hook
function espresso_theme_footer_hook() {
    do_action('espresso_theme_footer_hook');
}


/**
 * COMMENTS.PHP HOOKS
*/

// Before comments hook
function espresso_theme_before_comments_hook() {
    do_action('espresso_theme_before_comments_hook');
}

// Actual comments hook
function espresso_theme_comments_hook() {
    do_action('espresso_theme_comments_hook');
}

// After comments hook
function espresso_theme_after_comments_hook() {
    do_action('espresso_theme_after_comments_hook');
}

// No comments hook
function espresso_theme_nocomments_hook() {
    do_action('espresso_theme_nocomments_hook');
}


/**
 * SIDEBAR.PHP HOOKS
*/

// No comments hook
function espresso_theme_before_primary_widgets_hook() {
    do_action('espresso_theme_before_primary_widgets_hook');
}

// No comments hook
function espresso_theme_after_primary_widgets_hook() {
    do_action('espresso_theme_after_primary_widgets_hook');
}

// No comments hook
function espresso_theme_before_secondary_widgets_hook() {
    do_action('espresso_theme_before_secondary_widgets_hook');
}

// No comments hook
function espresso_theme_after_secondary_widgets_hook() {
    do_action('espresso_theme_after_secondary_widgets_hook');
}

/**
 * LOOP.PHP HOOKS
*/

// Before each article hook
function espresso_theme_before_article_hook() {
    do_action('espresso_theme_before_article_hook');
}

// After each article hook
function espresso_theme_after_article_hook() {
    do_action('espresso_theme_after_article_hook');
}

// After each article title
function espresso_theme_post_title_hook() {
    do_action('espresso_theme_post_title_hook');
}

// After each post meta
function espresso_theme_post_meta_hook() {
    do_action('espresso_theme_post_meta_hook');
}

// Before the actual post content
function espresso_theme_post_before_content_hook() {
    do_action('espresso_theme_post_before_content_hook');
}

// After the actual post content
function espresso_theme_post_after_content_hook() {
    do_action('espresso_theme_post_after_content_hook');
}

// After the actual post content
function espresso_theme_post_footer_hook() {
    do_action('espresso_theme_post_footer_hook');
}

//Content hooks

function espresso_theme_before_content_hook() {
    do_action('espresso_theme_before_content_hook');
}

function espresso_theme_after_content_hook() {
    do_action('espresso_theme_after_content_hook');
}
?>