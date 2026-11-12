<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\discussioni\widgets\graphics
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

namespace open20\amos\discussioni\widgets\graphics;

use open20\amos\core\widget\WidgetGraphic;
use open20\amos\discussioni\AmosDiscussioni;
use open20\amos\discussioni\models\search\DiscussioniTopicSearch;
use open20\amos\notificationmanager\base\NotifyWidgetDoNothing;

/**
 * Class WidgetGraphicsCmsUltimeDiscussioni
 * informational widget that lists the latest discussions
 *
 * @package open20\amos\discussioni\widgets\graphics
 */
class WidgetGraphicsCmsUltimeDiscussioni extends WidgetGraphic
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $this->setCode('ULTIME_DISCUSSIONI_GRAPHIC');
        $this->setLabel(AmosDiscussioni::t('amosdiscussioni', '#widget_graphic_cms_last_discussions_label'));
        $this->setDescription(AmosDiscussioni::t('amosdiscussioni', '#widget_graphic_cms_last_discussions_description'));
    }
    
    /**
     * Rendering of the view ultime_discussioni
     *
     * @return string
     */
    public function getHtml()
    {
        $search = new DiscussioniTopicSearch();
        $search->setNotifier(new NotifyWidgetDoNothing());
        $listaTopic = $search->ultimeDiscussioni($_GET, AmosDiscussioni::MAX_LAST_DISCUSSION_ON_DASHBOARD);
        
        $viewPath = '@vendor/open20/amos-discussioni/src/widgets/graphics/views/';
        $viewToRender = $viewPath . 'ultime_discussioni_cms';
        if (is_null(\Yii::$app->getModule('layout'))) {
            $viewToRender .= '_old';
        }
        
        if (isset(\Yii::$app->params['showWidgetEmptyContent']) && \Yii::$app->params['showWidgetEmptyContent'] == false) {
            if ($listaTopic->getTotalCount() == 0) {
                return false;
            }
        }
        
        return $this->render(
            $viewToRender,
            [
                'listaTopic' => $listaTopic,
                'widget' => $this,
                'toRefreshSectionId' => 'widgetGraphicLatestThreads'
            ]
        );
    }
}
