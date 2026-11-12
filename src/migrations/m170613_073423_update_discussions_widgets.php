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

use open20\amos\core\migration\AmosMigrationWidgets;

/**
 * Class m170613_073423_update_discussions_widgets
 */
class m170613_073423_update_discussions_widgets extends AmosMigrationWidgets
{
    const MODULE_NAME = 'discussioni';
    
    /**
     * @inheritdoc
     */
    protected function initWidgetsConfs()
    {
        $this->widgets = array_merge(
            $this->initIconWidgetsConf(),
            $this->initGraphicWidgetsConf()
        );
    }
    
    /**
     * Icon widgets configurations
     * @return array
     */
    private function initIconWidgetsConf()
    {
        return [
            [
                'classname' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopic::className(),
                'child_of' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ],
            [
                'classname' => open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicCreatedBy::className(),
                'child_of' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ],
            [
                'classname' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicAll::className(),
                'child_of' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ],
            [
                'classname' => open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicDaValidare::className(),
                'child_of' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ]
        ];
    }
    
    /**
     * Graphic widgets configurations
     * @return array
     */
    private function initGraphicWidgetsConf()
    {
        return [
            [
                'classname' => \open20\amos\discussioni\widgets\graphics\WidgetGraphicsDiscussioniInEvidenza::className(),
                'child_of' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ],
            [
                'classname' => \open20\amos\discussioni\widgets\graphics\WidgetGraphicsUltimeDiscussioni::className(),
                'child_of' => \open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniDashboard::className(),
                'update' => true
            ]
        ];
    }
}
