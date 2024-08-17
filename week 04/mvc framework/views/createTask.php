<?php
/**  @var $model \app\models\User */

use app\core\form\TextareaField;

?>

<h1>create tasks</h1>

<?php $form= app\core\form\Form::begin("","post"); ?>
<?php echo $form->field($model,'label' )?>
<?php echo new TextareaField($model,'description') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php echo app\core\form\Form::end(); ?>

