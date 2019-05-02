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

  wp_localize_script( 'formula-view', 'question_cnt', count( $questions ) + 2 );
?>

  <div class="formula-view-container">
    <div class="questions mb-5" style="display: none;">
      
      <?php foreach ( $questions as $question_idx => $question ): extract( $question ); ?>
          
        <div class="col-12 question-item <?php esc_attr_e( $option_type ) ?>" question-idx="<?php esc_attr_e( $question_idx + 1 )?>">
          <div class="row">
            <h1 class="text-center w-100 mb-5" style="font-weight: normal;"><?php _e( $question ) ?></h1>
          </div>

          <?php include 'templates/' . $option_type . '.php'; ?>
        
        </div>

      <?php endforeach; ?>
    
      <?php $last_question = get_field( 'last_question', $post->ID ); ?>

      <div class="col-12 question-item last-question" question-idx="<?php esc_attr_e( count( $questions ) + 1 )?>">

        <div class="row">
          <h1 class="text-center w-100 mb-5" style="font-weight: normal;"><?php _e( $last_question ) ?></h1>
        </div>

        <div class="row">          
          <div class="col-12 col-lg-4"><img class="m-auto" src="<?php esc_attr_e( plugin_dir_url( __FILE__ ) . 'assets/images/map.png' )?>"></div>
          
          <div class="col-12 col-lg-8">
            <div class="row flex-column">
              <div class="col-12 mb-3">
                <div class="row"><div class="col-12"><label>Postleitzahl:</label></div></div>
                
                <div class="row">
                  <div class="col-6 col-lg-3"><input type="text" name="zipcode"></div>
                  <div class="col-6"><i class="small">Für die Suche nach regionalen<br/>Telefonanlagen-Anbietern</i></div> 
                </div>              
                
              </div>

              <div class="col-12 text-center text-lg-left"><button type="button" class="btn btn-outline-primary px-5" disabled>&nbsp;Next&nbsp;</button></div>
            </div>
          </div>
        </div>

      </div>

      <?php $loading_screen_text = get_field( 'loading_screen_text', $post->ID ); ?>
      <div class="col-12 question-item loading-screen">

        <div class="row">
          <h1 class="text-center w-100" style="font-weight: normal;">Bitte haben Sie einen Augenblick Geduld.</h1>
        </div>

        <div class="row">
          <div class="w-100 p-md-5">
            <h2 class="font-weight-bold text-center" style="color: rgba(0,0,0,.35);"><i><?php _e( $loading_screen_text ) ?></i></h2>
          </div>

          <div class="w-100 p-md-5">
            <img class="m-auto" src="<?php esc_attr_e( plugin_dir_url( __FILE__ ) . 'assets/images/loading.gif' )?>">
          </div>
        </div>

      </div>

      <div class="col-12 question-item submit-screen">
        <?php $submit_screen = get_field( 'submit_screen', $post->ID ); ?>

        <div class="row">
          <h1 class="col-12 mb-0 mb-md-5 text-center" style="font-weight: normal; display: flex;">
            <div class="tick title"><?php _e( $submit_screen['title'] ) ?></div>
          </h1>
        </div>

        <div class="row">
          <div class="d-none d-md-block col-md-7">
            <div class="row content-container"><div class="content"><?php _e( $submit_screen['content'] ) ?></div></div>
            <div class="row px-0 px-lg-4 mx-0 mx-lg-4">
              <div class="col-12 col-9 col-lg-7 px-0 px-lg-3">
                <p class="small mb-0"><b>Unser Service:</b></p>
                <p class="small mb-0">- 100 % kostenlos & unverbindlich</p>
                <p class="small mb-0">- Keine Auftragspflicht</p>
                <p class="small mb-0">- Anbieterkontakt nur mit Ihrer Zustimmung</p>
              </div>

              <div class="col-12 col-3 col-lg-5 px-0 px-lg-3"><img class="mr-auto" src="<?php esc_attr_e( plugin_dir_url( __FILE__ ) . 'assets/images/logo.jpg' )?>"></div>
            </div>
          </div>

          <div class="col-12 col-md-5 pb-5">

            <form class="needs-validation" novalidate>
              <h4>Wer soll die Angebote erhalten?</h4>

              <fieldset>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="radio_herr" value="Herr" name="gender" checked>
                  <label class="form-check-label" for="radio_herr">Herr</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" id="radio_frau" value="Frau" name="gender">
                  <label class="form-check-label" for="radio_frau">Frau</label>
                </div>
              </fieldset>

              <fieldset>
                <div class="form-row inc-tooltip">
                  <div class="col-11 col-md mb-2 mb-md-0">
                    <input type="text" class="form-control" placeholder="Vorname" required>
                  </div>

                  <div class="col-11 col-md">
                    <input type="text" class="form-control" placeholder="Nachname" required>
                  </div>

                  <div>
                    <div class="description small">
                      <span class="d-block my-2"><b>Hinweise zum Ausfüllen:</b></span>
                      <span class="d-block my-2">Bitte achten Sie darauf, dass Vor- und Nachname nicht vertauscht sind. Der Vorname muss im ersten Feld stehen.</span>
                    </div>

                    <a class="d-block m-auto"><img src="<?php esc_attr_e( plugin_dir_url( __FILE__ ) . 'assets/images/question_icon.png' )?>"></a>
                  </div>
                </div>

                <div class="form-row inc-tooltip">
                  <div class="col-11 col-md">
                    <input type="text" class="form-control" placeholder="Telefonnummer" required>
                  </div>

                  <div>
                    <div class="description small">
                      <span class="d-block my-2"><b>Warum fragen wir das?</b></span>
                      <span class="d-block my-2">Wenn es Rückfragen zu Ihrer Anfrage gibt, sind diese am einfachsten telefonisch zu klären. Ihre Telefonnummer wird ausschließlich für Rückfragen zu dieser Anfrage genutzt. Eine automatische Weitergabe Ihrer Telefonnummer an die gefundenen Anbieter ist ausgeschlossen.</span>
                      <span class="d-block my-2"><b>Hinweise zum Ausfüllen:</b></span>
                      <span class="d-block my-2">Bitte verwenden Sie eine Telefonnummer, unter der Sie regelmäßig erreichbar sind und überprüfen Sie Ihre Eingabe auf Tippfehler.</span>
                    </div>
                    <a class="d-block m-auto"><img src="<?php esc_attr_e( plugin_dir_url( __FILE__ ) . 'assets/images/question_icon.png' )?>"></a>
                  </div>
                </div>

                <div class="form-row inc-tooltip">
                  <div class="col-11 col-md">
                    <input type="email" class="form-control" placeholder="E-Mail" required>
                  </div>

                  <div>
                    <div class="description small">
                      <span class="d-block my-2"><b>Warum fragen wir das?</b></span>
                      <span class="d-block my-2">Sie erhalten bis zu 3 Empfehlungen für passende Anbieter per E-Mail. Eine automatische Weitergabe Ihrer E-Mail-Adresse an die gefundenen Anbieter ist ausgeschlossen.</span>
                      <span class="d-block my-2"><b>Hinweise zum Ausfüllen:</b></span>
                      <span class="d-block my-2">Bitte verwenden Sie eine E-Mail-Adresse, die Sie regelmäßig abrufen und überprüfen Sie Ihre Eingabe auf Tippfehler</span>
                    </div>
                    <a class="d-block m-auto"><img src="<?php esc_attr_e( plugin_dir_url( __FILE__ ) . 'assets/images/question_icon.png' )?>"></a>
                  </div>
                </div>
              </fieldset>

              <div class="form-group">
                <p class="small information mb-0"><b>Neues Datenschutzgesetz ab dem 25. Mai 2018:</b> Wir haben die Anforderungen in Ihrem Interesse umgesetzt.</p>
              </div>

              <div class="form-group">
                <div class="form-check form-check-inline w-100 m-0 d-flex flex-column confirm">
                  <input class="form-check-input" type="checkbox" value="" id="check_confirm" required>
                  <span class="small">Datenschutz ist uns wichtig. Bitte bestätigen Sie.</span>
                  <label class="form-check-label small w-100" for="check_confirm">Ja, ich stimme den <a href="#">AGB</a> und der <a href="#">Datenschutzerklärung</a> zu. (Widerruf jederzeit möglich)</label>
                </div>
              </div>

              <button class="col-12" type="submit">
                <span>Anbieter vergleichen & sparen</span>
                <span class="small">kostenlos & unverbindlich</span>
              </button>
              
            </form>

          </div>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="progress w-100">
        <div class="progress-bar mb-0" style="width: 0%;"></div>
      </div>
    </div>
  </div>
<?php
} );