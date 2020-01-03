<!-- [![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s) -->

# DESIGNfly

A Responsive WordPress theme.

## Getting Started

It adds a Custom Post Type **designfly_portfolio** and Custom Taxonomy and **designfly_categories**.
The sidebar is supported.

It has a settings page from which you can set currency and number of posts to show.

The structure of this theme is created from https://underscores.me/

This theme is internationalized and follow **css, JavaScript** and **PHP** coding standards. It uses **SASS** framework for css development.

It uses **WordPress phpcs, ESLint** and **Stylelint**.

### Installing

* Download zip of this repository.
* Goto wp-admin of your site.
* Click on **Appearance -> Themes** located in menu.
* Click on **Add New** and then **Upload Theme**.
* Upload the downloaded repository here.

After uploading, activate the theme from themes page.

## Usage Guidelines

It will add **Portfolios** menu on wp-admin. From here you can manage portfolio posts.

You can manage **Categories** from **Portfolio Categories** menu located under **Portfolios** menu.

This theme adds various widgets which can be used from **Appearance -> Widgets** page.

### DESIGNfly Portfolios Widget

This widget is used to show portfolios in the widget.

You can specify title and number of items to show from settings.

### DESIGNfly Posts Widget

This widget is used to show posts based on different scenarios.

Supported values of **Type of Posts**:
* **Related (to current post) Posts**: Shows related posts to current post. If this is not a single page then this widget won't be shown.
* **Recent Posts**: Shows recently created posts.
* **Popular Posts**: Shows most viewed posts.

You can also specify title and number of items to show.

### DESIGNfly Facebook Widget

This widget is used to show a particular Facebook page.

You can specify title and Facebook Application ID and Facebook Page Url.

The page url must be a valid url.

### DESIGNfly Twitter Widget

This widget is used to show the tweets.

You can specify title and number of tweets to show.

This theme adds a settings page named **DESIGNfly Twitter** from where you can configure your twitter account.

You can either manually set all settings field if you want to use custom Twitter Application.
Or you can click on **Log in to Twitter and get Access Token and Secret** button to get Access Token, Token Secret and Screen Name.

If you click on this button, the default consumer key and secret will be used. Also, it will overwrite existing access token and token secret.
