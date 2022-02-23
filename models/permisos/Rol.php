<?php

namespace app\models\permisos;

use Yii;
use app\models\User;
use app\models\permisos\RolOperacion;
use app\models\permisos\Operacion;
/**
 * This is the model class for table "rol".
 *
 * @property integer $id
 * @property string $nombre
 */
class Rol extends \yii\db\ActiveRecord
{
    
    public $operaciones;
    const ROL_ADMIN = 1;
    const ROL_CUENTA = 5;
    const ROL_CLIENTE = 6;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['operaciones'], 'safe'],
            [['nombre'], 'required'],
            [['nombre'], 'string', 'max' => 32]
        ];
    }
	
	public function afterSave($insert, $changedAttributes){
        Yii::$app->db->createCommand()->delete('rol_operacion', 'rol_id = '.(int) $this->id)->execute();

        foreach ($this->operaciones as $id) {
            $ro = new RolOperacion();
            $ro->rol_id = $this->id;
            $ro->operacion_id = $id;
            $ro->save();
        }
    }
    
    public function getRolOperaciones()
    {
        return $this->hasMany(RolOperacion::className(), ['rol_id' => 'id']);
    }

    public function getOperacionesPermitidas()
    {
        return $this->hasMany(Operacion::className(), ['id' => 'operacion_id'])
            ->viaTable('rol_operacion', ['rol_id' => 'id']);
    }

    public function getOperacionesPermitidasList()
    {
        return $this->getOperacionesPermitidas()->asArray();
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
           'id' => Yii::t('app', 'ID'),
           'nombre' => Yii::t('app', 'Nombre'),
        ];
    }
    
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['rol_id' => 'id']);
    }
	
	public static function getEtiquetaRol($rol){
		$roles = [
			1=>'Admin',
			5=>'Cuenta',
			6=>'Cliente'
		];
		return $roles[$rol];
	}
    
}
