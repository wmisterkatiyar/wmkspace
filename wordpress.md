- write a post for every page section even for image or image with text
- write all posts of same page under a separate category
- create a page for every frontend page and write its all 
    code in separate template file i.e. page-id.php
- in page-id.php use multiple
    echo get_post_field('post_content', post_id);
- use looping 
    $q2 = new WP_Query( 'cat=1' );
    foreach($q2->posts as $post) 
        var_dump($post->post_content); // post object
-- WP_Query options:
    p/post, page_id/page, cat/category, post_type=page|any, posts_per_page=N|-1, offset=N(starting from), paged=N(page number)
    order=ASC|DESC, orderby=ID|date|name|rand, 
* we can query posts by type, why don't create a new type easily: write this stuff in theme's functions.php :) thats it.

    add_action( 'init', 'create_post_type' );
    function create_post_type() {
      register_post_type( 'my_product',
        array(
          'labels' => array(
            'name' => __( 'My Products' ),
            'singular_name' => __( 'Product' )
          ),
          'public' => true,
          'has_archive' => true,
          'taxonomies' => array('category'),
        )
      );
    }

* create child theme to speedup development
step1: create files : /wp-content/themes/twentyfifteen-child/functions.php,style.css
## style.css
/*
 Theme Name:   Twenty Fifteen Child
 Theme URI:    http://example.com/twenty-fifteen-child/
 Description:  Twenty Fifteen Child Theme
 Author:       MisterKatiyar
 Author URI:   http://example.com
 Template:     twentyfifteen
 Version:      1.0.0
 License:      GNU General Public License v2 or later
 License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 Tags:         light, dark, two-columns, right-sidebar, responsive-layout, accessibility-ready
 Text Domain:  twenty-fifteen-child
*/
## functions.php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
