<div id="img_list">

    <div class="row">
        <div class="table-responsive m-t-20 col-lg-10">
            <?php $i = 1;

            foreach ($img_list as $img_details) {
                if ($img_details['img_name']) {
                    $image_path = Yii::getAlias('@web') . '/uploads/' . $img_details['img_name'];


                } else {
                    $image_path = Yii::getAlias('@web') . '/img/no-image.jpg';
                }
                ?>
                <div class="col-4 col-lg-4 grid">
                    <div class="card">
                        <div class="card-body">
                            <a class="image-popup-vertical-fit" href="<?= $image_path; ?>" >
                            <img src="<?= $image_path; ?>" style="width: 230px;height: 250px">
                                </a>
                            <div class="row m-t-10 m-l-5">
                                <?php if ($img_details['default_image'] != 1) { ?>
                                    <button class="btn button btn-delete btn-info btn-outline-info"
                                            onclick="changeimagestatus('change',<?= $img_details['id'] ?>)"
                                            id="delete_<?= $img_details['id']; ?>">Set Default
                                    </button>
                                <?php } else {

                                    echo '<span class="text-bold text-info" style="font-size: medium"> Default</span>';
                                }
                                ?>

                                <div class=" m-l-40">
                                <button class="btn button btn-delete btn-info btn-outline-red"
                                        onclick="changeimagestatus('delete',<?= $img_details['id'] ?>)"
                                        id="delete_<?= $img_details['id']; ?>"><i class="mdi mdi-delete"></i>
                                </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!--<table class="table  full-info-table ">
                <thead>
                <th>ID</th>
                <th>Image</th>
                <th>Default</th>
                <th>Action</th>

                </thead>
                <?php /*$i = 1;

                foreach ($img_list as $img_details) {
                    if ($img_details['img_name']) {
                        $image_path = Yii::getAlias('@web') . '/uploads/' . $img_details['img_name'];


                    } else {
                        $image_path = Yii::getAlias('@web') . '/img/no-image.jpg';
                    }
                    */ ?>
                    <tr>
                        <td>
                            <? /*= $i; */ ?>
                        </td>
                        <td>
                            <img src="<? /*= $image_path; */ ?>" style="width: 200px">
                        </td>
                        <td>
                            <?php /*if ($img_details['default_image'] != 1) { */ ?>
                                <button class="btn button btn-delete"
                                        onclick="changeimagestatus('change',<? /*= $img_details['id'] */ ?>)"
                                        id="delete_<? /*= $img_details['id']; */ ?>">Set Default
                                </button>
                            <?php /*} else {
                                echo "default";
                            }
                            */ ?>
                        </td>
                        <td>
                            <button class="btn button btn-delete"
                                    onclick="changeimagestatus('delete',<? /*= $img_details['id'] */ ?>)"
                                    id="delete_<? /*= $img_details['id']; */ ?>">Delete
                            </button>
                        </td>

                    </tr>
                <?php /*} */ ?>
            </table>-->
        </div>
    </div>
</div>