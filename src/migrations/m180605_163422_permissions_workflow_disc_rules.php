<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\community\migrations
 * @category   CategoryName
 */

use lispa\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

/**
 * Class m170719_122922_permissions_community
 */
class m180605_163422_permissions_workflow_disc_rules extends AmosMigrationPermissions
{
    /**
     * @inheritdoc
     */
    protected function setRBACConfigurations()
    {
        return [
            [
                'name' => \lispa\amos\discussioni\rules\workflow\DiscussioniToValidateWorkflowRule::className(),
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Check permissio to validate',
                'ruleName' => \lispa\amos\discussioni\rules\workflow\DiscussioniToValidateWorkflowRule::className(),
                'parent' => ['CREATORE_DISCUSSIONI', 'FACILITATORE_DISCUSSIONI', 'DiscussionValidate', 'VALIDATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DiscussioniTopicWorkflow/DAVALIDARE',
                'update' => true,
                'newValues' => [
                    'addParents' => [
                        \lispa\amos\discussioni\rules\workflow\DiscussioniToValidateWorkflowRule::className()
                    ],
                    'removeParents' => [
                        'CREATORE_DISCUSSIONI', 'FACILITATORE_DISCUSSIONI', 'DiscussionValidate', 'VALIDATORE_DISCUSSIONI'
                    ]
                ],
            ],

        ];
    }
}
