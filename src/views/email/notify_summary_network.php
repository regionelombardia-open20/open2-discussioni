<?php
use \open20\amos\notificationmanager\AmosNotify;
?>
<?php foreach ($arrayModels as $model) {
    $url = '/img/img_default.jpg';
    if (!is_null($model->discussionsTopicImage)) {
        $url = $model->discussionsTopicImage->getUrl('original', false, true);
    }
//
            $count = 0;
            if(!empty($arrayModelsComments)) {
//                $count = count($arrayModelsComments);
//                echo "<h2>$count Commenti nuovi</h2>";
                if(!empty($arrayModelsComments[$model->id])) {
                    $count = count($arrayModelsComments[$model->id]);
//                    foreach ($arrayModelsComments[$model->id] as $comment) {
//                        echo $this->render('content_comment', ['comment' => $comment]);
//                    }
                }
            }
            if($count == 1){
                $nuovoText = AmosNotify::t('amosnotify', 'nuovo commento');
            } else {
                $nuovoText = AmosNotify::t('amosnotify', 'nuovi commenti');
            }
    ?>


    <tr>
        <td colspan="2" style="padding-bottom:10px;">
            <table width="100%">
                <tr>
                    <td valigh="top" style="font-size:16px; font-weight:bold; padding: 5px 15px 5px 0px; font-family: sans-serif; text-align:left; vertical-align:top;"><p style="margin:0 0 5px 0">
                            <?= \yii\helpers\Html::a($model->getTitle(), Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()), ['style' => 'color: #000;']) ?>
                            <?php if($count > 0) { ?>
                                <span style="display: inline-block; margin: 2px;text-transform: uppercase; color: #D44141; border: 1px solid #D44141; height: 16px; line-height: 16px; font-size: 10px; vertical-align:top; padding: 0 5px;" class="tag">
                                    <?= $count ?> <?= $nuovoText ?>
                                </span></p>
                            <?php } ?>
                    </td>
                </tr>
                <tr>
                    <td style="padding:0 0 10px 0; border-bottom:1px solid #D8D8D8;">
                        <table width="100%">
                            <tr>
                                <td width="400" style="text-align:left;">
                                    <table width="100%">
                                        <tr>
                                            <td style="box-sizing:border-box;padding-bottom: 5px;">
                                                <div style="margin-top:20px; display: flex; padding: 10px;">
                                                    <?= \open20\amos\core\forms\ItemAndCardHeaderWidget::widget([
                                                        'model' => $model,
                                                        'publicationDateNotPresent' => true,
                                                        'showPrevalentPartnershipAndTargets' => true,
                                                        'absoluteUrlAvatar' => true,
                                                    ]); ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php if($count ==1){
                                            $comment = $arrayModelsComments[$model->id][0];
                                            $textComment = '';
                                            if(!empty($comment)){
                                                $textComment = $comment->comment_text;
                                            }?>
                                            <tr>
                                                <td>
                                                    <em style="font-family: sans-serif; font-size:14px; color:#000">"<?= $textComment ?>"</em>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </table>
                                </td>
                                <td align="right" width="85" height="20" valign="bottom" style="text-align: center; padding-left: 10px;"><a href="<?=  Yii::$app->urlManager->createAbsoluteUrl($model->getFullViewUrl()) ?>" style="background: #D44141; border:3px solid #D44141; color: #ffffff; font-family: sans-serif; font-size: 11px; line-height: 22px; text-align: center; text-decoration: none; display: block; font-weight: bold; text-transform: uppercase; height: 20px;" class="button-a">
                                        <!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->Rispondi<!--[if mso]>&nbsp;&nbsp;&nbsp;&nbsp;<![endif]-->
                                    </a></td>
                            </tr>

                        </table>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
<!--                --><?php
//            if(!empty($arrayModelsComments)) {
//                $count = count($arrayModelsComments);
//                echo "<h2>$count Commenti nuovi</h2>";
//                if(!empty($arrayModelsComments[$model->id])) {
//                    foreach ($arrayModelsComments[$model->id] as $comment) {
//                        echo $this->render('content_comment', ['comment' => $comment]);
//                    }
//                }
//            }?>
<?php } ?>