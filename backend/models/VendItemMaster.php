<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "vend_item_master".
 *
 * @property int $id
 * @property int $item_id
 * @property int $vendor_id
 * @property string $status
 */
class VendItemMaster extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vend_item_master';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['item_id', 'vendor_id'], 'required'],
            [['item_id', 'vendor_id'], 'integer'],
            [['status'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item_id' => 'Item ID',
            'vendor_id' => 'Vendor ID',
            'status' => 'Status',
        ];
    }
}
