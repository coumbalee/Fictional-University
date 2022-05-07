<?php 
get_header(); 
page_banner(array(
  'title'=>'Our campuses',
  'subtitle'=>'We have several conveniently located campuses. '
));
?>
<div class="container container--narrow page-section">
    <ul class="link-list min-list">
  <?php 
  while(have_posts()){
    the_post();?>
  <li><a href="<?php the_permalink();?>"><?php the_title(); ?></a></li>
  <?php }
echo paginate_links();
  ?>
  </ul>

<?php get_footer();


?>