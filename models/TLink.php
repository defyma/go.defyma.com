<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Expression;

/**
 * This is the model class for table "t_link".
 *
 * @property int $id
 * @property string $link
 * @property string $created_date
 * @property string $created_ip
 *
 * @property TClick[] $tClicks
 * @property THash[] $tHashes
 */
class TLink extends \yii\db\ActiveRecord
{
    public $original_url, $short_url, $click;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 't_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['link', 'created_date', 'created_ip'], 'required'],
            [['link'], 'string'],
            [['created_date'], 'safe'],
            [['created_ip'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'link' => 'Link',
            'created_date' => 'Created Date',
            'created_ip' => 'Created Ip',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTClicks()
    {
        return $this->hasMany(TClick::className(), ['id_link' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTHashes()
    {
        return $this->hasMany(THash::className(), ['id_link' => 'id']);
    }

    public function search($params)
    {
        $query = TLink::find()
            ->select([
                't_link.id',
                't_link.link original_url',
                't_link.created_date',
                'concat("'.Yii::$app->params['domain'].'",a.hash) short_url',
                new Expression('(select count(id) from t_click where t_click.id_link = t_link.id ) as click')
            ])
            ->innerJoin('t_hash a', 'a.id_link = t_link.id');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        return $dataProvider;
    }
}
