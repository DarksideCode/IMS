<?php

/**
 * This is the model class for table "tag".
 *
 * The followings are the available columns in table 'tag':
 * @property integer $id
 * @property string $designation
 * @property integer $information_id
 */
class Tag extends CActiveRecord
{

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
                return 'tag';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array (
                    array ( 'designation, information_id', 'required' ),
                    array ( 'information_id', 'numerical', 'integerOnly' => true ),
                    array ( 'designation', 'length', 'max' => 150 ),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array ( 'id, designation, information_id', 'safe', 'on' => 'search' ),
                );
        }

        /**
         * @return array relational rules.
         */
        public function relations()
        {
                // NOTE: you may need to adjust the relation name and the related
                // class name for the relations automatically generated below.
                return array (
                    'information' => array ( self::HAS_ONE, 'Information', array (
                            'id' => 'information_id' ) ),
                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
                return array (
                    'id' => 'ID',
                    'designation' => 'Tag',
                    'information_id' => 'Information',
                );
        }

        /**
         * scoope to get all tags belonging to information with id = $id 
         * @param type $id
         */
        public function getByInformatonId( $id )
        {
                $this->getDbCriteria()->mergeWith( array (
                    'params' => array ( ':information_id' => $id ),
                    'condition' => 'information_id=:information_id', // conditions set here
                ) );
                return $this;
        }

        /**
         * Retrieves a list of models based on the current search/filter conditions.
         *
         * Typical usecase:
         * - Initialize the model fields with values from filter form.
         * - Execute this method to get CActiveDataProvider instance which will filter
         * models according to data in model fields.
         * - Pass data provider to CGridView, CListView or any similar widget.
         *
         * @return CActiveDataProvider the data provider that can return the models
         * based on the search/filter conditions.
         */
        public function search()
        {
                // @todo Please modify the following code to remove attributes that should not be searched.

                $criteria = new CDbCriteria;

                $criteria->compare( 'id', $this->id );
                $criteria->compare( 'designation', $this->designation, true );
                $criteria->compare( 'information_id', $this->information_id );

                return new CActiveDataProvider( $this,
                    array (
                    'criteria' => $criteria,
                ) );
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return Tag the static model class
         */
        public static function model( $className = __CLASS__ )
        {
                return parent::model( $className );
        }
}