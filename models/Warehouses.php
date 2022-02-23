<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "wi_warehouses".
 *
 * @property int $id
 * @property int $idShort
 * @property string $idApi
 * @property string $description
 * @property int $status
 * @property string|null $object
 * @property string $type
 */
class Warehouses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wi_warehouses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idShort', 'idApi', 'description', 'status', 'type'], 'required'],
            [['idShort', 'status'], 'integer'],
            [['idApi', 'description', 'object', 'type','society'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'idShort' => Yii::t('app', 'Id Short'),
            'idApi' => Yii::t('app', 'Id Api'),
            'description' => Yii::t('app', 'Description'),
            'status' => Yii::t('app', 'Status'),
            'object' => Yii::t('app', 'Object'),
            'type' => Yii::t('app', 'Type'),
            'society' => Yii::t('app', 'society'),
        ];
    }
	
	public static function validatePrint($name){
		$notShow = [
		/*	'Distribución',
			'Apartados',
			'Uso Interno',
			'Prestamos',
			'Garantias',
			'Devoluciones',
			'Garantías',
			'Garantía',
			'Devolución',
			'Obsoletos',
			'Exhibición',
			'Transitoria',
			'Transferencias',
			'NO USAR',
			'Bodega',
			'Apartado',
			'Soporte',*/
		];
		$flag = true;
		foreach($notShow as $nameNoShow){
			if (str_contains($name, $nameNoShow)) {
				$flag = false;
				break;
			}
		}
		return $flag;
	}
}
