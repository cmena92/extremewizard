<?php

namespace app\models\permisos;

use Yii;
use app\models\permisos\RolOperacion;

/**
 * This is the model class for table "operacion".
 *
 * @property integer $id
 * @property string $nombre
 */
class Operacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'operacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
        ];
    }
	
	public static function crearOperacion($model){
		$connection = \Yii::$app->db;
		$transaction = $connection->beginTransaction();
		try {
			
			$model->save();
			$ro = new RolOperacion();
			
			$ro->rol_id = 1;
			$ro->operacion_id = $model->id;
			$ro->save();
			
			$transaction->commit();
			return true;			
		}catch (Exception $e) {
			$transaction->rollback();
			var_dump([
				'operarion' => $model->errors,
				'rolOperac' => $ro->errors
			]);
			die;
		}
		return false;
	}

    /**
     * Retorna los roles de la opeacion actual
     */
	public function getRoles(){
		
		return $this->hasMany(
		Rol::className(), [
			'id' => 'rol_id'
		])
		->viaTable('rol_operacion', [
		'operacion_id' => 'id'
		]);
	}
	
	/**
     * Retorna todas las relaciones de la operacion  actual
     */
	public static function getRolOperacion(){
		return $this->hasMany(RolOperaciones::className(), ['operacion_id' => 'id']);
	}
	
}
