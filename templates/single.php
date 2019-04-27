<div class="row">
  
  <?php foreach ( $options as $option ): extract( $option );?>
    
    <div class="col-6 col-md-2 mx-auto">
      <div class="card mx-1">
        <img class="card-img-top p-4" src="<?php esc_attr_e( $image_url ) ?>">
        
        <div class="card-body">
          <h5 class="card-title text-center my-0"><?php esc_html_e( $option ) ?></h5>
        </div>

      </div>
    </div>

  <?php endforeach; ?>

</div>