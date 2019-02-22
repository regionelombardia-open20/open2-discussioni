<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\projectmanagement\rules\workflow
 * @category   CategoryName
 */

namespace lispa\amos\discussioni\rules\workflow;

use lispa\amos\core\rules\ToValidateWorkflowContentRule;

class DiscussioniToValidateWorkflowRule extends ToValidateWorkflowContentRule
{

    public $name = 'discussioniToValidateWorkflow';
    public $validateRuleName = 'DiscussionValidate';

}