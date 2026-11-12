<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\discussioni
 * @author    Aria S.p.A. <protocollo@pec.ariaspa.it>
 * @license   GNU General Public License v3.0 <https://www.gnu.org/licenses/gpl-3.0.html>
 * @link      https://www.ariaspa.it/
 *
 * This file is part of OPEN 2.0.
 *
 * OPEN 2.0 is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * OPEN 2.0 is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with OPEN 2.0. If not, see <https://www.gnu.org/licenses/>.
 */

use open20\amos\core\migration\AmosMigrationWorkflow;
use open20\amos\discussioni\models\DiscussioniTopic;
use yii\helpers\ArrayHelper;

/**
 * Class m170328_161353_add_discussions_workflow_metadata
 */
class m170328_161353_add_discussions_workflow_metadata extends AmosMigrationWorkflow
{
    /**
     * @inheritdoc
     */
    protected function setWorkflow()
    {
        return ArrayHelper::merge(parent::setWorkflow(), [
            // "Modifica in corso" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'BOZZA',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'BOZZA',
                'key' => 'description',
                'value' => 'Discussione in modifica'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'BOZZA',
                'key' => 'label',
                'value' => 'Modifica in corso'
            ],

            // "Da validare" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'description',
                'value' => 'Sottopone a validazione il documento'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'label',
                'value' => 'Da validare'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DAVALIDARE',
                'key' => 'message',
                'value' => 'Vuoi mettere in validazione questa discussione?'
            ],

            // "Validato" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'description',
                'value' => 'La discussione verrà validata'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'label',
                'value' => 'Validata'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'message',
                'value' => 'Vuoi validare questa discussione?'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'ATTIVA',
                'key' => 'order',
                'value' => '1'
            ],

            // "Non validata" status
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'class',
                'value' => 'btn btn-navigation-primary'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'description',
                'value' => 'La discussione non verrà validata'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'label',
                'value' => 'Non validata'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'message',
                'value' => 'Vuoi non validare questa discussione?'
            ],
            [
                'type' => AmosMigrationWorkflow::TYPE_WORKFLOW_METADATA,
                'workflow_id' => DiscussioniTopic::DISCUSSIONI_WORKFLOW,
                'status_id' => 'DISATTIVA',
                'key' => 'order',
                'value' => '2'
            ]
        ]);
    }
}
