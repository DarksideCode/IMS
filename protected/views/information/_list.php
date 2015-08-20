<?php
$this->widget(
    'booster.widgets.TbGridView',
    array (
    'id' => 'information-list',
    'dataProvider' => $DataProvider,
    'type' => 'striped bordered',
    'template' => "{items}{pager}",
    'enablePagination' => true,
//    'filter' => $model,
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
                    'url' => 'Yii::app()->createUrl("information/edit", array("id"=>$data["id"]))',
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