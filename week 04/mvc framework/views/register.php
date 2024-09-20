
<?php
/**  @var $model \app\models\User */

?>


<h1>Create an account</h1>


<!--<form action="" method="post">-->
<?php $form= app\core\form\Form::begin("","post"); ?>


<div class="row">

    <div class="col">
        <?php echo $form->field($model,'firstname' )?>

    </div>
    <div class="col">

        <?php echo $form->field($model,'lastname' )?>

    </div>
</div>

<?php echo $form->field($model,'email' )?>
<?php echo $form->field($model,'password' )->passwordField()?>
<?php echo $form->field($model,'confirmPassword' )->passwordField()?>


<button type="submit" class="btn btn-primary">Submit</button>
<?php echo app\core\form\Form::end(); ?>