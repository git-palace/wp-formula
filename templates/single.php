<div class="row my-5">
  
<?php $custom_class = count( $options ) > 4 ? 'col-md' : 'col-md-3'; ?>

  <?php foreach ( $options as $option ): extract( $option );?>
    
    <div class="col-6 <?php esc_attr_e( $custom_class ) ?> mx-auto">
      <div class="card mx-1 h-100">
        <img class="card-img-top p-4" src="<?php esc_attr_e( $image_url ) ?>">
        
        <div class="card-body">
          <h5 class="card-title text-center my-0"><?php esc_html_e( $option ) ?></h5>
        </div>

      </div>
    </div>

  <?php endforeach; ?>

</div>

<div class="row invisible">
  <button type="button" class="my-3 mx-auto btn btn-outline-primary px-5" disabled>&nbsp;Next&nbsp;</button>
</div>