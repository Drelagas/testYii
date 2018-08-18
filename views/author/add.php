<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Добавление автора';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-add">
    
        <div class="body-content">
        
        	<h1><?= Html::encode($this->title) ?></h1>
        	
        	<?php if (Yii::$app->session->hasFlash('addFormSubmitted')): ?>
        		sadsd
        	<?php else: ?>
    		
        		<?php $form = ActiveForm::begin(['id' => 'author-add']); ?>
    
                	<?= $form->field($model, 'name') ?>
                	
                	<?= $form->field($model, 'surname') ?>
    
                    <div class="form-group">
                    	<?= Html::submitButton('Добавить', ['class' => 'btn btn-primary', 'name' => 'author-add-button']) ?>
                    </div>
    
    			<?php ActiveForm::end(); ?>
			
			<?php endif; ?>
    		
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
        </div>
</div>