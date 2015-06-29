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
/* @var $this InformationController */

$this->breadcrumbs = array (
    'Information' => array ( '/information' ),
    'Save',
);
?>

<?php
//create form
$form              = $this->beginWidget( 'booster.widgets.TbActiveForm',
    array (
    'id' => 'informationform',
    'type' => 'horizontal',
    'enableClientValidation' => true,
    'clientOptions' => array (
        'validateOnSubmit' => true,
    )
    ) );
?>


<h1><?php echo $this->id . ' ' . $this->action->id; ?></h1>

<?php
echo $form->textFieldGroup( $model, 'title',
    array (
    'value' => '',
    'wrapperHtmlOptions' => array (
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array (
        'htmlOptions' => array (
            'placeholder' => 'Überschrift',
        ),
    ),
) );
?>

<?php
echo $form->ckEditorGroup(
    $model, 'content',
    array (
    'wrapperHtmlOptions' => array (
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array (
        'editorOptions' => array (
            'fullpage' => 'js:true',
            'width' => '640',
        /* 'resize_maxWidth' => '640', */
        /* 'resize_minWidth' => '320' */
        )
    )
    )
);
?>

<!--@todo list with categorys--> 
<?php
echo $form->select2Group(
    $model, 'category_id',
    array (
    'wrapperHtmlOptions' => array (
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array (
        'asDropDownList' => true,
        'data' => $categoryList,
        'options' => array (
            'placeholder' => 'Kategory',
            /* 'width' => '40%', */
            'tokenSeparators' => array ( ',', ' ' )
        )
    )
    )
);
?>
<span>Tag , getrennt eintippen</span>
<?php
echo $form->textFieldGroup( $modelTags, 'designation',
    array (
    'value' => '',
    'wrapperHtmlOptions' => array (
        'class' => 'col-sm-5',
    ),
    'widgetOptions' => array (
        'htmlOptions' => array (
            'placeholder' => 'Tags',
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

<!-- get current User-->
<?php echo $form->hiddenField( $model, 'author_id',
    array ( 'value' => Yii::app()->user->id ) ); ?>
<?php $this->endWidget(); ?>