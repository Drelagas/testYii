<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Book;

/**
 * ContactForm is the model behind the contact form.
 */
class BookAddForm extends Model
{
    public $title;
    public $author;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['title', 'author'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'title' => 'Название книги',
            'author' => 'ID автора книги',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function add(string $title, int $authorId)
    {
        $sql = sprintf('SELECT * FROM books WHERE title = \'%s\'', $title);
        $book = Book::findBySql($sql)->exists();

        if (empty($book))
        {
            $connection = Yii::$app->db;
            $sql = sprintf('INSERT INTO books (title, author_id) VALUES (\'%s\',%d)', $title, $authorId);
            $command = $connection->createCommand($sql);
            $model = $command->queryAll();	
            
            Yii::$app->session->setFlash('success', 'Книга добавлена!');
            
            return true;
        }
        
        Yii::$app->session->setFlash('warning', 'Данная книга уже присутствует.');
       
        return false;
    }
}