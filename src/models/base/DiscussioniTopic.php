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

namespace open20\amos\discussioni\models\base;

use open20\amos\core\validators\StringHtmlValidator;
use open20\amos\discussioni\AmosDiscussioni;
use open20\amos\notificationmanager\record\NotifyRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the base-model class for table "discussioni_topic".
 *
 * @property integer $id
 * @property string $slug
 * @property string $titolo
 * @property string $testo
 * @property integer $hints
 * @property string $lat
 * @property string $lng
 * @property integer $in_evidenza
 * @property integer $primo_piano
 * @property string $status
 * @property integer $image_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $version
 * @property integer $close_comment_thread
 *
 * @property \open20\amos\discussioni\models\DiscussioniRisposte[] $discussioniRisposte
 * @property \open20\amos\comments\models\Comment[] $discussionComments
 */
abstract class DiscussioniTopic extends \open20\amos\core\record\ContentModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discussioni_topic';
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['testo'], 'string'],
            [['testo'], StringHtmlValidator::className()],
            [['titolo', 'status'], 'required'],
            [['primo_piano','in_evidenza', 'hints', 'created_by', 'updated_by', 'deleted_by', 'version', 'image_id'], 'integer'],
            [['slug', 'close_comment_thread', 'created_at', 'updated_at', 'deleted_at', 'status'], 'safe'],
            [['titolo'], 'string', 'max' => 255]
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'id' => AmosDiscussioni::t('amosdiscussioni', 'ID'),
            'titolo' => AmosDiscussioni::t('amosdiscussioni', '#title_field'),
            'testo' => AmosDiscussioni::t('amosdiscussioni', '#description_field'),
            'hints' => AmosDiscussioni::t('amosdiscussioni', 'Visualizzazioni'),
            'lat' => AmosDiscussioni::t('amosdiscussioni', 'Latitudine'),
            'lng' => AmosDiscussioni::t('amosdiscussioni', 'Longitudine'),
            'in_evidenza' => AmosDiscussioni::t('amosdiscussioni', 'In evidenza'),
            'primo_piano' => AmosDiscussioni::t('amosdiscussioni', 'Vuoi rendere visibile la discussione anche ad utenti non registrati (guest)?'),
            'status' => AmosDiscussioni::t('amosdiscussioni', 'Stato'),
            'image_id' => AmosDiscussioni::t('amosdiscussioni', 'Immagine'),
            'created_at' => AmosDiscussioni::t('amosdiscussioni', 'Creato il'),
            'updated_at' => AmosDiscussioni::t('amosdiscussioni', 'Aggiornato il'),
            'deleted_at' => AmosDiscussioni::t('amosdiscussioni', 'Cancellato il'),
            'created_by' => AmosDiscussioni::t('amosdiscussioni', 'Creato da'),
            'updated_by' => AmosDiscussioni::t('amosdiscussioni', 'Aggiornato da'),
            'deleted_by' => AmosDiscussioni::t('amosdiscussioni', 'Cancellato da'),
            'version' => AmosDiscussioni::t('amosdiscussioni', 'Versione numero'),
        ]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     * @deprecated from version 1.5. Use [[DiscussioniTopic::getDiscussionComments()]] instead of this.
     */
    public function getDiscussioniRisposte()
    {
        return $this->hasMany(\open20\amos\discussioni\models\DiscussioniRisposte::className(), ['discussioni_topic_id' => 'id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussionComments()
    {
        return $this->hasMany(\open20\amos\comments\models\Comment::className(), ['context_id' => 'id'])
            ->andWhere(['context' => \open20\amos\discussioni\models\DiscussioniTopic::className()]);
    }
}
