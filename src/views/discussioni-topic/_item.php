<?php

/**
 * Aria S.p.A.
 * OPEN 2.0
 *
 * @package   open20\amos\discussioni\views\discussioni-topic
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

use open20\amos\admin\utility\UserProfileUtility;
use open20\amos\core\forms\ContextMenuWidget;
use open20\amos\core\forms\ItemAndCardHeaderWidget;
use open20\amos\core\helpers\Html;
use open20\amos\discussioni\AmosDiscussioni;
use open20\amos\notificationmanager\forms\NewsWidget;

/**
 * @var \open20\amos\discussioni\models\DiscussioniTopic $model
 */

/** @var AmosDiscussioni $module */
$module = AmosDiscussioni::instance();

$discussionTitle = $model->titolo;
$creatoreDiscussione = $model->createdUserProfile;
if (is_null($creatoreDiscussione) || ($creatoreDiscussione->nome == UserProfileUtility::DELETED_ACCOUNT_NAME)) {
    $nomeCreatoreDiscussione = AmosDiscussioni::t('amosdiscussioni', 'Utente Cancellato');
} else {
    $nomeCreatoreDiscussione = $creatoreDiscussione->nomeCognome;
}

$dataPubblicazione = Yii::$app->getFormatter()->asDatetime($model->created_at);
$ultima_attivita = Yii::$app->getFormatter()->asDate($model->updated_at);
$viewUrl = $model->getFullViewUrl();

?>

<div class="listview-container discussion-topic-container discussion-topic-container-list m-b-20">
    <div>
        <div>
            <!--discussioni container -->
            <div class="discussion-container py-3 border-bottom border-light ">
                <div class="info-container row align-items-center variable-gutters">
                    <div class="generic-info flexbox m-b-10 col-md-12 col-xs-12 ">                       
                        <div class="post-title">
                            <?= Html::a(
                                Html::tag('div', $discussionTitle, [
                                    'class' => 'no-margin title-discussion'
                                ]),
                                $viewUrl,
                                ['class' => 'link-list-title']
                            ) ?>
                        </div>
                        <div class="right-cta-container flexbox">
                            <?= ContextMenuWidget::widget([
                                'model' => $model,
                                'actionModify' => "/discussioni/discussioni-topic/update?id=" . $model->id,
                                'actionDelete' => "/discussioni/discussioni-topic/delete?id=" . $model->id,
                                'labelDeleteConfirm' => AmosDiscussioni::t('amosdiscussioni', '#ask_confirm_to_cancel_discussion'),
                                'modelValidatePermission' => 'DiscussionValidate'
                            ]) ?>
                            <?= NewsWidget::widget(['model' => $model]); ?>
                        </div>

                       
                    </div>

                    <div class="user-list-container py-3 col-sm-6 col-xs-12 flexbox ">
                         <!--TODO: Community collegata -->
                        <!--<div class="mb-1 community-title small text-muted"><strong>Community:</strong> TODO</div>-->
                        <div class="flexbox last-line small">
                            <div class="other-info flexbox">
                                <div class="flexbox flex-wrap">
                                    <div class="pr-3 mb-0 "><span class="mdi mdi-calendar m-r-5"></span><?= $dataPubblicazione ?></div>
                                </div>
                            </div>
                            <?= Html::a(
                                Html::tag('strong', AmosDiscussioni::t('amosdiscussioni', 'Partecipate')),
                                $viewUrl,
                                [
                                    'title' => AmosDiscussioni::t('amosdiscussioni', '#participate_to_discussion_topic') . ' ' . $discussionTitle,
                                    'class' => 'fullsize-cta text-uppercase ml-md-0',
                                ]
                            ) ?>
                        </div>
                    </div>

                    <div class="user-list-container py-3 col-xs-6 col-sm-2 flexbox ">
                        <?php
                        $comments = $model->getDiscussionComments();
                        $commentsNumber = $comments->count();
                        
                        //numero partecipanti
                        $partecipanti = $comments->groupBy('created_by')->count();
                        
                        $noComments = false;
                        $commentsNumberString = $commentsNumber;
                        
                        $numeroVisualizzazioni = $model->hints;
                        if (!$numeroVisualizzazioni) {
                            $numeroVisualizzazioni = 0;
                        }
                        $attributeModel = $model->getDiscussionsAttachments();
                        
                        $numeroAllegati = (is_array($attributeModel)) ? count($attributeModel) : 0;
                        ?>
                        <!--admin discussione-->
                        <div class="m-r-5" data-toggle="tooltip" title="<?= $nomeCreatoreDiscussione; ?>">
                            <?= ItemAndCardHeaderWidget::widget([
                                'model' => $model,
                                'publicationDateField' => 'created_at',
                                'class' => 'no-margin nop',
                                'enableLink' => false,
                            ]) ?>

                        </div>

                        <!--lista utenti-->
                        <!--  <div class="partecipant-list" data-toggle="tooltip" title="Partecipanti">
 
 
                             < ?php
                             $participants = $model->commentsUsersAvatars();
                             $numberPartecipants = count($participants);
                             if ($numberPartecipants <= 4) {
                                 foreach ($participants as $participant) {
                                     if ($participant) {
                                         echo UserCardWidget::widget(['model' => $participant, 'avatarXS' => true, 'enableLink' => false]);
                                     }
                                 }
                             } else {
                                 for ($i = 0; $i < 4; $i++) {
                                     echo UserCardWidget::widget(['model' => $participants[$i], 'avatarXS' => true, 'enableLink' => false]);
                                 } ?>
 
                                 >= di cinque
                                 <div class="count-partecipants container-round-img-xs text-center">
                                     <p>+< ?= $numberPartecipants - 2 ?></p>
                                 </div>
                             < ?php } ?>
                         </div> -->
                    </div>

                    <div class="third-column col-sm-4 col-xs-6 justify-content-between flexbox small">

                        <div class="flexbox align-items-center" data-toggle="tooltip" title="<?= AmosDiscussioni::t('amosdiscussioni', 'Numero di risposte'); ?>">
                            <span class="am am-comment-outline"></span>
                            <?= $commentsNumberString ?>
                        </div>

                        <div class="flexbox align-items-center" data-toggle="tooltip" title="<?= AmosDiscussioni::t('amosdiscussioni', 'Numero di visite'); ?>">
                            <span class="am am-eye"></span>
                            <?= $numeroVisualizzazioni ?>
                        </div>

                        <div class="flexbox align-items-center" data-toggle="tooltip" title="<?= AmosDiscussioni::t('amosdiscussioni', 'Ultima attività'); ?>">
                            <span class="am am-time"></span>
                            <?php
                            // /** @var DiscussioniTopic $model */
                            // if ($model->lastCommentUser) {
                            //     $ultima_risposta = $model->lastCommentUser->nome . ' ' . $model->lastCommentUser->cognome;
                            //     $data = ' ' . Yii::$app->formatter->asDatetime($model->lastCommentDate);
                            
                            //     echo $ultima_risposta . $data;
                            // } else {
                            //     echo AmosDiscussioni::t('amosdiscussioni', 'Non ci sono ancora contributi');
                            // }
                            echo $ultima_attivita;
                            ?>
                        </div>
                    </div>
                </div>
                <!--fine discussioni container-->
            </div>
        </div>
    </div>
</div>
