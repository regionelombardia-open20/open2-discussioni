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
 * Class m171221_081234_set_dashboard_visible_widget
 */
class m171221_081234_set_dashboard_visible_widget extends Migration
{
    const TABLE = '{{%amos_widgets}}';

    public function safeUp()
    {
        $this->update(self::TABLE, ['dashboard_visible' => 1],
            ['classname' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className()]);
        return true;
    }

    public function safeDown()
    {
        $this->update(self::TABLE, ['dashboard_visible' => 0],
            ['classname' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className()]);
        return true;
    }
}
