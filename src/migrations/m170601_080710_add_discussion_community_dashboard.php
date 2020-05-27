<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 *
 * @package    Open20Package
 * @category   CategoryName
 */


use open20\amos\core\migration\AmosMigrationPermissions;
use open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard;
use yii\helpers\ArrayHelper;
use yii\rbac\Permission;

class m170601_080710_add_discussion_community_dashboard extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => WidgetIconDiscussioniDashboard::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to discussion dashboard',
                'parent' => ['BASIC_USER']
            ],
        ];
    }
}
