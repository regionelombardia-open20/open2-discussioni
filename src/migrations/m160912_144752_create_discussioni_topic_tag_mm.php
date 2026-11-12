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

use yii\db\Migration;
use yii\db\Schema;

class m160912_144752_create_discussioni_topic_tag_mm extends Migration
{
    const TABLE = '{{%discussioni_topic_tag_mm}}';
    const TABLE_TAG = '{{%tag}}';
    
    public function safeUp()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) === null)
        {
            if ($this->db->schema->getTableSchema(self::TABLE_TAG, true) === null)
            {
                echo "Nessuna creazione eseguita in quanto il modulo TAG sembrerebbe non installato";
                return false;
            }
            else
            {
                $this->createTable(self::TABLE, [
                    'discussioni_topic_id' => Schema::TYPE_INTEGER . " NOT NULL",
                    'tag_id' => Schema::TYPE_INTEGER . " NOT NULL"
                ], $this->db->driverName === 'mysql' ? 'ENGINE=InnoDB' : null);
                $this->addForeignKey('fk_discussioni_topic_has_tag_discussioni_topic1', self::TABLE, 'discussioni_topic_id', 'discussioni_topic', 'id');
                $this->addForeignKey('fk_discussioni_topic_has_tag_tag1', self::TABLE, 'tag_id', 'tag', 'id');
            }
        }
        else
        {
            echo "Nessuna creazione eseguita in quanto la tabella esiste già";
        }
        
        return true;
    }
    
    public function safeDown()
    {
        if ($this->db->schema->getTableSchema(self::TABLE, true) !== null)
        {
            $this->dropForeignKey('fk_discussioni_topic_has_tag_tag1', self::TABLE);
            $this->dropForeignKey('fk_discussioni_topic_has_tag_discussioni_topic1', self::TABLE);
            $this->dropTable(self::TABLE);
        }
        else
        {
            echo "Nessuna cancellazione eseguita in quanto la tabella non esiste";
        }
        
        return true;
    }
}
