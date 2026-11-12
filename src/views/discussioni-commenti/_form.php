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
 * @var open20\amos\discussioni\models\DiscussioniCommenti $model
 * @var yii\widgets\ActiveForm $form
 */


if (isset($_GET['DiscussioniCommenti'])) {
    
    if (isset($_GET['DiscussioniCommenti']['discussioni_risposte_id'])) {
        $model->discussioni_risposte_id = $_GET['DiscussioniCommenti']['discussioni_risposte_id'];
    }
}

$this->title = AmosDiscussioni::t('amosdiscussioni', 'Commenta la risposta di {rispostaCreatedUserProfile}', [
    'rispostaCreatedUserProfile' => $model->getDiscussioniRisposte()->one()->createdUserProfile,
]);

$this->params['breadcrumbs'][] = [
    'label' =>
        $model->getDiscussioniRisposte()->one()->getDiscussioniTopic()->one()->titolo,
    'url' => [
        '/discussioni/discussioni-topic/partecipa',
        'id' => $model->getDiscussioniRisposte()->one()->getDiscussioniTopic()->one()->id
    ]];

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="discussioni-commenti-form col-xs-12">
    
    <?php $form = ActiveForm::begin(['type' => ActiveForm::TYPE_VERTICAL]); ?>
    <?php $this->beginBlock('dettagli'); ?>

    <div class="col-xs-12 nop">
        
        <?= $form->field($model, 'testo')->textarea(['rows' => 6]) ?>
    </div>

    <div class="col-xs-12 nop" style="display: none">
        <?php
        if ($model->discussioni_risposte_id) {
            echo $form->field($model, 'discussioni_risposte_id')->hiddenInput();
        } else {
            echo $form->field($model, 'discussioni_risposte_id')->dropDownList(
                \yii\helpers\ArrayHelper::map(open20\amos\discussioni\models\DiscussioniRisposte::find()->all(), 'id', 'testo'),
                ['prompt' => AmosDiscussioni::t('amosdiscussioni', 'Seleziona')]
            );
        }
        ?>
    </div>
    <div class="clearfix"></div>
    <?php $this->endBlock('dettagli'); ?>
    
    <?php $itemsTab[] = [
        'label' => AmosDiscussioni::t('amosdiscussioni', 'Dettagli '),
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
