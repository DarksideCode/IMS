<?php

class InformationController extends Controller
{

        public function filters()
        {
                return array ( 'accessControl' ); // perform access control for CRUD operations
        }

        public function accessRules()
        {
                return array (
                    array ( 'allow', // allow authenticated users to access all actions
                        'users' => array ( '@' ),
                    ),
                    array ( 'deny', // allow authenticated users to access all actions
                        'users' => array ( '*' ),
                    ),
                );
        }

        public function actionIndex()
        {

                $model = new Information;

                $criteria = new CDbCriteria;

                $criteria->alias = 'information';
                $criteria->with  = array (
                    'tag' => array (
                        'select' => false,
                        'alias' => 'tag',
                    ),
                    'category' => array (
                        'select' => false,
                        'alias' => 'category',
                    ),
                    'author' => array (
                        'select' => false,
                        'alias' => 'author',
                    ),
                );
                $criteria->order = 'timestamp DESC';

                $DataProvider = new CActiveDataProvider( $model,
                    array (
                    'criteria' => $criteria,
                    'pagination' => array (
                        'pageSize' => 10,
                    ),
                    ) );

                $this->render( 'index',
                    array ( 'DataProvider' => $DataProvider, 'model' => $model ) );
        }

        public function actionSearch( $value )
        {

                $model = new Information;

                $criteria = new CDbCriteria;

                $criteria->alias = 'information';
                $criteria->with  = array (
                    'tag' => array (
                        'alias' => 'tag',
                        'select' => false,
                    ),
                    'category' => array (
                        'alias' => 'category',
                        'select' => false,
                    ),
                    'author' => array (
                        'alias' => 'author',
                        'select' => false,
                    ),
                );
                $criteria->order = 'timestamp DESC';

                if ( isset( $value ) )
                {
//                        $criteria->compare( 'tag.designation', $value, true,
//                            'OR' );
                        $criteria->compare( 'category.designation', $value,
                            true, 'OR' );
                        $criteria->compare( 'author.username', $value, true,
                            'OR' );
                        $criteria->compare( 'title', $value, true, 'OR' );
                }

                $DataProvider = new CActiveDataProvider( $model,
                    array (
                    'criteria' => $criteria,
                    'pagination' => array (
                        'pageSize' => 10,
                    ),
                    ) );

                $this->render( '_list',
                    array ( 'DataProvider' => $DataProvider, 'model' => $model ) );
        }

        /**
         * Displays the new Information page
         */
        public function actionSave()
        {
                $model         = new Information;
                $modelCategory = new Category;
                $modelTags     = new Tag;
                $modelUser     = new User;

                $categoryList = $this->getData( 'category' );
                $categoryList = $this->formateArray( $categoryList, 'id',
                    'designation' );

                if ( isset( $_POST[ 'Information' ] ) )
                {
                        $user   = $modelUser->getUserByName( $_POST[ 'Information' ][ 'author_id' ] )->findAll();
                        $userID = $user[ 0 ][ 'id' ];

                        $_POST[ 'Information' ][ 'author_id' ] = $userID;

                        $model->attributes = $_POST[ 'Information' ];

                        //@todo saving in db don't work.
                        if ( $model->validate() )
                        {
                                /**
                                 * save form in DB
                                 */
                                $model->save();

                                if ( $model->save() )
                                {
                                        // than you can get id just like that

                                        $informationID                      = $model->id; // this is inserted item id
                                        $_POST[ 'Tag' ][ 'information_id' ] = $informationID;

                                        foreach ( (explode( ",",
                                            $_POST[ 'Tag' ][ 'designation' ] ) ) as $value )
                                        {
                                                $modelTags = new Tag;

                                                $_POST[ 'Tag' ][ 'designation' ]
                                                    = $value;
                                                $modelTags->attributes           = $_POST[ 'Tag' ];

                                                if ( $modelTags->validate() )
                                                {
                                                        $modelTags->save();
                                                }
                                                else
                                                {
                                                        $error = $modelTags->errors;
                                                }
                                        }
                                }

                                /**
                                 * display flash message
                                 */
                                Yii::app()->user->setFlash( 'success',
                                    'Save complete.' );
                                $this->redirect( array ( 'information/index' ) );
                        }
                        else
                        {
                                $error = $model->errors;
                                Yii::app()->user->setFlash( 'error', $error );
                        }
                }
                $this->render( 'save',
                    array ( 'model' => $model, 'modelTags' => $modelTags, 'categoryList' => $categoryList ) );
        }

        public function actionDelete( $id )
        {
                $model    = new Information;
                $modelTag = new Tag();

                $Information = $model->findByPk( $id );
                $aTag        = $modelTag->getByInformatonId( $id )->findAll();
                foreach ( $aTag as $Tag )
                {
                        $Tag->delete();
                }
                $Information->delete();
        }

