# Breadcrumb JSON-LD Generator

**Contributors:** KAMINOWEB INC  
**Tags:** SEO, JSON-LD, breadcrumbs, structured data, schema  
**Requires at least:** 5.0  
**Tested up to:** 6.7  
**Stable tag:** 1.6  
**License:** GNU General Public License v3.0  
**License URI:** https://www.gnu.org/licenses/gpl-3.0.html

Automatically generates a **JSON-LD** breadcrumb schema and saves it to a custom field for better SEO.

## Description

The **Breadcrumb JSON-LD Generator** plugin for WordPress automatically generates a **JSON-LD** breadcrumb schema for each blog post and stores it in a custom field for improved SEO. Breadcrumbs help search engines and users navigate your site more easily, and this plugin makes it easy to implement structured data for breadcrumbs without needing to manually code them.

### Key Features:

- **Automatic Breadcrumb JSON-LD Generation**: Automatically generates a structured breadcrumb for posts.
- **Custom Field Storage**: Saves the generated JSON-LD schema in a custom field (`breadcrumb-JSON-LD`).
- **SEO Optimization**: Helps improve SEO by adding structured data in the form of JSON-LD for breadcrumbs.
- **Category-Based Breadcrumbs**: Uses the post’s category as part of the breadcrumb structure.
- **Easy Integration**: Works seamlessly with your theme and requires no extra setup.

## Installation

### 1. Upload the Plugin:

- Download the **Breadcrumb JSON-LD Generator** plugin from GitHub.
- Upload the `breadcrumb-json-ld-generator` folder to the `/wp-content/plugins/` directory on your WordPress installation.

### 2. Activate the Plugin:

- Go to the **Plugins** menu in WordPress and click **Activate** under the **Breadcrumb JSON-LD Generator** plugin.

### 3. Using the Plugin:

- The plugin automatically generates the breadcrumb JSON-LD schema and saves it to a custom field (`breadcrumb-JSON-LD`) when a post is saved.
- You can use this custom field in your theme or with other plugins to display the breadcrumb data as needed.

## Frequently Asked Questions

### How does the plugin generate the breadcrumb JSON-LD schema?

The plugin automatically generates a breadcrumb structured data for each post by collecting details like the post title, category, and URL. This is then saved in the custom field `breadcrumb-JSON-LD` for each post.

### Can I customize the breadcrumb structure?

The breadcrumb structure is based on the post’s category and title, but you can customize it by modifying the plugin’s code. It is designed to be flexible and can be easily extended for more complex breadcrumb structures.

### Does the plugin require any external API or service?

No, the plugin does not require an external API or service. It generates the breadcrumb schema based solely on the data available within WordPress.

### Where is the JSON-LD schema stored?

The generated breadcrumb schema is stored as a custom field with the key `breadcrumb-JSON-LD`. You can access it using standard WordPress functions for custom fields (e.g., `get_post_meta()`).

## Changelog

### 1.6
- Minor improvements to URL generation and schema structure.
- Ensured compatibility with newer versions of WordPress.

### 1.5
- Fixed issues with breadcrumb URL generation when slugs are missing.
  
### 1.0
- Initial release of the plugin.

