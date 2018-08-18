<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Author as Author;

/**
 * ContactForm is the model behind the contact form.
 */
class AuthorAddForm extends Model
{
    public $name;
    public $surname;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'surname'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя автора',
            'surname' => 'Фамилия автора',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function add(string $name, string $surname)
    {
        $sql = sprintf('SELECT * FROM authors WHERE name = \'%s\' AND surname = \'%s\'', $name, $surname);
        $author = Author::findBySql($sql)->exists();

        if (empty($author))
        {
            $connection = Yii::$app->db;
            $sql = sprintf('INSERT INTO authors (name, surname) VALUES (\'%s\', \'%s\')', $name, $surname);
            $command = $connection->createCommand($sql);
            $model = $command->queryAll();	
            
            Yii::$app->session->setFlash('success', 'Автор добавлен!');
            
            return true;
        }
        
        Yii::$app->session->setFlash('warning', 'Данный автор уже добавлен.');
       
        return false;
    }
}