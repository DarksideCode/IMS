<?php
/**
 * echo flash message
 */
foreach ( Yii::app()->user->getFlashes() as $key => $message )
{
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
}
?>

<?php
$this->pageTitle = Yii::app()->name . ' - Registration'
?>

<?php
//create form
$form            = $this->beginWidget( 'booster.widgets.TbActiveForm',
    array (
    'id' => 'registerform',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'clientOptions' => array (
        'validateOnSubmit' => true,
    )
    ) );
?>

<?php
echo $form->textFieldGroup( $model, 'username',
    array (
    'value' => '',
    'wrapperHtmlOptions' => array (
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array (
        'htmlOptions' => array (
            'placeholder' => 'login',
        ),
    ),
) );
?>

<?php
echo $form->passwordFieldGroup( $model, 'password' );
?>

<?php
echo $form->textFieldGroup( $model, 'email',
    array (
    'value' => '',
    'wrapperHtmlOptions' => array (
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array (
        'htmlOptions' => array (
            'placeholder' => 'e-mail',
        ),
    ),
) );
?>

<?php
echo $form->textFieldGroup( $model, 'firstname',
    array (
    'value' => '',
    'wrapperHtmlOptions' => array (
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array (
        'htmlOptions' => array (
            'placeholder' => 'Vorname',
        ),
    ),
) );
?>

<?php
echo $form->textFieldGroup( $model, 'lastname',
    array (
    'value' => '',
    'wrapperHtmlOptions' => array (
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array (
        'htmlOptions' => array (
            'placeholder' => 'Nachnahme',
        ),
    ),
) );
?>

<div class="row buttons">
        <?php
        $this->widget( 'booster.widgets.TbButton',
            array (
            'buttonType' => 'submit',
            'context' => 'success',
            'id' => 'saving',
            'label' => 'Save',
            'icon' => 'ok-circle',
            'htmlOptions' => array (),
        ) );
        ?>
</div>


<?php $this->endWidget(); ?>