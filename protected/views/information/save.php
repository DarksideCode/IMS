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
$this->renderPartial( '_form',
    array ( 'model' => $model, 'modelTags' => $modelTags, 'categoryList' => $categoryList ) );
?>