<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "loaded_users".
 *
 * @property int $id
 * @property string $name
 * @property int|null $age
 * @property string|null $city
 * @property string|null $country
 * @property string|null $email
 * @property string|null $salt
 * @property string|null $password
 * @property string|null $picture
 */
class LoadedUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loaded_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['age'], 'integer'],
            [['name'], 'string', 'max' => 120],
            [['city', 'country', 'email', 'salt'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 64],
            [['picture'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Név',
            'age' => 'Kor',
            'city' => 'Város',
            'country' => 'Ország',
            'email' => 'Email',
            'salt' => 'Salt',
            'password' => 'Password',
            'picture' => 'Fotó',
        ];
    }
}
