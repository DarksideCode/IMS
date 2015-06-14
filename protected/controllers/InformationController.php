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
        $modelCategory = new Category;
        $modelTags = new Tag;
        $modelUser = new User;

        $categoryList = $this->getData('category');
        $categoryList = $this->formateArray($categoryList, 'id', 'designation');

        if (isset($_POST['Information'])) {

            $user = $modelUser->getUserByName($_POST['Information']['author_id'])->findAll();
            $userID = $user[0]['id'];

            $_POST['Information']['author_id'] = $userID;

            $model->attributes = $_POST['Information'];

            //@todo saving in db don't work.
            if ($model->validate()) {
                /**
                 * save form in DB
                 */
                $model->save();

                if ($model->save()) {
                    // than you can get id just like that

                    $informationID = $model->id; // this is inserted item id
                    $_POST['Tag']['information_id'] = $informationID;

                    $modelTags->attributes = $_POST['Tag'];

                    if ($modelTags->validate()) {
                        $modelTags->save();
                    } else {
                        $error = $modelTags->errors;
                    }
                }

                /**
                 * display flash message
                 */
                Yii::app()->user->setFlash('save', 'Save complete.');
                $this->refresh();
            } else {
                $error = $model->errors;
                print_r($error);
                die();
            }
        }
        $this->render('save', array('model' => $model, 'modelTags' => $modelTags, 'categoryList' => $categoryList));
    }

    /**
     * get all Data from tabel as array
     * 
     * @param type $tabel string eith tabelname
     * @return array
     */
    public function getData($tabel) {
        // set dataProvider for category list.
        $count = Yii::app()->db->createCommand('SELECT COUNT(*) FROM '.$tabel)->queryScalar();
        $sql = 'SELECT * FROM '.$tabel;
        $dataProvider = new CSqlDataProvider($sql, array(
            'totalItemCount' => $count,
        ));
        
        return $dataProvider->getData();
    }
    
    /**
     * formate array for select2Group widget
     * 
     * @param array $data
     * @param string $key
     * @param string $index
     * @return array
     */
    public function formateArray($data, $key, $index) {
        $list = array();
        foreach ($data as $value) {
            $list[$value[$key]] = $value[$index];
        }
        
        return $list;
    }

}
