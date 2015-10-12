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
use yii\base\InvalidParamException;

class UserUploadAvatarForm extends Model
{
    /**
     * @var UploadedFile file attribute
     */
    public $file;
    public $filename;
    public $avatar;

    private $_user;

    /**
     * @param User $user
     * @param array $config
     * @throws \yii\base\InvalidParamException
     */
    public function __construct(User $user, $config = [])
    {
        if (empty($user)) {
            throw new InvalidParamException('User is empty.');
        }
        $this->_user = $user;
        parent::__construct($config);
    }
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['file'], 'safe'],
            ['file', 'image', 'extensions'=>'jpg, gif, png',
                'minWidth' => 100, 'maxWidth' => 512,
                'minHeight' => 100, 'maxHeight' => 512],
            //['file', 'file', 'maxSize'=>'100000', 'message' => 'размер фаила не должен превышать 100000'],
            [['filename', 'avatar'], 'string', 'max' => 255],
        ];
    }

    public function updateUser()
    {
        if ($this->validate()) {
            $this->_user->avatar = $this->avatar;
            $this->_user->filename = $this->filename;
            $this->_user->update();
            return true;
        }
        return false;
    }
}