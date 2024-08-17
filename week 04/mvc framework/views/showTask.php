<?php
/**  @var $model \app\models\TaskForm */

?>


<h1>tasks</h1>
    <hr>
<?php $form= app\core\form\Form::begin("","post"); ?>
<?php foreach ($model::$exported as $m) :?>
    <div class="row">

        <div class="col">

            <div class="row">
                <h1>
                    <?php
                    echo $m['label'];
                    ?>
                </h1>
            </div>
            <div class="row">
                <p>
                    <?php
                    echo $m['description'];
                    ?>
                </p>
            </div>

        </div>
        <div class="col">
            <div class="row">


                <div class="col">
                    <div class="form-check">
                        <input name="<?php echo $m['id'] ?>-delete" class="form-check-input" type="checkbox" value="true" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            delete task
                        </label>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="form-check form-switch">
                    <input name="<?php echo $m['id'] ?>-done" class="form-check-input" type="checkbox" value="1" role="switch" id="flexSwitchCheckDefault" <?php echo $m['status']==1?"checked":"";   ?>>
                    <label class="form-check-label" for="flexSwitchCheckDefault">Done</label>
                </div>


            </div>



        </div>




    </div>
    <hr>



<?php endforeach;?>
    <button type="submit" class="btn btn-primary">submit</button>
<?php echo app\core\form\Form::end(); ?>