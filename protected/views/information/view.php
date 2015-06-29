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

<?php
$dataProvider->getData();
$aData             = $dataProvider->data;
//        print_r( $dataProvider );

foreach ( $aData as $data )
{
        ?>

        <div>
                <div>
                        <h1><?php echo $data[ 'title' ] ?></h1>
                        <p>
                                <span> Tags: <?php
                                        foreach ( $data[ 'tag' ] as $tag )
                                        {
                                                echo $tag[ 'designation' ] . ' ';
                                        }
                                        ?>
                                </span>
                                <span>Kategorie: <?php echo $data[ 'category' ][ 'designation' ] ?></span>
                        </p>
                </div>

                <div>
                        <?php echo $data[ 'content' ] ?>
                </div>

                <div>
                        <span> Letzte Änderung: <?php echo $data[ 'timestamp' ] ?> von <?php echo $data[ 'author' ][ 'username' ] ?></span>
                </div>
        </div>

        <?php
}
?>