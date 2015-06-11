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
        )
      );
    }
