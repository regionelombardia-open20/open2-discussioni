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

use open20\amos\discussioni\AmosDiscussioni;
use open20\amos\discussioni\models\DiscussioniTopic;
use kartik\datecontrol\DateControl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use open20\amos\admin\models\UserProfile;

/**
 * @var yii\web\View $this
 * @var open20\amos\discussioni\models\search\DiscussioniTopicSearch $model
 * @var yii\widgets\ActiveForm $form
 */

$moduleTag = Yii::$app->getModule('tag');
$discussioniModule = AmosDiscussioni::instance();
$enableAutoOpenSearchPanel = !isset(\Yii::$app->params['enableAutoOpenSearchPanel']) 
    || \Yii::$app->params['enableAutoOpenSearchPanel'] === true;

$currentView = Yii::$app->request->getQueryParam('currentView');
?>
<div class="discussioni-topic-search element-to-toggle" data-toggle-element="form-search">
    <div class="col-xs-12"><p class="h3"><?= AmosDiscussioni::tHtml('amosdiscussioni', 'Cerca per') ?>:</p></div>

    <?php $form = ActiveForm::begin([
        'action' => (isset($originAction) ? [$originAction] : ['index']),
        'method' => 'get',
        'options' => [
            'id' => 'discussioni-topic_form_' . $model->id,
            'class' => 'form',
            'enctype' => 'multipart/form-data',
        ]
    ]);

    echo Html::hiddenInput("enableSearch", $enableAutoOpenSearchPanel);
    echo Html::hiddenInput("currentView", $currentView);
    ?>

    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'titolo') ?>
    </div>

    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'testo') ?>
    </div>

   <!-- <div class="col-sm-6 col-lg-4">
    < ?= $form->field($model, 'created_by')->widget(\kartik\select2\Select2::className(), [
        'data' => (!empty($model->created_by) 
            ? [$model->created_by => UserProfile::findOne(['user_id' => $model->created_by])->getNomeCognome()] 
            : []
        ),
        'options' => ['placeholder' => AmosDiscussioni::t('amosdiscussioni', 'Cerca ...')],
        'pluginOptions' => [
            'allowClear' => true,
            'minimumInputLength' => 3,
            'ajax' => [
                'url' => \yii\helpers\Url::to(['/admin/user-profile-ajax/ajax-user-list']),
                'dataType' => 'json',
                'data' => new \yii\web\JsExpression('function(params) { return {q:params.term}; }')
            ],
        ],
    ]);
    ?>
    </div>

     <div class="col-sm-6 col-lg-4">
        < ?= $form->field($model, 'created_at')->widget(DateControl::className(), [
            'type' => DateControl::FORMAT_DATE
        ]) ?>
    </div>

    <div class="col-sm-6 col-lg-4">
        < ?= $form->field($model, 'updated_at')->widget(DateControl::className(), [
            'type' => DateControl::FORMAT_DATE
        ]) ?>
    </div> -->

    <?php if (isset($moduleTag) && in_array(DiscussioniTopic::className(), $moduleTag->modelsEnabled) && $discussioniModule->searchByTags && $moduleTag->behaviors): ?>
    <div class="col-xs-12">
    <?php
        $params = \Yii::$app->request->getQueryParams();
        echo \open20\amos\tag\widgets\TagWidget::widget([
            'model' => $model,
            'attribute' => 'tagValues',
            'form' => $form,
            'isSearch' => true,
            'form_values' => isset($params[$model->formName()]['tagValues']) ? $params[$model->formName()]['tagValues'] : []
        ]);
    ?>
    </div>
    <?php endif; ?>

    <div class="col-xs-12">
        <div class="pull-right">
        <?= Html::a(
            AmosDiscussioni::t('amosdiscussioni', 'Annulla'), 
            [Yii::$app->controller->action->id, 'currentView' => $currentView],
            ['class'=>'btn btn-secondary']) ?>
        <?= Html::submitButton(AmosDiscussioni::t('amosdiscussioni', 'Cerca'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
</div>
