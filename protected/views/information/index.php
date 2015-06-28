<?php
/* @var $this InformationController */

$this->breadcrumbs=array(
	'Information',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
	$this->widget(
		'booster.widgets.TbGridView', array (
			'id'=>'id',
			'dataProvider'=>$DataProvider,
			'type'=>'striped bordered',
			'template'=>"{items}",
			'columns' => array(
                            'title',
                            'category.designation',
                            'author.username',
                            'timestamp',
							array(
								'class'=>'CButtonColumn',
								'template' => '{view}{edit}{delete}',
								'buttons' => array(
									'view' => array(
										'label' => 'Anzeigen',
										'url' => 'Yii::app()->createUrl("information/view")',
										'imageUrl' => Yii::app()->request->baseUrl . '/images/view.png',
										//'options' => array(...),
										//'click' => '...',
									),
									'edit' => array(
										'label' => 'Bearbeiten',
										'url' => 'Yii::app()->createUrl("information/save")',
										'imageUrl' => Yii::app()->request->baseUrl . '/images/update.png',
										//'options' => array(...),
										//'click' => '...',
									),
									'delete' => array(
										'label' => 'Löschen',
										'url' => 'Yii::app()->createUrl("information/delete")',
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
