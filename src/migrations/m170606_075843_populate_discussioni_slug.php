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

class m170606_075843_populate_discussioni_slug extends Migration
{
    public function safeUp()
    {

        $topics = DiscussioniTopic::find()
                     ->andWhere(['slug' => null])
                     ->orderBy(['id' => SORT_ASC])
                     ->all();
        
        foreach ($topics as $topic) {
            /**@var $topic \open20\amos\discussioni\models\DiscussioniTopic */
            $topic->detachBehaviors();

            $topic->attachBehavior(
                'slug', 
                [
                    'class' => \yii\behaviors\SluggableBehavior::className(),
                    'attribute' => 'titolo',
                    'slugAttribute' => 'slug',
                    'ensureUnique' => true
                ]
            );

            $topic->validate(['slug']);
            $topic->save(false);

            \yii\helpers\Console::stdout("SLUG: {$topic->slug}\n\n");
        }

        return true;
    }

    public function safeDown()
    {

        return true;
    }
}