        /**
         * Displays the view page
         */
        public function actionView( $id )
        {
                $model = new Information;

                $criteria = new CDbCriteria;

                $criteria->alias = 'information';
                $criteria->with  = array (
                    'tag' => array (
                        'select' => false,
                        'alias' => 'tag',
                    ),
                    'category' => array (
                        'select' => false,
                        'alias' => 'category',
                    ),
                    'author' => array (
                        'select' => false,
                        'alias' => 'author',
                    ),
                );
                $criteria->order = 'timestamp DESC';
                $criteria->compare( 'information.id', $id );

                $dataProvider = new CActiveDataProvider( $model,
                    array (
                    'criteria' => $criteria,
                    'pagination' => array (
                        'pageSize' => 10,
                    ),
                    ) );

                $this->render( 'view', array ( 'dataProvider' => $dataProvider ) );
        }

        public function actionEdit( $id )
        {

                $model     = new Information;
                $criteria  = new CDbCriteria;
                $modelUser = new User;

                $categoryList = $this->getData( 'category' );
                $categoryList = $this->formateArray( $categoryList, 'id',
                    'designation' );

                $criteria->alias = 'information';
                $criteria->with  = array (
                    'tag' => array (
                        'select' => false,
                        'alias' => 'tag',
                    ),
                    'category' => array (
                        'select' => false,
                        'alias' => 'category',
                    ),
                    'author' => array (
                        'select' => false,
                        'alias' => 'author',
                    ),
                );
                $criteria->order = 'timestamp DESC';
                $criteria->compare( 'information.id', $id );

                $dataProvider = new CActiveDataProvider( $model,
                    array (
                    'criteria' => $criteria,
                    'pagination' => array (
                        'pageSize' => 10,
                    ),
                    ) );


                $model     = new Information;
                $modelTags = new Tag;

                $dataProvider->getData();
                $aData = $dataProvider->data;

                $model->title       = $aData[ 0 ][ 'title' ];
                $model->content     = $aData[ 0 ][ 'content' ];
                $model->category_id = $aData[ 0 ][ 'category' ];

                foreach ( $aData[ 0 ][ 'tag' ] as $tag )
                {
                        $modelTags->designation = $modelTags->designation . $tag[ 'designation' ] . ",";
                }

                if ( isset( $_POST[ 'Information' ] ) )
                {
                        $user                                  = $modelUser->getUserByName( $_POST[ 'Information' ][ 'author_id' ] )->findAll();
                        $userID                                = $user[ 0 ][ 'id' ];
                        $model                                 = Information::model()->findByPk( $id );
                        $_POST[ 'Information' ][ 'author_id' ] = $userID;

                        $model->title       = $_POST[ 'Information' ][ 'title' ];
                        $model->content     = $_POST[ 'Information' ][ 'content' ];
                        $model->category_id = $_POST[ 'Information' ][ 'category_id' ];

                        //@todo saving in db don't work.
                        if ( $model->validate() )
                        {
                                /**
                                 * save form in DB
                                 */
                                $model->update();

                                if ( $model->update() )
                                {
                                        // than you can get id just like that
                                        $informationID                      = $model->id; // this is inserted item id
                                        $_POST[ 'Tag' ][ 'information_id' ] = $informationID;

                                        $modelTag = Tag::model()->findAll( array (
                                            'condition' => 'information_id=:id',
                                            'params' => array ( ':id' => $id )
                                            ) );

                                        foreach ( $modelTag as $tag )
                                        {
                                                $tag->delete();
                                        }

                                        foreach ( (explode( ",",
                                            $_POST[ 'Tag' ][ 'designation' ] ) ) as $value )
                                        {
                                                $modelTags = new Tag;

                                                $_POST[ 'Tag' ][ 'designation' ]
                                                    = $value;
                                                $modelTags->attributes           = $_POST[ 'Tag' ];

                                                if ( $modelTags->validate() )
                                                {
                                                        $modelTags->save();
                                                }
                                                else
                                                {
                                                        $error = $modelTags->errors;
                                                }
                                        }
                                }

                                /**
                                 * display flash message
                                 */
                                Yii::app()->user->setFlash( 'success',
                                    'Save complete.' );
                                $this->redirect( array ( 'information/index' ) );
                        }
                        else
                        {
                                $error = $model->errors;
                                Yii::app()->user->setFlash( 'error', $error );
                        }
                }

                if ( !Yii::app()->user->isGuest )
                {
                        $this->render( 'edit',
                            array ( 'model' => $model, 'modelTags' => $modelTags,
                            'categoryList' => $categoryList ) );
                }
                else
                {
                        $this->render( 'view' );
                }
        }

        /**
         * get all Data from tabel as array
         *
         * @param type $tabel string eith tabelname
         * @return array
         */
        public function getData( $tabel )
        {
                // set dataProvider for category list.
                $count        = Yii::app()->db->createCommand( 'SELECT COUNT(*) FROM ' . $tabel )->queryScalar();
                $sql          = 'SELECT * FROM ' . $tabel;
                $dataProvider = new CSqlDataProvider( $sql,
                    array (
                    'totalItemCount' => $count,
                    ) );

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
        public function formateArray( $data, $key, $index )
        {
                $list = array ();
                foreach ( $data as $value )
                {
                        $list[ $value[ $key ] ] = $value[ $index ];
                }

                return $list;
        }
}