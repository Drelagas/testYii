<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-add">
    
        <div class="body-content">
        
        	<h1><?= Html::encode($this->title) ?></h1>
        	
        	<?php if (Yii::$app->session->hasFlash('addFormSubmitted')): ?>
        		sadsd
        	<?php else: ?>
    		
        		<?php $form = ActiveForm::begin(['id' => 'book-add']); ?>
    
                	<?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>
    
                    <?= $form->field($model, 'author') ?>
    
                    <div class="form-group">
                    	<?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'book-add-button']) ?>
                    </div>
    
    			<?php ActiveForm::end(); ?>
			
			<?php endif; ?>
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    		
    
    		
    		
    		
    		
    		
    		
    		
        </div>
</div>