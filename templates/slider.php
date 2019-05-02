<?php $sliderID = uniqid(); ?>

<div class="row my-5 pb-5 pb-lg-0">
  <div class="col-12 col-lg-4 mb-5 pb-5 mb-lg-0 pb-lg-0">
    <img class="m-auto" src="<?php esc_attr_e( $image_url )?>">
  </div>

  <div class="col-12 col-lg-8">
    <div class="row flex-column h-100">
      <div class="w-80 m-auto">
        <div id="slider-<?php esc_attr_e( $sliderID )?>"></div>

        <div class="values">
          <div class="col-6 min-value text-left px-0">&le; <?php esc_html_e( $min_value ) ?> m<sup>2</sup></div>
          <div class="col-6 max-value text-right px-0">&ge; <?php esc_html_e( $max_value ) ?> m<sup>2</sup></div>
        </div>
      </div>

    </div>
  </div>

</div>

<div class="row">
  <div class="col-12 col-lg-4 hidden-sm-down"></div>
  <div class="col-12 col-lg-8">
    <div class="row">
      <div class="col-12 col-md-8 mr-auto mb-3 mb-md-0" style="display: flex; align-items: center;">
        <label class="mr-5 my-0" for="input-<?php esc_attr_e( $sliderID )?>">Alternativ:<br/>genaue Angabe </label>
        <input id="input-<?php esc_attr_e( $sliderID )?>" value="<?php esc_attr_e( $min_value ) ?>" type="number" min="<?php esc_attr_e( $min_value ) ?>" max="<?php esc_attr_e( $max_value )?>">
        <span class="ml-1"> m<sup>2</sup></span>
      </div>
      
      <div class="col-12 col-md-4 ml-auto text-center text-md-right">
        <button type="button" class="btn btn-outline-primary px-5">&nbsp;Next&nbsp;</button>
      </div>
    </div>
  </div>
</div>

<script>
  jQuery(document).ready(function() {
    jQuery("#slider-<?php esc_attr_e( $sliderID )?>").slider({
      range: "min",
      min: <?php esc_attr_e( $min_value )?>,
      max: <?php esc_attr_e( $max_value )?>,
      create: function() {
        var value_html = "<span class=\"value\">";

        if ( jQuery( this ).slider( "value" ) <= <?php esc_attr_e( $min_value ) ?> ) {
          value_html += "&le;";
        } else if ( jQuery( this ).slider( "value" ) >= <?php esc_attr_e( $max_value ) ?> ) {
          value_html += "&ge;";
        }

        value_html += "&nbsp;" + jQuery( this ).slider( "value" ) + " m<sup>2</sup></span>"

        jQuery("#slider-<?php esc_attr_e( $sliderID )?> .ui-slider-handle").html( value_html );
      },
      slide: function( event, ui ) {
        var value_html = "<span class=\"value\">";

        if ( ui.value <= <?php esc_attr_e( $min_value ) ?> ) {
          value_html += "&le;";
        } else if ( ui.value >= <?php esc_attr_e( $max_value ) ?> ) {
          value_html += "&ge;";
        }

        value_html += "&nbsp;" + ui.value + " m<sup>2</sup></span>"

        jQuery("#slider-<?php esc_attr_e( $sliderID )?> .ui-slider-handle").html( value_html );

        var question_tag = jQuery(this).parents(".question-item.slider")[0];
        jQuery(question_tag).find("input[id^=input]").val(ui.value);
      }
    });

    jQuery("input#input-<?php esc_attr_e( $sliderID )?>").change(function() {
      if ( jQuery(this).val() < <?php esc_attr_e( $min_value ) ?> ) {
        jQuery(this).val(<?php esc_attr_e( $min_value )?>)
      } else if ( jQuery(this).val() > <?php esc_attr_e( $max_value ) ?> ) {
        jQuery(this).val(<?php esc_attr_e( $max_value )?>)
      }
      
      jQuery("#slider-<?php esc_attr_e( $sliderID )?>").slider( "value", jQuery(this).val() );

      var value_html = "<span class=\"value\">";

      if ( jQuery(this).val() <= <?php esc_attr_e( $min_value ) ?> ) {
        value_html += "&le;";
      } else if ( jQuery(this).val() >= <?php esc_attr_e( $max_value ) ?> ) {
        value_html += "&ge;";
      }

      value_html += "&nbsp;" + jQuery(this).val() + " m<sup>2</sup></span>"

      jQuery("#slider-<?php esc_attr_e( $sliderID )?> .ui-slider-handle").html( value_html );
    });
  });
</script>