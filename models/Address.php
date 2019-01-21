<?php

namespace app\models;

use Yii;
use app\models\Bot;

/**
 * This is the model class for table "addresses".
 *
 * @property string $id Номер записи адреса
 * @property string $bot_id Внешний ключ с таблицей bots
 * @property string $ip IP адрес бота
 * @property string $create_date Время создания записи
 */
class Address extends \yii\db\ActiveRecord
{
	public $name; // Имя-логин бота
	public $password; // Пароль бота

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'addresses';
    }

	/*
	* После получения данных из формы подготавливаем их к полной валидации
	*/
	public function  beforeValidate() {
		// Ищем запись бот, у которого совпадает поле name и поле password с хешем введёного пароля.
		// Сначала ищем пользователя с таким уникальным именем-логином
		$bot = Bot::findOne(['name' => $this->name]);

		// Если не нашли такую запись в таблице bots или пароль не сошёлся.
		if (is_null($bot) || !Yii::$app->getSecurity()->validatePassword($this->password, $bot->password)) {
			// Значит мы оба этих параметра сбрасываем.
			$this->name = '';
			$this->password = '';

			return false;
		}

		// Заполняем теперь поля для записи адреса
		$this->bot_id = $bot->id; // Связываем с таблицей bots
		$this->ip = Yii::$app->request->userIP; // Определяем IP адрес пользователя.

		return parent::beforeValidate();
	}

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['bot_id', 'ip', 'name', 'password'], 'required'],
            [['bot_id'], 'integer'],
            [['create_date'], 'safe'],
            [['ip'], 'string', 'max' => 190],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер записи адреса',
            'bot_id' => 'Внешний ключ с таблицей bots',
            'ip' => 'IP адрес бота',
            'create_date' => 'Время создания записи',


            'bot_name' => 'Имя бота',
            'bot_password' => 'Пароль бота',
        ];
    }
	
	/**
	* Связывание модели Address с моделью Bot.
	*/
	public function getBot() {
        return $this->hasOne(Bot::className(), ['id' => 'bot_id']);
    }
}
