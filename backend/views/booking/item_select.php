<div class="row">
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
				<img src="<?= $image_path ?>" alt="title" class="imagecheck-image" style="height: 150px; width: 150px">
			</figure>
		</label>
	</div>
  <?php
    }
  }
  } ?>

</div>