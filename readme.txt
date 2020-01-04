# DESIGNfly

A Responsive and Progressive ([PWA](https://developers.google.com/web/progressive-web-apps)) WordPress theme.

## Getting Started

It adds a Custom Post Type **designfly_portfolio** and Custom Taxonomy and **designfly_categories**.
The sidebar is supported.

It has a settings page from which you can set currency and number of posts to show.

The structure of this theme is created from https://underscores.me/

This theme is internationalized and follow **css, JavaScript** and **PHP** coding standards. It uses **SASS** framework for css development.

It uses **WordPress phpcs, ESLint** and **Stylelint**.

This theme supports PWA features like Offline User Experience. This theme provides PWA features for front-end pages only.

### Requirements to use PWA features.

* This theme is dependent upon [PWA WordPress plugin](https://wordpress.org/plugins/pwa/) developed by PWA Contributors. So make sure this is installed and activated.
* Make sure your site is running either on localhost or HTTPS (If the url contains https doesn't mean its using https, the first block of the url must turn green).
* If both above conditions are met, then it will install the service worker on the first load.

### How to use PWA features.

* From the second load, you can use Offline User Experience feature.
* When you visit a front-end side page, it will be cached along side images and css/js files of that page.
* So if your network gets disconnected you can still visit the pages you've visited.
* If you visit a page which is not cached, you'll see offline page instead.
* The number of pages cached will rely on the storage capacity your device have.

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
