<?php

namespace backend\repositories;

use yii\data\SqlDataProvider;
use yii\db\Query;

class ApplicationRepository
{
    public function getListDataProvider(): SqlDataProvider
    {
        $builder = (new Query())
            ->select(['a.id', 'a.name', 'a.created_at', 'a.updated_at'])
            ->from(['application a'])
            ->innerJoin('application_status as', 'as.id = a.status_id')
            ->addSelect(['as.name as status'])
            ->innerJoin('product p', 'p.id = a.product_id')
            ->addSelect(['p.name as product'])
            ->orderBy(['id' => SORT_DESC]);

        return new SqlDataProvider([
            'sql' => $builder->createCommand()->getRawSql(),
            'pagination' => [
                'pageSize' => 14,
            ]
        ]);
    }
}
