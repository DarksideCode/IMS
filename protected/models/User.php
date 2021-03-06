<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $username
 * @property string $password
 */
class User extends CActiveRecord
{

        /**
         * @return string the associated database table name
         */
        public function tableName()
        {
                return 'user';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array (
                    array ( 'firstname, lastname, email, username, password', 'required' ),
                    array ( 'firstname', 'length', 'max' => 50 ),
                    array ( 'lastname', 'length', 'max' => 75 ),
                    array ( 'email, username', 'length', 'max' => 150 ),
                    array ( 'password', 'length', 'max' => 200 ),
                    // The following rule is used by search().
                    // @todo Please remove those attributes that should not be searched.
                    array ( 'id, firstname, lastname, email, username, password',
                        'safe', 'on' => 'search' ),
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
                    'information' => array ( self::HAS_MANY, 'Information', array (
                            'author_id' => 'id' ) ),
                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
                return array (
                    'id' => 'ID',
                    'firstname' => 'Vorname',
                    'lastname' => 'Nachname',
                    'email' => 'e-mail',
                    'username' => 'Nutzername',
                    'password' => 'Password',
                );
        }

        /**
         *
         * @param type strin
         * @return \User
         */
        public function getUserByName( $user )
        {
                $this->getDbCriteria()->mergeWith( array (
                    'condition' => 'username=:username',
                    'params' => array ( ':username' => $user ),
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
                $criteria->compare( 'firstname', $this->firstname, true );
                $criteria->compare( 'lastname', $this->lastname, true );
                $criteria->compare( 'email', $this->email, true );
                $criteria->compare( 'username', $this->username, true );
                $criteria->compare( 'password', $this->password, true );

                return new CActiveDataProvider( $this,
                    array (
                    'criteria' => $criteria,
                    ) );
        }

        /**
         * Returns the static model of the specified AR class.
         * Please note that you should have this exact method in all your CActiveRecord descendants!
         * @param string $className active record class name.
         * @return User the static model class
         */
        public static function model( $className = __CLASS__ )
        {
                return parent::model( $className );
        }
}