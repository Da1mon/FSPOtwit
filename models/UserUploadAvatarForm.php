<?php
/**
 * Created by PhpStorm.
 * User: Ilya
 * Date: 11.10.2015
 * Time: 14:39
 */

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\validators\ImageValidator;

class UserUploadAvatarForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    public $filename;
    public $avatar;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'safe'],
            ['file', 'image', 'extensions'=>'jpg, gif, png',
                'minWidth' => 100, 'maxWidth' => 600,
                'minHeight' => 100, 'maxHeight' => 600],
            //['file', 'file', 'maxSize'=>'100000', 'message' => 'размер фаила не должен превышать 100000'],
            [['filename', 'avatar'], 'string', 'max' => 255],
        ];
    }
}