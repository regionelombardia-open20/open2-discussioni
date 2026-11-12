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

?>
<div class="listview-container">

    <div class="bk-listViewElement">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-2">
            <img class="img-responsive" src="<?= $model->creatoreDiscussione->getAvatarUrl('small') ?>" alt="<?= $model ?>"/>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-10">
            <h2><?= $model ?></h2>

            <h3><?= $model->titolo ?></h3>
        </div>

        <div class="bk-elementActions">
            <a href="/discussioni/discussioni-topic/partecipa?id=<?= $model->id ?>" title="partecipa">
                <button class="btn btn-success">
                    <?= AmosDiscussioni::t('amosdiscussioni', 'Visualizza') ?>
                </button>
            </a>
        </div>
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
 