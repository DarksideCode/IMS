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
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle   = Yii::app()->name . ' - Error';
$this->breadcrumbs = array (
    'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
<?php echo CHtml::encode( $message ); ?>
</div>