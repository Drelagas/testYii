<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use app\models\Author;

$this->title = 'Редактирование автора';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="book-list">
	<div class="body-content">
    
    	<h1><?= Html::encode($this->title) ?></h1>
    	
    	<p>На данной странице можно отредактировать существующего автора.</p>
			
			<?php $form = ActiveForm::begin(['id' => 'author-edit']); ?>
        	
        	<?= $form->field($model, 'name')->input(['placeholder' => $author->attributes['name']]) ?>
                	
            <?= $form->field($model, 'surname')->input(['placeholder' => $author->attributes['surname']]) ?>
    
            <div class="form-group">
            	<?= Html::submitButton('Изменить', ['class' => 'btn btn-primary', 'name' => 'author-edit-button']) ?>
            </div>
            
        	<?php ActiveForm::end(); ?>

    </div>
</div>