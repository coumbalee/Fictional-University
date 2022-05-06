<?php 
function page_banner($args){
    if(!$args['title']){
     get_the_title();
     $args['title'] = get_the_title();
    }

?>
<div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php $pageBannerImage = get_field('page_banner_background_image'); echo $pageBannerImage['sizes']['pageBanner']?>)"></div>
      <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
        <div class="page-banner__intro">
          <p><?php  the_field('page_banner_subtitle');?></p>
        </div>
      </div>
    </div>
<?php }


function university_files(){
    wp_enqueue_script('main_university_js', get_theme_file_uri('/build/index.js'),array('jquery'),'1.0',true);
    wp_enqueue_style('custom-google-font','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('university_main_styles',get_theme_file_uri('/build/style-index.css'));
    wp_enqueue_style('university_extra_styles',get_theme_file_uri('/build/index.css'));

}
// fonction wordpress qui prend 2 arguments : 1 fonction wordpress et une que l' on crée nous même
add_action('wp_enqueue_scripts','university_files');

function university_features(){
    // à mettre seulement si on veut créer des menus dynamiques gérables par wordpress
// register_nav_menu('headerMenuLocation','Header Menu Location');
// register_nav_menu('footerLocationOne','Footer Location  One');
// register_nav_menu('footerLocationTwo','Footer Location  Two');


add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_image_size('professorLandscape',400, 260,true);
add_image_size('professorPortrait',480, 650,true);
add_image_size('pageBanner',1500, 350,true);




}
add_action('after_setup_theme','university_features');

//fonction avec l' objet query de wordpress en paramètre
function university_adjust_queries($query){

    if(!is_admin() AND is_post_type_archive('program') AND is_main_query() ){
    $query->set('orderby','title');
    $query->set('order','ASC');
    $query->set('posts_per_page',-1);
    }

    // seulement si o est dans le front end et dans l' archive event et si la méthode is main query de l' objet query est = true
    if(!is_admin()AND is_post_type_archive('event') AND $query->is_main_query()){
        $today = date('Ymd');
        // le 1er argument est celui qu' on cible et le second est la valeur qu on lui donne
        $query->set('meta_key','event_date');
        $query->set('orderby','meta_value_num');
        $query->set('order','ASC');
        $query->set('meta_query', array(
            array(
             'key'=> 'event_date',
             'compare'=> '>=',
             'value'=> $today,
             'type'=> 'numeric'
            )
          ));


    }

}
add_action('pre_get_posts','university_adjust_queries');
