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

use open20\amos\core\migration\AmosMigrationPermissions;
use yii\rbac\Permission;

class m161219_160616_add_permissions_to_amministratore_discussioni extends AmosMigrationPermissions
{
    /**
     * Use this function to map permissions, roles and associations between permissions and roles. If you don't need to
     * to add or remove any permissions or roles you have to delete this method.
     */
    protected function setAuthorizations()
    {
        $this->authorizations = array_merge(
            $this->setDiscussioniTopicAllegatiModelPermissions(),
            $this->setDiscussioniCommentiModelPermissions(),
            $this->setDiscussioniRisposteModelPermissions()
        );
    }

    /**
     * News attachments model permissions
     *
     * @return array
     */
    private function setDiscussioniTopicAllegatiModelPermissions()
    {
        return [
            [
                'name' => 'DISCUSSIONIALLEGATI_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE allegati sul model DiscussioniAllegati',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONIALLEGATI_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ allegati sul model DiscussioniAllegati',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONIALLEGATI_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE allegati sul model DiscussioniAllegati',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONIALLEGATI_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE allegati sul model DiscussioniAllegati',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ]
        ];
    }

    /**
     * DiscussioniCommenti model permissions
     *
     * @return array
     */
    private function setDiscussioniCommentiModelPermissions()
    {
        return [
            [
                'name' => 'DISCUSSIONICOMMENTI_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model DiscussioniCommenti',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONICOMMENTI_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model DiscussioniCommenti',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONICOMMENTI_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model DiscussioniCommenti',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONICOMMENTI_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model DiscussioniCommenti',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ]
        ];
    }

    /**
     * DiscussioniRisposte model permissions
     *
     * @return array
     */
    private function setDiscussioniRisposteModelPermissions()
    {
        return [
            [
                'name' => 'DISCUSSIONIRISPOSTE_CREATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di CREATE sul model DiscussioniRisposte',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONIRISPOSTE_READ',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di READ sul model DiscussioniRisposte',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONIRISPOSTE_UPDATE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di UPDATE sul model DiscussioniRisposte',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ],
            [
                'name' => 'DISCUSSIONIRISPOSTE_DELETE',
                'type' => Permission::TYPE_PERMISSION,
                'description' => 'Permesso di DELETE sul model DiscussioniRisposte',
                'ruleName' => null,
                'parent' => ['AMMINISTRATORE_DISCUSSIONI']
            ]
        ];
    }
}
