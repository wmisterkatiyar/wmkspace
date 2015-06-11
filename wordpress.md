- in page-id.php use multiple
echo get_post_field('post_content', post_id);
- use looping 
$q2 = new WP_Query( 'cat=1' );
 foreach($q2->posts as $post) 
  var_dump($post->post_content); // post object
-- WP_Query options:
cat(category)
$q2 = new WP_Query( 'page_id=2' ); //page
foreach(#q->posts as $post) echo $post->content;
wp_query('cat=4');
wp_query( 'tag_id=13' );
