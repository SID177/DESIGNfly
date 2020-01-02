<!-- [![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s) -->

# DESIGNfly

A Responsive WordPress theme.

## Getting Started

It adds a Custom Post Type **designfly_portfolio** and Custom Taxonomy and **designfly_categories**.
The sidebar is supported.

It has a settings page from which you can set currency and number of posts to show.

The structure of this theme is created from https://underscores.me/

This theme is internationalized and follows css, JavaScript and PHP coding standards. It uses SASS framework for css development.

It uses WordPress phpcs, ESLint and Stylelint.

### Installing

* Download zip of this repository.
* Goto wp-admin of your site.
* Click on **Appearance -> Themes** located in menu.
* Click on **Add New** and then **Upload Theme**.
* Upload the downloaded repository here.

After uploading, activate the theme from themes page.

## Usage Guidelines

It will add **Books** menu on wp-admin. From here you can manage book posts.

On edit post screen, you can set metadata from below the text editor.

You can set categories and tags of this book from Book Categories and Book Tags metaboxes.

### WP Book Widget

This plugin adds **WP Book Widget** which can be used from **Appearance -> Widgets** page.

You can specify title, category and number of items in the widget settings.

All the categories you created from Book Categories metabox will be shown under category dropdown.

### Shortcode

It supports a shortcode **[wp-book]**. Supported attributes are id, author_name, year, category, tag, and publisher. The slug of the category and tag needs to be specified here.

```
[wp-book category="novel" publisher="John Newman"]
```

