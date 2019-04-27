<?php
/**
* Plugin Name: Formula Plugin for Verwaltung24
* Description: This plugin is for only Verwaltung24.
* Version: 1.0
**/

if( !class_exists('acf') ) {
  return;
}

add_action( 'wp_enqueue_scripts', function() {
  wp_register_style( 'bootstrap-4-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
  wp_register_script( 'popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', ['jquery'], true );
  wp_register_script( 'bootstrap-4-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['popper-js'], '4.0.0', true );

  wp_register_style( 'formula-view-css', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', ['bootstrap-4-css'] );
  wp_register_script( 'formula-view-js', plugin_dir_url( __FILE__ ) . 'assets/js/scripts.js', ['bootstrap-4-js'], '1.0.0', true );
} );

add_shortcode( 'formula-view', function( $atts ) {
  wp_enqueue_style( 'formula-view-css' );
  wp_enqueue_script( 'formula-view-js' );

  global $post;

  $questions = get_field( 'formula_steps', $post->ID );

?>

  <div class="formula-view-container">
    <div class="carousel slide mb-5" data-ride="carousel">
      <div class="carousel-inner">
        
        <?php foreach ( $questions as $step_idx => $question ): extract( $question ); ?>
            
          <div class="carousel-item <?php esc_attr_e( $option_type ) ?> <?php esc_attr_e( $step_idx == 0 ? 'active' : '' ) ?>">
            <div class="row">
              <h1 class="text-center w-100 mb-5"><?php esc_html_e( $question ) ?></h2>
            </div>

            <?php include 'templates/' . $option_type . '.php'; ?>
          
          </div>

        <?php endforeach; ?>

      </div>
    </div>

    <div class="row">
      <div class="progress w-100">
        <div class="progress-bar mb-0" style="width: 75%;"></div>
      </div>
    </div>
  </div>
<?php
} );