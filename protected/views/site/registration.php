<?php
$this->pageTitle = Yii::app()->name . ' - Registration'
?>

<?php
//create form
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
    'id' => 'registerform',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    )
        ));
?>

<div class="row buttons">
    <?php
    $this->widget('booster.widgets.TbButton', array(
        'buttonType' => 'submit',
        'context' => 'success',
        'id' => 'saving',
        'label' => 'Save',
        'icon' => 'ok-circle',
        'htmlOptions' => array(),
    ));
    ?>
</div>


<?php $this->endWidget(); ?>