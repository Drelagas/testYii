<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Book;

/**
 * ContactForm is the model behind the contact form.
 */
class BookRemoveForm extends Model
{
    public $booksIds;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['booksIds'], 'required'],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function remove()
    {
        for ($i = 0; $i < count($this->booksIds); $i++)
        {
            $sql = sprintf('SELECT * FROM books WHERE id=%d', $this->booksIds[$i]);
            $book = Book::findBySql($sql)->one();
            
            if (!empty($book))
            {
                $book->delete();
            }
        }
        
        return true;
    }
}