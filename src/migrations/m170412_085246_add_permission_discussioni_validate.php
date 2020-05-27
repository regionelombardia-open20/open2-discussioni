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
use yii\rbac\Permission;

class m170412_085246_add_permission_discussioni_validate extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => 'DiscussionValidate',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permission to validate a discussion with cwh query',
                'ruleName' => \open20\amos\core\rules\ValidatorUpdateContentRule::className(),
                'parent' => ['VALIDATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONITOPIC_UPDATE',
                'update' => true,
                'newValues' => [
                    'addParents' => ['DiscussionValidate'],
                    'removeParents' => ['VALIDATORE_DISCUSSIONI']
                ]
            ]
        ];
    }
}
