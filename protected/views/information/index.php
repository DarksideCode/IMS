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
                            'timestamp'
			)
		)
	);
?>
