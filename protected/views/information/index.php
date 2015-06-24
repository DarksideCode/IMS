<?php
/* @var $this InformationController */

$this->breadcrumbs=array(
	'Information',
);
?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<?php
		$rawData = CHttpRequest::getParam('tableData');
		
		$arrayDataProvider=new CArrayDataProvider($rawData, array(
			'id' => 'id',
			'pagination'=>array(
				'pageSize' => 10,
			),
		));
?>

<?php
	$this->widget(
		'booster.widgets.TbGridView', array (
			'id'=>'id',
			'dataProvider'=>$arrayDataProvider,
			'type'=>'striped bordered',
			'template'=>"{items}",
			'columns' => array(
				array(
					'name'=>'Titel',
					'type'=>'raw',
					'value' => '$data["title"]'
				),
				array(
					'name'=>'Kategorie',
					'type'=>'raw',
					'value' => '$data["designation"]'
				),
				array(
					'name'=>'Autor',
					'type'=>'raw',
					'value' => '$data["username"]'
				),
				array(
					'name'=>'Letzte Änderung',
					'type'=>'raw',
					'value' => '$data["timestamp"]'
				)
			)
		)
	);
?>
