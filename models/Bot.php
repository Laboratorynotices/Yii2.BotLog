<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bots".
 *
 * @property string $id Номер записи
 * @property string $name Имя бота
 * @property string $password Пароль бота
 */
class Bot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bots';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'password'], 'required'],
            [['name', 'password'], 'string', 'max' => 190],
            [['name'], 'unique'],
        ];
    }

	/**
	* Перед сохранением генерируем хеш пароля.
	*/
	public function beforeSave($insert) {
		if(isset($this->password))
			$this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
		return parent::beforeSave($insert);
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер записи',
            'name' => 'Имя бота',
            'password' => 'Пароль бота',
        ];
    }
	
	/**
	* Связывание модели Bot с моделью Address.
	*/
	public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['bot_id' => 'id']);
    }
}
