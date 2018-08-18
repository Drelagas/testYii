<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Book as Book;

/**
 * ContactForm is the model behind the contact form.
 */
class BookEditForm extends Model
{
    public $id;
    public $title;
    public $author_id;
    
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
            [['title', 'author_id'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Название книги',
            'author_id' => 'ID автора',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function edit(int $id, string $title, int $authorId)
    {
        $query = Book::find()->where(['id' => $id])->one();
        
        if (!empty($query))
        {
            $query->title = $title;
            $query->author_id = $authorId;
            $query->save();
            
            Yii::$app->session->setFlash('success', 'Книга изменена.');
            
            return true;
        }
       
        Yii::$app->session->setFlash('success', 'Книга не обнаружена.');
        
        return false;
    }
}