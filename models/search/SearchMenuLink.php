<?php

namespace arteam\menu\models\search;

use arteam\models\MenuLink;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use arteam\helpers\ArteamHelper;
use arteam\models\OwnerAccess;
use arteam\models\User;

/**
 * SearchMenuLink represents the model behind the search form about `arteam\menu\models\MenuLink`.
 */
class SearchMenuLink extends MenuLink
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order', 'alwaysVisible', 'created_by', 'updated_by'], 'integer'],
            [['id', 'menu_id', 'parent_id', 'link', 'label', 'image', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params = [])
    {
        $queryParams = Yii::$app->request->getQueryParams();
        $query = MenuLink::find()->joinWith('translations');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => -1,
            ],
            'sort' => [
                'defaultOrder' => [
                    'order' => SORT_ASC,
                ],
            ],
        ]);

        $this->load($queryParams);

        foreach ($params as $key => $value) {
            $this->$key = $value;
        }

        $restrictLinkAccess = (ArteamHelper::isImplemented(MenuLink::className(), OwnerAccess::CLASSNAME)
            && !User::hasPermission(MenuLink::getFullAccessPermission()));

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($restrictLinkAccess) {
            $query->andFilterWhere([MenuLink::getOwnerField() => Yii::$app->user->identity->id]);
        }

        $query->andWhere(['menu_id' => $this->menu_id])
            ->andFilterWhere(['alwaysVisible' => $this->alwaysVisible])
            ->andFilterWhere(['like', 'id', $this->id])
            ->andWhere(['parent_id' => $this->parent_id]);

        return $dataProvider;
    }
}