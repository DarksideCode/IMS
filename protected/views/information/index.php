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
    'Information',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
$this->widget(
    'booster.widgets.TbGridView',
    array (
    'id' => 'id',
    'dataProvider' => $DataProvider,
    'type' => 'striped bordered',
    'template' => "{items}",
    'columns' => array (
        'title',
        'category.designation',
        'author.username',
        'timestamp',
        array (
            'class' => 'CButtonColumn',
            'template' => '{view}{edit}{delete}',
            'buttons' => array (
                'view' => array (
                    'label' => 'Anzeigen',
                    'url' => 'Yii::app()->createUrl("information/view", array("id"=>$data["id"]))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
                //'options' => array(...),
                //'click' => '...',
                ),
                'edit' => array (
                    'label' => 'Bearbeiten',
                    'url' => 'Yii::app()->createUrl("information/save", array("id"=>$data["id"]))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/update.png',
                //'options' => array(...),
                //'click' => '...',
                ),
                'delete' => array (
                    'label' => 'Löschen',
                    'url' => 'Yii::app()->createUrl("information/delete", array("id"=>$data["id"]))',
                    'imageUrl' => Yii::app()->request->baseUrl . '/images/delete.png',
                //'options' => array(...),
                //'click' => '...',
                ),
            ),
        ),
    )
    )
);
?>
