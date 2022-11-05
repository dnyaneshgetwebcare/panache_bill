<div id="img_list">
    <div class="row">
        <div class="table-responsive m-t-20 col-lg-10">
            <table class="table  full-info-table ">
                <thead>
                <th>ID</th>
                <th>Image</th>
                <th>Default</th>
                <th>Action</th>

                </thead>
                <?php $i = 1;

                foreach ($img_list as $img_details) {
                    if ($img_details['img_name']) {
                        $image_path = Yii::getAlias('@web') . '/uploads/' . $img_details['images'];


                    } else {
                        $image_path = Yii::getAlias('@web') . '/img/no-image.jpg';
                    }
                    ?>
                    <tr>
                        <td>
                            <?= $i; ?>
                        </td>
                        <td>
                            <img src="<?= $image_path; ?>">
                        </td>
                        <td>
                            <input type="checkbox">
                        </td>
                        <td>
                            <button class="btn button btn-delete" id="delete_<?= $img_details['id']; ?>">Delete</button>
                        </td>

                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>