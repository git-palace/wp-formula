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
  wp_enqueue_style( 'slick-slider', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css' );
  wp_enqueue_script( 'slick-slider', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', ['jquery', 'jquery-migrate'], '1.8.1', true );
  
  wp_register_style( 'bootstrap-4', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
  wp_register_script( 'popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', ['jquery'], true );
  wp_register_script( 'bootstrap-4', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', ['popper'], '4.0.0', true );
  
  wp_register_style( 'jquery-ui', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css' );
  wp_register_style( 'formula-view', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', ['jquery-ui', 'bootstrap-4'] );
  wp_register_script( 'formula-view', plugin_dir_url( __FILE__ ) . 'assets/js/scripts.js', ['slick-slider', 'jquery-ui-core', 'jquery-ui-slider', 'bootstrap-4'], '1.0.0', true );
} );

add_shortcode( 'formula-view', function( $atts ) {
  wp_enqueue_style( 'formula-view' );
  wp_enqueue_script( 'formula-view' );

  global $post;

  $questions = get_field( 'formula_steps', $post->ID );

  wp_localize_script( 'formula-view', 'question_cnt', count( $questions ) );
?>

  <div class="formula-view-container">
    <div class="questions mb-5" style="display: none;">
      
      <?php foreach ( $questions as $question_idx => $question ): extract( $question ); ?>
          
        <div class="col-12 question-item <?php esc_attr_e( $option_type ) ?>" question-idx="<?php esc_attr_e( $question_idx + 1 )?>">
          <div class="row">
            <h1 class="text-center w-100 mb-5"><?php esc_html_e( $question ) ?></h2>
          </div>

          <?php include 'templates/' . $option_type . '.php'; ?>
        
        </div>

      <?php endforeach; ?>

    </div>

    <div class="row">
      <div class="progress w-100">
        <div class="progress-bar mb-0" style="width: 0%;"></div>
      </div>
    </div>
  </div>
<?php
} );