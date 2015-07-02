<?php
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

<?php 
$model = new Information;
$modelTags = new Tag;
?>

<?php
$dataProvider->getData();
$aData             = $dataProvider->data;

$model->title = $aData[0]['title'];
$model->content = $aData[0]['content'];
$model->category_id = $aData[0]['category'];

foreach($aData[0]['tag'] as $tag)
{
	$modelTags->designation = $modelTags->designation . $tag['designation'] . ",";
}
?>

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
            'placeholder' => 'LF2',
            // 'width' => '40%', 
            'tokenSeparators' => array ( ',', ' ' )
        )
    )
    )
);
?>

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

<?php
echo $form->hiddenField( $model, 'author_id',
    array ( 'value' => Yii::app()->user->id ) );
?>

<?php 
	$this->endWidget(); 
?>