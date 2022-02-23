<?php
namespace app\models\base;

use app\models\User;
use yii\base\Model;
use Yii;
use Swift_Attachment;

/**
 * Send comprobantes
 */
class SendMail extends Model
{
    public $desde;
    public $para;
    public $asunto;
    public $mensaje;
    public $plantilla;
    public $mensajeXml;
    public $comprobanteXml;
    public $comprobantePdf;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desde','para'], 'filter', 'filter' => 'trim'],
            [['para','asunto','mensaje'], 'required'],           
            [['desde','para'], 'email'],
            ['mensaje', 'string', 'max' => 255],
            ['asunto', 'string', 'max' => 25],
        ];
    }

     /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'desde' => Yii::t('app', 'Desde'),
            'para' => Yii::t('app', 'Para'),
            'asunto' => Yii::t('app', 'Asunto'),
            'mensaje' => Yii::t('app', 'Mensaje'),
        ];
    }
    
    
    /**
     * Enviar el correo
     *
     * @return true si se envió de forma correcta
     */
    public function send()
    {
        $mailObject =  Yii::$app->mailer->compose()
        ->setFrom($this->desde)
        ->setTo($this->para)
        ->setSubject($this->asunto)
        ->setHtmlBody($this->plantilla);


        if(file_exists($this->mensajeXml) && file_exists($this->comprobanteXml) && file_exists($this->comprobantePdf)) {
            $mailObject->attach($this->comprobanteXml);
            $mailObject->attach($this->mensajeXml);
            $mailObject->attach($this->comprobantePdf);
        }else{
           // echo 'faltan adjuntos';
            return false;
        }
           
       
        $result = $mailObject->send();
        
        return $result;
    }
    
}
