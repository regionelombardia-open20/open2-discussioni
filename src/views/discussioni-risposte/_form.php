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

use open20\amos\core\forms\CloseSaveButtonWidget;
use open20\amos\core\forms\CreatedUpdatedWidget;
use open20\amos\discussioni\AmosDiscussioni;
use kartik\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var open20\amos\discussioni\models\DiscussioniRisposte $model
 * @var yii\widgets\ActiveForm $form
 */

if (isset($_GET['DiscussioniRisposte'])) {
    
    if (isset($_GET['DiscussioniRisposte']['discussioni_topic_id'])) {
        $model->discussioni_topic_id = $_GET['DiscussioniRisposte']['discussioni_topic_id'];
    }
}

$this->title = AmosDiscussioni::t('amosdiscussioni', 'Rispondi a {discussioneNome}', [
    'discussioneNome' => $model->getDiscussioniTopic()->one()->titolo,
]);
$this->params['breadcrumbs'][] = ['label' => $model->getDiscussioniTopic()->one()->titolo, 'url' => ['/discussioni/discussioni-topic/partecipa', 'id' => $model->getDiscussioniTopic()->one()->id
]];
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="discussioni-risposte-form col-xs-12">
    
    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]); ?>
    <?php $this->beginBlock('dettagli'); ?>

    <div class="col-xs-12">
        
        <?= $form->field($model, 'testo')->textarea(['rows' => 6]) ?>

    </div>

    <div class="col-xs-12 nop" style="display: none">
        
        <?php
        if ($model->discussioni_topic_id) {
            echo $form->field($model, 'discussioni_topic_id')->hiddenInput();
        } else {
            echo $form->field($model, 'discussioni_topic_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(open20\amos\discussioni\models\DiscussioniTopic::find()->all(), 'id', 'titolo'),
                ['prompt' => AmosDiscussioni::t('amosdiscussioni', 'Seleziona')]
            );
        }
        
        ?>
    </div>
    <div class="clearfix"></div>
    <?php $this->endBlock('dettagli'); ?>
    
    <?php $itemsTab[] = [
        'label' => AmosDiscussioni::t('amosdiscussioni', 'Dettagli') . ' ',
        'content' => $this->blocks['dettagli'],
    ];
    ?>
    
    <?= Tabs::widget(
        [
            'encodeLabels' => false,
            'items' => $itemsTab
        ]
    );
    ?>
    
    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>
