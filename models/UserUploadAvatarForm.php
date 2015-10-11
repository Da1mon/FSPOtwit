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

class UserUploadAvatarForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'file'],
        ];
    }
}