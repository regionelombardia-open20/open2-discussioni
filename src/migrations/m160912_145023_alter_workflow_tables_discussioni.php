<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\discussioni\migrations
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

use yii\db\Migration;

/**
 * Class m160912_145023_alter_workflow_tables_discussioni
 */
class m160912_145023_alter_workflow_tables_discussioni extends Migration
{
    const TABLE_WORKFLOW = '{{%sw_workflow}}';
    const TABLE_WORKFLOW_STATUS = '{{%sw_status}}';
    const TABLE_WORKFLOW_TRANSITIONS = '{{%sw_transition}}';
    const TABLE_WORKFLOW_METADATA = '{{%sw_metadata}}';
    const DEFAULT_CHARSET = ", CHARACTER SET utf8 COLLATE utf8_unicode_ci";
    
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS=0;')->execute();
        
        $this->db->createCommand("ALTER TABLE " . self::TABLE_WORKFLOW . " CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci")->execute();
        $this->alterColumn(self::TABLE_WORKFLOW, 'id', $this->string(255)->notNull()->append(self::DEFAULT_CHARSET));
        $this->alterColumn(self::TABLE_WORKFLOW, 'initial_status_id', $this->string(255)->null()->append(self::DEFAULT_CHARSET));
        
        $this->db->createCommand("ALTER TABLE " . self::TABLE_WORKFLOW_STATUS . " CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci")->execute();
        $this->alterColumn(self::TABLE_WORKFLOW_STATUS, 'id', $this->string(255)->notNull()->append(self::DEFAULT_CHARSET));
        $this->alterColumn(self::TABLE_WORKFLOW_STATUS, 'workflow_id', $this->string(255)->notNull()->append(self::DEFAULT_CHARSET));
        $this->alterColumn(self::TABLE_WORKFLOW_STATUS, 'label', $this->string(255)->null()->append(self::DEFAULT_CHARSET));
        
        $this->db->createCommand("ALTER TABLE " . self::TABLE_WORKFLOW_TRANSITIONS . " CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci")->execute();
        $this->alterColumn(self::TABLE_WORKFLOW_TRANSITIONS, 'workflow_id', $this->string(255)->notNull()->append(self::DEFAULT_CHARSET));
        $this->alterColumn(self::TABLE_WORKFLOW_TRANSITIONS, 'start_status_id', $this->string(255)->notNull()->append(self::DEFAULT_CHARSET));
        $this->alterColumn(self::TABLE_WORKFLOW_TRANSITIONS, 'end_status_id', $this->string(255)->notNull()->append(self::DEFAULT_CHARSET));
        
        $this->db->createCommand("ALTER TABLE " . self::TABLE_WORKFLOW_METADATA . " CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci")->execute();
        $this->alterColumn(self::TABLE_WORKFLOW_METADATA, 'workflow_id', $this->string(255)->notNull()->append(self::DEFAULT_CHARSET));
        $this->alterColumn(self::TABLE_WORKFLOW_METADATA, 'status_id', $this->string(255)->notNull()->append(self::DEFAULT_CHARSET));
        $this->alterColumn(self::TABLE_WORKFLOW_METADATA, '`key`', $this->string(255)->notNull()->append(self::DEFAULT_CHARSET));
        $this->alterColumn(self::TABLE_WORKFLOW_METADATA, 'value', $this->string(255)->null()->append(self::DEFAULT_CHARSET));
        
        $this->db->createCommand('SET FOREIGN_KEY_CHECKS=1;')->execute();
        
        return true;
    }
    
    /**
     * Use this instead of function down().
     */
    public function safeDown()
    {
        echo "Reverting alter to workflow tables is not expected.\n";
        return true;
    }
}
