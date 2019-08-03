# Quiz_website_in_wordpress
Quiz website with multiple category in wordpress 
require get_template_directory() . '/template/admin_options.php';

/*  Register Session */
function register_session(){
    if( !session_id() )
        session_start();
}
add_action('init','register_session');

paste these code in your themes function.php file so it will manage admin options and session.
