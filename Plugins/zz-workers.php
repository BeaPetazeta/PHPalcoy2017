<?php

/*
Plugin Name: Zz Workers
Description: Creación de un plugin para crear un Custom Post, Taxonomy, Custom Field, Shortcode y Widget.
Version: 20170316
Author: Bea_Petazeta
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
*/


//CREAR UN POST PERSONALIZADO

add_action( 
  //esta función se llevará a cabo al inicio y nos cargará la función que registrará un nuevo post personalizado
  'init', 
  'newcowp_register_custom_post_types' 
);

//esta funcion es la que empieza a revisar todos los post
function newcowp_register_custom_post_types() {
  //esta es la que crea el post personalizado
  register_post_type( 'trabajadores', array(
   //si fuera false no se veria en el panel de administración
    'public' => true,
    //es un array porque hay diferentes nombres que cambiar, el del panel, el de arriba de la pag, etc
    'labels' => array(
      'name' => 'Trabajadores',
      'add_new' => 'Alta nueva',
      'add_new_item' => 'Añadir nuevo trabajador',
      'searche_item' => 'Buscar empleado',
      ),
    'menu_icon' => 'dashicons-admin-users',
    //en el caso de que quisieramos poner que x es hijo de y, hace falta, sino false
    'hierarchical' => true,
    'supports' => array(
      'title', 
      'editor',
      //extracto
      'excerpt', 
      //imagen destacada
      'thumbnail', 
      'page-attributes')
    ));
}


//CREAR UNA TAXONOMIA

add_action( 'init', 'newcowp_define_department_taxonomy' );
function newcowp_define_department_taxonomy() {
  register_taxonomy(
    'ocupacion',
    'trabajadores',
    array(
      'hierarchical' => true,
      'label' => 'Ocupación',
      'query_var' => true,
      'rewrite' => true
    )
  );
}

//AGREGAR CAMPO PERSONALIZADO

add_action( 'init', 'newcowp_register_meta_fields' );
function newcowp_register_meta_fields() {
  register_meta( 'trabajadores', 'newcowp_ss', [
    'description' => 'Nº SS',
    'single' => true,
    'sanitize_callback' => 'sanitize_text_field',
    'auth_callback' => 'newcowp_custom_fields_auth_callback',
    'show_in_rest' => true
  ]);
}

add_action( 'add_meta_boxes', 'newcowp_meta_boxes' );
function newcowp_meta_boxes() {
  add_meta_box( 'newcowp-rrss-box', 'Nº SS', 'newcowp_meta_rrss_callback', 'trabajadores', 'side', 'high' );
}

function newcowp_meta_rrss_callback( $post ) {
  wp_nonce_field( 'newcowp_rrss_box', 'newcowp_rrss_box_noncename' );
    $post_meta = get_post_custom( $post->ID ); ?>
      <p>
      <label class="label" for="newcowp_ss">Número de afiliación:</label>
      <input name="newcowp_ss" id="newcowp_ss" type="text" value="<?php echo esc_attr( get_post_meta( $post->ID, 'newcowp_ss', true ) ); 
      ?>">
      </p><?php
}

add_action( 'save_post_trabajadores', 'newcowp_save_custom_fields' );
function newcowp_save_custom_fields( $post_id ){
  if (! isset( $_POST['newcowp_rrss_box_noncename']) || ! wp_verify_nonce( $_POST['newcowp_rrss_box_noncename'], 'newcowp_rrss_box' ) ) {
  return;
  }
  if ( isset( $_POST['newcowp_ss'] ) && $_POST['newcowp_ss'] != "" ) {
    update_post_meta( $post_id, 'newcowp_ss', $_POST['newcowp_ss'] );
  } else {
delete_post_meta( $post_id, 'newcowp_ss' );
}
}

//SHORTCODE que me muestra los trabajadores incluidos en el POST PERSONALIZADO

function newcowp_shortcode( $atts, $content=null ){
	$trabajadores = new WP_Query(['post_type' => 'trabajadores']);
	if($trabajadores->have_posts()){
		while($trabajadores->have_posts()){
			$trabajadores->the_post();
			echo the_title()."<br>";
		}
	}

}

add_shortcode( 'lista_trabajadores', 'newcowp_shortcode' );

//WIDGET

class newcowp_widget extends WP_Widget
{
	public function __construct()
	{
		$widget_details = array(
			'classname' => 'newcowp_widget',
			'description' => 'Solo un widget'
		);
		parent::__construct( 'newcowp_widget', 'Mi propio widget', $widget_details );
	}

	public function widget( $args, $instance ) {
		echo $args['before_widget'];
		echo $instance['title'];
		echo $args['after_widget'];
	}

	public function form( $instance ) {
		// Muestra el título o "New title" si no hay. esc_html "escapa" las posibles etiquetas HTML
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html( 'New title' );
		?>
			<p>
			<!-- el campo for del label debe coincidir con el id del input -->
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">Título:</label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr($title ); ?>"> <!-- variables: el id y nombre autogenerados para el campo input y el título asignado antes -->
			</p>
		<?php
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'newcowp_widget' );

});
