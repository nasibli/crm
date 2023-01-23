<?php

namespace backend\repositories;

use yii\data\SqlDataProvider;
use yii\db\Query;

class UserRepository
{
    public function getListDataProvider(): SqlDataProvider
    {
        $builder = (new Query())
            ->select(['u.id', 'u.email', 'u.status', 'u.created_at', 'u.updated_at'])
            ->from(['user u'])
            ->innerJoin('auth_assignment ur', 'u.id = ur.user_id')
            ->innerJoin('auth_item r', 'ur.item_name = r.name')
            ->addSelect(['r.description'])
            ->orderBy(['id' => SORT_DESC]);

        return new SqlDataProvider([
            'sql' => $builder->createCommand()->getRawSql(),
            'pagination' => [
                'pageSize' => 14,
            ]
        ]);
    }
}
