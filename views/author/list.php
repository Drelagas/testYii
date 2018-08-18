<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\bootstrap\ActiveForm;
use app\models\Book;

$this->title = 'Список авторов';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="book-list">
	<div class="body-content">
    
    	<h1><?= Html::encode($this->title) ?></h1>
    	
    	<p>На данной странице отображен список всех добавленных книг. Воспользуйтесь страничной навигацией, <br/> чтобы просмотреть весь список.</p>
			
			<?php $form = ActiveForm::begin(['id' => 'author-delete']); ?>
        	
        	<ul>
        	
        		<?= $form->field($model, 'authorsIds[]')->checkboxList($authors); ?>
                
        	</ul>
        	
        	<div class="form-group">
            	<?= Html::submitButton('Удалить', ['class' => 'btn btn-primary', 'name' => 'author-delete-button']) ?>
            </div>
            
        	<?php ActiveForm::end(); ?>
        	
    	</div>
    	
    	<div>
    		<?= LinkPager::widget(['pagination' => $pagination]) ?>
    	</div>

    </div>
</div>