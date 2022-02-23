<?php

namespace app\models\base;

use Yii;

/**
 * This is the model class for table "sis_configuraciones".
 *
 * @property string $NombreComercial
 * @property string $Cedula
 * @property integer $Persona
 * @property integer $Provincia
 * @property string $Canton
 * @property string $Distrito
 * @property string $Barrio
 * @property string $OtrasSenas
 * @property string $UsuarioDGT
 * @property string $ClaveDGT
 * @property string $ArchivoP12
 * @property integer $MostrarSloganEnFactura
 * @property integer $ClientePorDefecto
 * @property string $Telefono
 * @property string $Correo
 * @property integer $Ambiente
 * @property string $Fax
 * @property string $GrupoDeActivos
 * @property string $NombreDeLotes
 * @property string $Logo
 * @property integer $Inventario
 */
class BaseConfiguraciones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sis_configuraciones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['NombreComercial', 'Cedula', 'Persona', 'Provincia', 'Canton', 'Distrito', 'Barrio', 'OtrasSenas', 'UsuarioDGT', 'ClaveDGT', 'ArchivoP12', 'MostrarSloganEnFactura', 'ClientePorDefecto', 'Telefono', 'Correo', 'Ambiente', 'Fax', 'GrupoDeActivos', 'NombreDeLotes', 'Logo', 'Inventario'], 'required'],
            [['NombreComercial', 'Cedula', 'OtrasSenas', 'UsuarioDGT', 'ClaveDGT', 'ArchivoP12', 'Telefono', 'Correo', 'Fax', 'GrupoDeActivos', 'NombreDeLotes', 'Logo'], 'string'],
            [['Persona', 'Provincia', 'MostrarSloganEnFactura', 'ClientePorDefecto', 'Ambiente', 'Inventario'], 'integer'],
            [['Canton', 'Distrito', 'Barrio'], 'string', 'max' => 2],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'NombreComercial' => 'Nombre Comercial',
            'Cedula' => 'Cedula',
            'Persona' => 'Persona',
            'Provincia' => 'Provincia',
            'Canton' => 'Canton',
            'Distrito' => 'Distrito',
            'Barrio' => 'Barrio',
            'OtrasSenas' => 'Otras Senas',
            'UsuarioDGT' => 'Usuario Dgt',
            'ClaveDGT' => 'Clave Dgt',
            'ArchivoP12' => 'Archivo P12',
            'MostrarSloganEnFactura' => 'Mostrar Slogan En Factura',
            'ClientePorDefecto' => 'Cliente Por Defecto',
            'Telefono' => 'Telefono',
            'Correo' => 'Correo',
            'Ambiente' => 'Ambiente',
            'Fax' => 'Fax',
            'GrupoDeActivos' => 'Grupo De Activos',
            'NombreDeLotes' => 'Nombre De Lotes',
            'Logo' => 'Logo',
            'Inventario' => 'Inventario',
        ];
    }
}
