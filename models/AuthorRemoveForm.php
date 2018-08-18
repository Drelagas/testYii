<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use app\models\Book;

/**
 * ContactForm is the model behind the contact form.
 */
class AuthorRemoveForm extends Model
{
    public $authorsIds;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['authorsIds'], 'required'],
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function remove()
    {
        for ($i = 0; $i < count($this->authorsIds); $i++)
        {
            $sql = sprintf('SELECT * FROM authors WHERE id=%d', $this->authorsIds[$i]);
            $author = Author::findBySql($sql)->one();
            
            if (!empty($author))
            {
                $author->delete();
            }
        }
        
        return true;
    }
}