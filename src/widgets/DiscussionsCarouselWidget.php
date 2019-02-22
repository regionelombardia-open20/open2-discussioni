<?php

/**
 * Lombardia Informatica S.p.A.
 * OPEN 2.0
 *
 *
 * @package    lispa\amos\discussioni\widgets
 * @category   CategoryName
 */

namespace lispa\amos\discussioni\widgets;

use lispa\amos\core\forms\AmosCarouselWidget;
use lispa\amos\discussioni\models\DiscussioniTopic;
use yii\db\ActiveQuery;

/**
 * Class DiscussionsCarouselWidget
 * @package lispa\amos\discussioni\widgets
 */
class DiscussionsCarouselWidget extends AmosCarouselWidget
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setItems($this->getDiscussionsItems());

        parent::init();
    }

    /**
     * @return array
     */
    protected function getDiscussionsItems()
    {
        $discussionsHighlights = [];
        $highlightsModule = \Yii::$app->getModule('highlights');

        if (!is_null($highlightsModule)) {
            /** @var \amos\highlights\Module $highlightsModule */
            $discussionsHighlightsIds = $highlightsModule->getHighlightedContents(DiscussioniTopic::className());
            /** @var ActiveQuery $query */
            $query = DiscussioniTopic::find();
            $query->distinct();
            $query->andWhere(['id' => $discussionsHighlightsIds]);
            $query->andWhere(['status' => DiscussioniTopic::DISCUSSIONI_WORKFLOW_STATUS_ATTIVA]);
            $discussionsHighlights = $query->all();
        }

        return $discussionsHighlights;
    }
}
