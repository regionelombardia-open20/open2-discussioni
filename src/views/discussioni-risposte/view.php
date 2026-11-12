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

use open20\amos\core\utilities\ViewUtility;
use open20\amos\discussioni\AmosDiscussioni;
use kartik\datecontrol\DateControl;
use kartik\detail\DetailView;

/**
 * @var yii\web\View $this
 * @var open20\amos\discussioni\models\DiscussioniRisposte $model
 */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => AmosDiscussioni::t('amosdiscussioni', 'Discussioni Rispostes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discussioni-risposte-view">
<?= DetailView::widget([
    'model' => $model,
    'condensed' => false,
    'hover' => true,
    'mode' => Yii::$app->request->get('edit') == 't' ? DetailView::MODE_EDIT : DetailView::MODE_VIEW,
    'panel' => [
        'heading' => $this->title,
        'type' => DetailView::TYPE_INFO,
    ],
    'attributes' => [
        'id',
        'testo:ntext',
        'discussioni_topic_id',
        [
            'attribute' => 'created_at',
            'format' => ['datetime', ViewUtility::formatDateTime()],
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => DateControl::className(),
                'type' => DateControl::FORMAT_DATETIME
            ]
        ],
        [
            'attribute' => 'updated_at',
            'format' => ['datetime', ViewUtility::formatDateTimeTime()],
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => DateControl::className(),
                'type' => DateControl::FORMAT_DATETIME
            ]
        ],
        [
            'attribute' => 'deleted_at',
            'format' => ['datetime', ViewUtility::formatDateTime()],
            'type' => DetailView::INPUT_WIDGET,
            'widgetOptions' => [
                'class' => DateControl::className(),
                'type' => DateControl::FORMAT_DATETIME
            ]
        ],
        'created_by',
        'updated_by',
        'deleted_by',
        'version',
    ],
    'deleteOptions' => [
        'url' => ['delete', 'id' => $model->id],
        'data' => [
            'confirm' => AmosDiscussioni::t('amosdiscussioni', 'Sei sicuro di voler cancellare questo elemento?'),
            'method' => 'post',
        ],
    ],
    'enableEditMode' => true,
]) ?>
</div>
