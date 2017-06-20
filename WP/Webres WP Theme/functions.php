<?php
/***************************************** CSS & JS FILES ***********************************************/ 
function wp_theme_styles(){
	// wp_enqueue_style( 'normalize_css', get_template_directory_uri() . '/css/normalize.css' );
	// wp_enqueue_style( 'bootstrap_css', get_template_directory_uri() . '/css/bootstrap.css' );
	// wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css' );
	wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'googlefont_css', 'https://fonts.googleapis.com/css?family=Raleway:400,700,300' );
	wp_enqueue_style( 'googlefont_css', 'https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100,900"' );
}
add_action( 'wp_enqueue_scripts', 'wp_theme_styles' );

function wp_theme_js(){
	wp_enqueue_script('modernizr_js', get_template_directory_uri() . '/js/modernizr.js', array('jquery'), '', true );
	wp_enqueue_script('main_js', get_template_directory_uri() . '/js/app.js', '', '', false );
	 wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.js', '', '', true );
}
add_action( 'wp_enqueue_scripts', 'wp_theme_js' );

/**************************************** CSS & JS FUNCTIONS ***********************************************/

/***************************************** WIDGET FUNCTIONS ***********************************************/
function dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Theme Support', 'custom_dashboard_help');
}
add_action('wp_dashboard_setup', 'dashboard_widgets');

function default_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'WebResStudio' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'WebResStudio' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'default_widgets_init' );

function right_widgets_init() {

	register_sidebar( array(
		'name'          => 'Right Sidebar',
		'id'            => 'home_right',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'right_widgets_init' );

function execute_php($html){
     if(strpos($html,"<"."?php")!==false){
          ob_start();
          eval("?".">".$html);
          $html=ob_get_contents();
          ob_end_clean();
     }
     return $html;
}
add_filter('widget_text','execute_php',100);

function try_php($html){
     $html = "prueba";
     return $html;
}
add_filter('widget_text_home_right','try_php',100);

function remove_menus(){
	 
$cu = wp_get_current_user();
	if ($cu->has_cap('administrator')) {
  
		// remove_menu_page( 'index.php' );                  //Dashboard
		// remove_menu_page( 'edit.php' );                   //Posts
		// remove_menu_page( 'upload.php' );                 //Media
		// remove_menu_page( 'edit.php?post_type=page' );    //Pages
		// remove_menu_page( 'edit-comments.php' );          //Comments
		// remove_menu_page( 'themes.php' );                 //Appearance
		// remove_menu_page( 'plugins.php' );                //Plugins
		// remove_menu_page( 'users.php' );                  //Users
		// remove_menu_page( 'tools.php' );                  //Tools
		// remove_menu_page( 'options-general.php' );        //Settings
  	}
}
add_action( 'admin_menu', 'remove_menus' );

function my_function_admin_bar(){
	$cu = wp_get_current_user();
	if ($cu->has_cap('administrator')) {
		return true;
	}
}
add_filter( 'show_admin_bar' , 'my_function_admin_bar');

/***************************************** WIDGET FUNCTIONS ***********************************************/


/************************************* LOGIN/LOGOUT FUNCTIONS ***********************************************/
// function my_logout_url( $redirect_to ) {
//     return home_url('error-page');
// }
// add_filter( 'logout_url', 'my_logout_url' );

// function my_login_url( $url ) {
// 	//$redirect_to = '?redirect_to=' . get_permalink();
// 	$redirect_to = '?redirect_to=' .home_url('/user-dashboard/ ');
// 	//return home_url(). $redirect_to;
// 	return wp_redirect( home_url('sample-page') );
// }
// add_filter( 'login_url', 'my_login_url', 10, 3 );

// global $user;
function my_login_redirect( $redirect_to, $request, $user ) {
	//is there a user to check?
	global $user;
	if ( isset( $user->roles ) && is_array( $user->roles ) ) {
		//check for admins
		if ( in_array( 'administrator', $user->roles ) ) {
			// redirect them to the default place
			$redirect_to = '/wp-admin/';
			return $redirect_to;
		} else {
			return home_url('/user-dashboard/');
		}
	} else {
		return home_url('/user-registration/');
	}
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );


// global $user;
// function my_login_redirect( $url, $request, $user ){
//     if( $user && is_object( $user ) && is_a( $user, 'WP_User' ) ) {
//         if( $user->has_cap( 'administrator' ) ) {
//             //$url = admin_url();
//         	$url = home_url('/private-dashboard/');
//         } else {
//             $url = home_url('/');
//         }
//     }
//     return $url;
// }
// add_filter('login_redirect', 'my_login_redirect', 10, 3 );



// function wp_loginout_main_menu( $menu ) {
// 	if (is_user_logged_in()) {
// 	    $loginout = wp_loginout($_SERVER['REQUEST_URI'], false );
// 	    $menu .= $loginout;
// 	    return $menu;
// 	   } else {
// 	   	$loginout = wp_loginout($_SERVER['REQUEST_URI'].'/dashboard-page'.wp_get_current_user()->ID, false );
// 	    $menu .= $loginout;
// 	    return $menu;
// 	   }
// }
// add_filter( 'wp_nav_menu','wp_loginout_main_menu' );

/************************************* LOGIN/LOGOUT FUNCTIONS ***********************************************/




?>