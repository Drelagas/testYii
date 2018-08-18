<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use app\models\Author;

$this->title = 'Редактирование книги';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="book-list">
	<div class="body-content">
    
    	<h1><?= Html::encode($this->title) ?></h1>
    	
    	<p>На данной странице можно отредактировать существующую книгу.</p>
			
			<?php $form = ActiveForm::begin(['id' => 'book-edit']); ?>
        	
        	<?= $form->field($model, 'title')->input(['placeholder' => $book->attributes['title']]) ?>
                	
            <?= $form->field($model, 'author_id')->input(['placeholder' => $book->attributes['author_id']]) ?>
    
            <div class="form-group">
            	<?= Html::submitButton('Изменить', ['class' => 'btn btn-primary', 'name' => 'book-edit-button']) ?>
            </div>
            
        	<?php ActiveForm::end(); ?>

    </div>
</div>