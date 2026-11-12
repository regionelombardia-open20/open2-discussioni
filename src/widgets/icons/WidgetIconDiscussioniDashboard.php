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

namespace open20\amos\discussioni\widgets\icons;

use open20\amos\core\widget\WidgetIcon;
use open20\amos\core\widget\WidgetAbstract;
use open20\amos\core\icons\AmosIcons;
use open20\amos\dashboard\models\AmosUserDashboards;
use open20\amos\discussioni\AmosDiscussioni;
use open20\amos\discussioni\widgets\icons\WidgetIconDiscussioniTopicAll;
use Yii;
use yii\base\Exception;
use yii\helpers\ArrayHelper;
use yii\web\Application as Web;
use open20\amos\core\record\Record;

/**
 * Class WidgetIconDiscussioni
 * This widget can appear on dashboard. This class is used for creation and general configuration.
 * widget that link to the discussion dashboard
 *
 * @package open20\amos\discussioni\widgets\icons
 */
class WidgetIconDiscussioniDashboard extends WidgetIcon
{
    /*
     * to avoid multiple calling
     */
    protected static $_called = false;

    /**
     * Init of the class, set of general configurations
     */
    public function init()
    {
        parent::init();

        $paramsClassSpan = [
            'bk-backgroundIcon',
            'color-primary'
        ];

        $this->setLabel(AmosDiscussioni::tHtml('amosdiscussioni', 'Discussioni'));
        $this->setDescription(AmosDiscussioni::t('amosdiscussioni', 'Modulo discussioni'));

        if(!empty(Yii::$app->params['twoColorIcons'])){
            $this->setIconFramework(AmosIcons::TWOTONES);
            $this->setIcon('chat');
        }else if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $this->setIconFramework(AmosIcons::IC);
            $this->setIcon('disc');
            $paramsClassSpan = [];
        } else {
            $this->setIcon('comment');
        }

        $this->setUrl(['/discussioni']);
        $this->setCode('DISCUSSIONI_MODULE_001');
        $this->setModuleName('discussioni');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(), $paramsClassSpan
            )
        );

        if (Yii::$app instanceof Web) {
            if ($this->disableBulletCounters == false) {
                $this->setBulletCount(Record::getStaticBullet(Record::BULLET_TYPE_ALL, false, 'discussioni_topic',
                        false, true));
            }
        }
    }

    /**
     * 
     * @param type $userId
     * @param type $className
     * @param type $externalQuery
     * @return type
     */
    public function makeBulletCounter($userId = null, $className = null, $externalQuery = null)
    {
        $widgetAll = \Yii::createObject(WidgetIconDiscussioniTopicAll::className());

        return $widgetAll->getBulletCount();

//        return $this->getBulletCountChildWidgets($userId);
    }
//    /**
//     * 
//     * @param type $userId
//     * @return int - the sum of bulletCount internal widget
//     */
//    private function getBulletCountChildWidgets($userId = null)
//    {
//        $count = 0;
//        try {
//            /** @var AmosUserDashboards $userModuleDashboard */
//            $userModuleDashboard = AmosUserDashboards::findOne([
//                'user_id' => $userId,
//                'module' => AmosDiscussioni::getModuleName()
//            ]);
//
//            if (is_null($userModuleDashboard)) {
//                return 0;
//            }
//
//            $widgetAll = \Yii::createObject(WidgetIconDiscussioniTopicAll::className());
//            $widgetCreatedBy = \Yii::createObject(WidgetIconDiscussioniTopicCreatedBy::className());
//
//            $count = $widgetAll->getBulletCount() + $widgetCreatedBy->getBulletCount();
//        } catch (Exception $ex) {
//            Yii::getLogger()->log($ex->getMessage(), \yii\log\Logger::LEVEL_ERROR);
//        }
//
//        return $count;
//    }

    /**
     * all widgets added to the container object retrieved from the module controller
     * @return array
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
                parent::getOptions(), ['children' => $this->getWidgetsIcon()]
        );
    }

    /**
     * @todo TEMPORARY
     */
    public function getWidgetsIcon()
    {
        $widgets = [];

        $WidgetIconDiscussioniTopicc = new WidgetIconDiscussioniTopic();
        if ($WidgetIconDiscussioniTopicc->isVisible()) {
            $widgets[] = $WidgetIconDiscussioniTopicc->getOptions();
        }

        $WidgetIconDiscussioniTopicCreatedBy = new WidgetIconDiscussioniTopicCreatedBy();
        if ($WidgetIconDiscussioniTopicCreatedBy->isVisible()) {
            $widgets[] = $WidgetIconDiscussioniTopicCreatedBy->getOptions();
        }

        return $widgets;
    }
}