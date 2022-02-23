<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wi_stores".
 *
 * @property int $id Codigo
 * @property string $idApi IdApi
 * @property string $name Nombre
 * @property string $objetct Tipo
 * @property string $warehouseId Bodega
 * @property string $status Estado
 */
class Stores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wi_stores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idApi', 'name', 'objetct', 'warehouseId', 'status'], 'required'],
			[['idWoo'], 'integer'],            
            [['idApi', 'name', 'objetct', 'warehouseId', 'status'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Codigo'),
            'idApi' => Yii::t('app', 'IdApi'),
            'name' => Yii::t('app', 'Nombre'),
            'objetct' => Yii::t('app', 'Tipo'),
            'warehouseId' => Yii::t('app', 'Bodega'),
            'status' => Yii::t('app', 'Estado'),
        ];
    }
}
