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
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var \open20\amos\discussioni\models\search\DiscussioniTopicSearch $model
 * @var yii\widgets\ActiveForm $form
 */
$currentView = Yii::$app->request->getQueryParam('currentView');
?>

<div class="discussioni-topic-order element-to-toggle" data-toggle-element="form-order">
    <div class="col-xs-12">
        <p class="h3"><?= AmosDiscussioni::t('amosdiscussioni', 'Ordina per') ?>:</p>
    </div>

    <?php $form = ActiveForm::begin([
        'action' => Yii::$app->controller->action->id,
        'method' => 'get',
        'options' => [
            'class' => 'default-form'
        ]
    ]);
    echo Html::hiddenInput("currentView", $currentView); ?>
    
    <div class="col-sm-6 col-lg-4">
        <?php $orderLabels = $model->getOrderAttributesLabels();
        foreach ($orderLabels as $value => $label){
            $orderLabels[$value] = AmosDiscussioni::t('amosdiscussioni', $label);
        }?>
        <?= $form->field($model, 'orderAttribute')->dropDownList($orderLabels) ?>
    </div>
    
    <div class="col-sm-6 col-lg-4">
    <?= $form->field($model, 'orderType')->dropDownList([
        SORT_ASC => AmosDiscussioni::t('amosdiscussioni', 'Crescente'),
        SORT_DESC => AmosDiscussioni::t('amosdiscussioni', 'Decrescente'),
    ])
    ?>
    </div>

    <div class="col-xs-12">
        <div class="pull-right">
        <?= Html::a(
            AmosDiscussioni::t('amosdiscussioni', 'Annulla'), 
            [Yii::$app->controller->action->id, 'currentView' => $currentView],
            ['class'=>'btn btn-secondary']) ?>
        <?= Html::submitButton(AmosDiscussioni::t('amosdiscussioni', 'Ordina'), ['class' => 'btn btn-navigation-primary']) ?>
        </div>
    </div>

    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>

</div>
