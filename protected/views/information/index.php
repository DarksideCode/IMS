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
$Script            = '$(function() {
                $( "#search-bar" ).keyup(function(event) {
                        event.preventDefault();
                        $.ajax({
                                method: "GET",
                                url: "/IMS/source/index.php/information/search?value="+$(this).attr("value"),
                        }).done(function( data ) {
                                $("#tabelBody").children().remove();
                                var html = $(data).find("#content").html();
                                $("#tabelBody").append(html);
                        });
                });
        });
    ';

Yii::app()->clientScript->registerScript( 'search', $Script );
?>

<div class="search-bar">
        <form class="navbar-form navbar-left" action=""><div class="form-group">
                        <input type="text" id="search-bar" class="form-control" placeholder="Search"></div>
        </form>
</div>

<div id="tabelBody">
        <?php
        $this->renderPartial( '_list',
            array ( 'DataProvider' => $DataProvider, 'model' => $model ) );
        ?>
</div>
