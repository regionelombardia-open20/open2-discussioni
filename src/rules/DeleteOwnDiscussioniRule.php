<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\discussioni
 * @category   CategoryName
 */

namespace lispa\amos\discussioni\rules;

use lispa\amos\core\rules\DefaultOwnContentRule;
use lispa\amos\discussioni\models\DiscussioniTopic;

class DeleteOwnDiscussioniRule extends DefaultOwnContentRule
{
    public $name = 'deleteOwnDiscussioni';

    public function execute($user, $item, $params)
    {
        if (isset($params['model'])) {
            /** @var Record $model */
            $model = $params['model'];
            if (!$model->id) {
                $post = \Yii::$app->getRequest()->post();
                $get = \Yii::$app->getRequest()->get();
                if (isset($get['id'])) {
                    $model = $this->instanceModel($model, $get['id']);
                } elseif (isset($post['id'])) {
                    $model = $this->instanceModel($model, $post['id']);
                }
            }

            if(($model->status == DiscussioniTopic::DISCUSSIONI_WORKFLOW_STATUS_ATTIVA || $model->status == DiscussioniTopic::DISCUSSIONI_WORKFLOW_STATUS_DAVALIDARE) && $model->created_by == $user){
                return false;
            }

            return ($model->created_by == $user);
        } else {
            return false;
        }
    }
}
