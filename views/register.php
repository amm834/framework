<h1 class="my-3 text-center display-6">Register Account</h1>
<?php use App\Core\Form\Form;

$form = Form::begin('','post');
echo $form->field($model,'username');
echo $form->field($model,'email');
echo $form->field($model,'password');
echo $form->field($model,'passwordConfirm');
?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php
Form::end();
?>