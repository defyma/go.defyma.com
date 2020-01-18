<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_hash".
 *
 * @property int $id
 * @property int $id_link
 * @property string $hash
 *
 * @property TLink $link
 */
class THash extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_hash';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_link', 'hash'], 'required'],
            [['id_link'], 'integer'],
            [['hash'], 'string', 'max' => 100],
            [['id_link'], 'exist', 'skipOnError' => true, 'targetClass' => TLink::className(), 'targetAttribute' => ['id_link' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_link' => 'Id Link',
            'hash' => 'Hash',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLink()
    {
        return $this->hasOne(TLink::className(), ['id' => 'id_link']);
    }
}
