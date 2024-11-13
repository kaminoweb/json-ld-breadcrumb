<?php
/**
 * Plugin Name: Breadcrumb JSON-LD Generator
 * Plugin URI: https://kaminoweb.com/
 * Description: Automatically generates a JSON-LD breadcrumb schema and saves it to a custom field for better SEO.
 * Version: 1.6
 * Author: KAMINOWEB INC
 * Author URI: https://kaminoweb.com/
 * License: GPL-3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: breadcrumb-json-ld-generator
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Breadcrumb_JSON_LD_Generator {

    // Initialize the plugin
    public function __construct() {
        add_action('save_post', array($this, 'generate_and_save_breadcrumb_json_ld'), 10, 3);
        add_action('wp_head', array($this, 'add_breadcrumb_json_ld_to_head'));
    }

    // Generate and save the breadcrumb JSON-LD schema
    public function generate_and_save_breadcrumb_json_ld($post_id, $post, $update) {
        // Check if the post is of type 'post' and not an autosave
        if ('post' !== $post->post_type || defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        // Generate the breadcrumb JSON-LD
        $breadcrumb_json_ld = $this->generate_breadcrumb_json_ld($post);

        // Update or insert the custom field
        update_post_meta($post_id, 'breadcrumb-JSON-LD', $breadcrumb_json_ld);
    }

    // Generate the breadcrumb JSON-LD content
    private function generate_breadcrumb_json_ld($post) {
        // Get the site URL
        $site_url = get_site_url();

        // Get the post categories
        $categories = get_the_category($post->ID);

        // If no categories, return an empty array
        if (empty($categories)) {
            return '';
        }

        // Assume the first category as the main category for breadcrumb
        $category = $categories[0];

        // Get the post title and slug
        $post_title = get_the_title($post->ID);
        $post_slug = $post->post_name;

        // Generate the category URL
        $category_url = $site_url . '/' . $category->slug;

        // Ensure no double slashes in the category URL
        $category_url = rtrim($category_url, '/');

        // Check if the post slug is available, otherwise generate it from the post title
        if (empty($post_slug)) {
            $post_slug = sanitize_title($post_title);
        }

        // Try to get the post URL using get_permalink()
        $post_url = get_permalink($post->ID);

        // If get_permalink() is returning the query-based URL (e.g., ?p=ID), manually build the URL
        if (strpos($post_url, '?p=') !== false || empty($post_slug)) {
            // If the slug is missing, we generate it from the post title
            $post_url = $site_url . '/' . $category->slug . '/' . $post_slug . '/';
        }

        // Ensure no double slashes in the post URL
        $post_url = rtrim($post_url, '/');

        // Generate the breadcrumb JSON-LD structure
        $breadcrumb_json_ld = array(
            "@context" => "https://schema.org",
            "@type" => "BreadcrumbList",
            "itemListElement" => array(
                array(
                    "@type" => "ListItem",
                    "position" => 1,
                    "name" => "Home",
                    "item" => $site_url . "/"
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 2,
                    "name" => $category->name,
                    "item" => $category_url . "/"
                ),
                array(
                    "@type" => "ListItem",
                    "position" => 3,
                    "name" => $post_title,
                    "item" => $post_url // Correctly formatted post URL
                ),
            ),
        );

        // Convert the PHP array to a JSON-LD string
        return json_encode($breadcrumb_json_ld, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    // Output the breadcrumb JSON-LD in the <head> section
    public function add_breadcrumb_json_ld_to_head() {
        if (is_single()) {
            $json_ld = get_post_meta(get_the_ID(), 'breadcrumb-JSON-LD', true);
            if ($json_ld) {
                echo '
                <script type="application/ld+json">' . $json_ld . '</script>
                ';
            }
        }
    }
}

// Instantiate the class
new Breadcrumb_JSON_LD_Generator();


