<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\admin\migrations
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

use open20\amos\community\models\Community;
use yii\db\Migration;

/**
 * Class m190607_152618_add_discussion_close_discussion
 */
class m190607_152618_add_discussion_close_discussion extends Migration
{
    private 
        $tableName,
        $fieldName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = \open20\amos\discussioni\models\DiscussioniTopic::tableName();
        $this->fieldName = 'close_comment_thread';
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        
        $table = $this->db->getTableSchema($this->tableName);
        if (!isset($table->columns[$this->fieldName])) {
            $this->addColumn($this->tableName, $this->fieldName, $this->boolean()->notNull()->defaultValue(0)->comment('Close discussion'));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, $this->fieldName);
        return true;
    }
}
