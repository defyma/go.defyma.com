<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "t_click".
 *
 * @property int $id
 * @property int $id_link
 * @property string $click_date
 * @property string $click_ip
 * @property string $browser
 *
 * @property TLink $link
 */
class TClick extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_click';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_link', 'click_date', 'click_ip', 'browser'], 'required'],
            [['id_link'], 'integer'],
            [['click_date'], 'safe'],
            [['browser'], 'string'],
            [['click_ip'], 'string', 'max' => 20],
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
            'click_date' => 'Click Date',
            'click_ip' => 'Click Ip',
            'browser' => 'Browser',
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
