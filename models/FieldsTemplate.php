<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wi_templates".
 *
 * @property int $id
 * @property string $name
 * @property string $sku
 * @property string $template
 */
class FieldsTemplate extends \yii\db\ActiveRecord
{
	public $labelField;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wi_templates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'sku', 'template'], 'required'],
            [['name', 'sku', 'template'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'sku' => Yii::t('app', 'Sku'),
            'template' => Yii::t('app', 'Template'),
        ];
    }
	
	public function getLabelfield(){
		return $this->name . "(" .$this->sku.")";
	}
}
