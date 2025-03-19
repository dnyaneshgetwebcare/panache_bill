<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Magnific Popup Gallery</h4>
      </div>
      <div class="card-body">
        <div class="row image-gallery">
          <?php foreach ($item_master as $item_details) { ?>
            <div class="card col-6 col-md-3 mb-4">
              <div class="card-body" style="padding:0; align-self: center;">
                <a href="<?= $item_details->imageurl; ?>">
                  <img src="<?= $item_details->imageurl; ?>" class="img-fluid" style="max-height: 200px;
											min-height: 200px; align-content: center">
                </a>
              </div>
              <div class="card-footer">
                <span class="text-bold text-center"> <?= $item_details->name;
                  ?> <button class="btn btn-icon"> <i class="fa fa-edit"></i></button>
                  <button class="btn btn-icon"> <i class="fa fa-eye"></i></button>
                </span>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="kai-admin-assets/js/core/jquery-3.7.1.min.js"></script>
<!--	<script src="kai-admin-assets/js/core/popper.min.js"></script>
	<script src="kai-admin-assets/js/core/bootstrap.min.js"></script>-->

<!-- jQuery Scrollbar -->
<!--	<script src="kai-admin-assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>-->  <!-- Magnific Popup -->
<script src="kai-admin-assets/js/plugin/jquery.magnific-popup/jquery.magnific-popup.min.js"></script>
<!-- Kaiadmin JS -->
<!--	<script src="kai-admin-assets/js/kaiadmin.min.js"></script>-->


<script>
  // This will create a single gallery from all elements that have class "gallery-item"
  $('.image-gallery').magnificPopup({
    delegate: 'a',
    type: 'image',
    removalDelay: 300,
    gallery: {
      enabled: true,
    },
    mainClass: 'mfp-with-zoom',
    zoom: {
      enabled: true,
      duration: 300,
      easing: 'ease-in-out',
      opener: function (openerElement) {
        return openerElement.is('img') ? openerElement : openerElement.find('img');
      }
    }
  });
</script>
