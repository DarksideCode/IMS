<?php

class InformationController extends Controller {

    public function actionIndex() {
        $this->render('index');
    }

    /**
     * Displays the new Information page
     */
    public function actionSave() {
        $model = new Information;
        $modelTags = new Tag;
        if (isset($_POST['Information'])) {

            $model->attributes = $_POST['Information'];
            
            if ($model->validate()) {
                print_r($_POST['Information']);
die('hi');
                /**
                 * save form in DB
                 */
                $model->save();
                
                if ($model->save()) {
                    // than you can get id just like that

                    $informationID = $model->id; // this is inserted item id
                    $_POST['Tag']['information_id'] = $informationID;

                    print_r($_POST['Tag']);
                    die;
                    
                    $modelTags->attributes = $_POST['Tag'];
                    $modelTags->save();
                }

                /**
                 * display flash message
                 */
                Yii::app()->user->setFlash('save', 'Save complete.');
                $this->refresh();
            }
        }
        $this->render('save', array('model' => $model, 'modelTags' => $modelTags));
    }

}
