<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\Author;
use app\models\BookAddForm;
use app\models\BookEditForm;
use app\models\BookRemoveForm;
use app\models\Book;
use yii\helpers\ArrayHelper;

class BookController extends Controller
{  
    public function actionAdd()
    {
        $model = new BookAddForm();
        
        if ($model->load(Yii::$app->request->post()))
        {
            $model->add($model->title, $model->author);
        }
        
        return $this->render('add', ['model' => $model]);
    }
    
    public function actionEdit()
    {
        $book = $this->getData($_GET['id']);
        $model = new BookEditForm($book->attributes['id']);
        
        if ($model->load(Yii::$app->request->post()))
        {
            $model->edit($book->attributes['id'], $model->title, $model->author_id);
        }
        
        return $this->render('edit', [
            'model' => $model,
            'book' => $book
        ]);
    }
    
    public function actionList()
    {
        $query = Book::find();
        
        if ($query->count() > 0)
        {
            $model = new BookRemoveForm;            
            
            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $query->count(),
            ]);
            
            $query1 = Book::find()->orderBy('id')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            
            $books = ArrayHelper::map($query1, 'id', 'title');
            
            if ($model->load(Yii::$app->request->post()))
            {
                $model->remove();
            }
            
            return $this->render('list', [
                'model' => $model,
                'books' => $books,
                'pagination' => $pagination,
                //'authors' => $this->getAuthors($books),
            ]);
        }
        
        Yii::$app->session->setFlash('warning', 'Книги не обнаружены!');
        return $this->render('list');
    }
    
    private function getAuthors($books)
    {
        /**foreach ($books as $book)
        {
            $author[$book['author_id']] = $this->getAuthorDataById($book['author_id']);
        }
        
        return $author;*/
    }
    
    private function getAuthorDataById(int $id)
    {
        $sql = sprintf('SELECT * FROM books WHERE id=%d', $id);
        return Author::findBySql($sql)->one();
    }
    
    public static function getData(int $id)
    {
        $sql = sprintf('SELECT * FROM books WHERE id=%d', $id);
        return Author::findBySql($sql)->one();
    }
}