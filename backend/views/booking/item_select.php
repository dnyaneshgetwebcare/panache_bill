<div class="row">

  <div class="flex-wrap gap-2">
  <?php
  foreach ($item_category_list as $category) {
    ?>

    <span class="badge rounded-pill border border-primary text-primary pill-btn bg-white cat-badge" ><?=
      $category->name;
    ?></span>

  <?php
  }
  ?>
    </div>
  <?php
 // echo "<pre>"; print_r($item_master);die;
  foreach ($item_category_list as $category) {
    if(!isset($item_master[$category->id])){
      continue;
    }
    foreach ($item_type as $type) {
      if(!isset($item_master[$category->id][$type->id])){
      continue;
    }
      $items_list = $item_master[$category->id][$type->id];
  foreach ($items_list as $item) {
    if ($item['images']) {
                      $image_path = Yii::getAlias('@web') . '/uploads/' . $item['images'];
                    } else {
                      $image_path = Yii::getAlias('@web') . '/img/no-image.jpg';
                    }
    ?>

	<div class="col-2 col-sm-2">
		<label class="imagecheck mb-2">
			<input name="imagecheck" type="checkbox" value="<?= $item['id'] ?>>" class="imagecheck-input">
			<figure class="imagecheck-figure">
				<img src="<?= $image_path ?>" alt="title" class="imagecheck-image" style="height: 150px; width: 150px;
				min-height: 150px; min-width: 150px">
			</figure>
		</label>
	</div>
  <?php
    }
  }
  } ?>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on("click", ".cat-badge", function () {
      console.log("test")
        //$(this).toggleClass("active bg-dark text-white");
      $(this).addClass("bg-white text-black")
      $(this).removeClass("bg-primary")
    });
</script>