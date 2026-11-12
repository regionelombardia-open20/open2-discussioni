<?php
/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos-discussioni
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

use open20\amos\discussioni\models\DiscussioniTopic;

use yii\db\Migration;

class m170606_073900_add_discussioni_slug extends Migration
{
    private 
        $tableName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = DiscussioniTopic::tableName();
        
    }

    /**
     * @inheritdoc
     * @return boolean
     */
    public function safeUp()
    {
        $table = $this->db->getTableSchema($this->tableName);
        if (!isset($table->columns['slug'])) {
            $this->addColumn(
                $this->tableName,
                'slug',
                $this->text()->null()->after('id')
            );
        }
        
        if (!isset($table->columns['close_comment_thread'])) {
            $this->addColumn(
                $this->tableName, 
                'close_comment_thread', 
                $this->boolean()->notNull()->defaultValue(0)->comment('Close discussion')->after('slug')
            );
        }

        return true;
    }

    /**
     * @inheritdoc
     * @return boolean
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName(), 'slug');
        $this->dropColumn($this->tableName(), 'close_comment_thread');

        return true;
    }
}
