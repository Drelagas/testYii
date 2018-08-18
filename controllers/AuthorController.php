<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;
use app\models\AuthorAddForm;
use app\models\AuthorEditForm;
use app\models\AuthorRemoveForm;
use app\models\Author;
use yii\helpers\ArrayHelper;

class AuthorController extends Controller
{  
    public function actionAdd()
    {
        $model = new AuthorAddForm;
        
        if ($model->load(Yii::$app->request->post()) && $model->add($model->name, $model->surname))
        {
            
        }
        
        return $this->render('add', ['model' => $model]);
    }
    
    public function actionEdit()
    {
        $author = $this->getData($_GET['id']);
        $model = new AuthorEditForm($author->attributes['id']);
        
        if ($model->load(Yii::$app->request->post()))
        {
            $model->edit($author->attributes['id'], $model->name, $model->surname);
        }
        
        return $this->render('edit', [
            'model' => $model,
            'author' => $author
        ]);
    }
    
    public function actionList()
    {
        $query = Author::find();
        
        if ($query->count() > 0)
        {
            $model = new AuthorRemoveForm;
            
            $pagination = new Pagination([
                'defaultPageSize' => 5,
                'totalCount' => $query->count(),
            ]);
            
            $query1 = Author::find()->orderBy('id')
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
            
            $authors = ArrayHelper::map($query1, 'id', 'name');
            
            if ($model->load(Yii::$app->request->post()))
            {
                $model->remove();
            }
            
            return $this->render('list', [
                'model' => $model,
                'authors' => $authors,
                'pagination' => $pagination,
            ]);
        }
        
        Yii::$app->session->setFlash('warning', 'Книги не обнаружены!');
        return $this->render('list');
    }
    
    public static function getData(int $id)
    {
        $sql = sprintf('SELECT * FROM authors WHERE id=%d', $id);
        return Author::findBySql($sql)->one();
    }
}