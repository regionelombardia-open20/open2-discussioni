<?php

use yii\db\Migration;

/**
 * Class m181026_163401_add_primo_piano_field
 */
class m181026_163401_add_primo_piano_field extends Migration
{
     public function safeUp()
    {

        $this->addColumn(\lispa\amos\discussioni\models\DiscussioniTopic::tableName(), 'primo_piano',
            $this->text()
                ->null()
                ->after('in_evidenza')
        );

        return true;
    }

    public function safeDown()
    {
        $this->dropColumn(\lispa\amos\discussioni\models\DiscussioniTopic::tableName(), 'primo_piano');

        return true;
    }
}
