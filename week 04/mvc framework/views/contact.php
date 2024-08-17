<?php

/** @var $model \app\models\ContactForm */
/** @var $this \app\core\View */

use app\core\form\Form;
use app\core\form\TextareaField;


?>



<h1>contact us</h1>


<?php $form= Form::begin('','post'); ?>
<?php echo $form->field($model,'subject') ?>
<?php echo $form->field($model,'email') ?>
<?php echo new TextareaField($model,'body') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>










