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

use open20\amos\discussioni\AmosDiscussioni;

/**
 * Class DiscussioniRisposte
 * This is the base-model class for table "discussioni_risposte".
 *
 * @property integer $id
 * @property string $testo
 * @property integer $discussioni_topic_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 * @property integer $version
 *
 * @property \open20\amos\discussioni\models\DiscussioniCommenti[] $discussioniCommentis
 * @property \open20\amos\discussioni\models\DiscussioniTopic $discussioniTopic
 * @package open20\amos\discussioni\models\base
 * @deprecated from version 1.5.
 */
class DiscussioniRisposte extends \open20\amos\core\record\Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discussioni_risposte';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['testo'], 'string'],
            [['discussioni_topic_id'], 'required'],
            [['discussioni_topic_id', 'created_by', 'updated_by', 'deleted_by', 'version'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosDiscussioni::t('amosdiscussioni', 'ID'),
            'testo' => AmosDiscussioni::t('amosdiscussioni', 'Risposta'),
            'discussioni_topic_id' => AmosDiscussioni::t('amosdiscussioni', 'Discussione'),
            'created_at' => AmosDiscussioni::t('amosdiscussioni', 'Creato il'),
            'updated_at' => AmosDiscussioni::t('amosdiscussioni', 'Aggiornato il'),
            'deleted_at' => AmosDiscussioni::t('amosdiscussioni', 'Cancellato il'),
            'created_by' => AmosDiscussioni::t('amosdiscussioni', 'Creato da'),
            'updated_by' => AmosDiscussioni::t('amosdiscussioni', 'Aggiornato da'),
            'deleted_by' => AmosDiscussioni::t('amosdiscussioni', 'Cancellato da'),
            'version' => AmosDiscussioni::t('amosdiscussioni', 'Versione numero'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussioniCommentis()
    {
        return $this->hasMany(\open20\amos\discussioni\models\DiscussioniCommenti::className(), ['discussioni_risposte_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiscussioniTopic()
    {
        return $this->hasOne(\open20\amos\discussioni\models\DiscussioniTopic::className(), ['id' => 'discussioni_topic_id']);
    }
}
