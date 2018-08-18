<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Author as Author;

/**
 * ContactForm is the model behind the contact form.
 */
class AuthorEditForm extends Model
{
    public $id;
    public $name;
    public $surname;
    
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    
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
    public function edit(int $id, string $name, string $surname)
    {
        $query = Author::find()->where(['id' => $id])->one();
        
        if (!empty($query))
        {
            $query->name = $name;
            $query->surname = $surname;
            $query->save();
            
            Yii::$app->session->setFlash('success', 'Автор изменен.');
            
            return true;
        }
       
        Yii::$app->session->setFlash('success', 'Автор не обнаружен.');
        
        return false;
    }
}