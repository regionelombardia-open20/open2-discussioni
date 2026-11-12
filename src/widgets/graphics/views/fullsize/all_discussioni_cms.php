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

use open20\amos\discussioni\widgets\graphics\WidgetGraphicsUltimeDiscussioni;
use yii\data\ActiveDataProvider;
use yii\web\View;
use open20\amos\discussioni\assets\ModuleDiscussioniInterfacciaAsset;
use open20\amos\core\utilities\CurrentUser;

/**
 * @var View $this
 * @var ActiveDataProvider $listaTopic
 * @var WidgetGraphicsUltimeDiscussioni $widget
 * @var string $toRefreshSectionId
 */

$moduleDiscussioni = \Yii::$app->getModule(AmosDiscussioni::getModuleName());
$listaModels = $listaTopic->getModels();
ModuleDiscussioniInterfacciaAsset::register($this);

$userModule = CurrentUser::getUserProfile();
?>

<?php
$modelLabel = 'discussioni';

$titleSection = AmosDiscussioni::t('amosdiscussioni', 'Discussioni');
$urlLinkAll = '/discussioni/discussioni-topic/all-discussions';
$labelLinkAll = AmosDiscussioni::t('amosdiscussioni', 'Tutte le discussioni');
$titleLinkAll = AmosDiscussioni::t('amosdiscussioni', 'Visualizza la lista delle discussioni');

$labelCreate = AmosDiscussioni::t('amosdiscussioni', 'Nuova');
$titleCreate = AmosDiscussioni::t('amosdiscussioni', 'Crea una nuova discussione');
$labelManage = AmosDiscussioni::t('amosdiscussioni', 'Gestisci');
$titleManage = AmosDiscussioni::t('amosdiscussioni', 'Gestisci le discussioni');
$urlCreate = '/discussioni/discussioni-topic/create';
$urlManage = '#';

?>

<div class="widget-graphic-cms-bi-less card-<?= $modelLabel ?> container">
    <div class="page-header">
        <?= $this->render(
            "@vendor/open20/amos-layout/src/views/layouts/fullsize/parts/bi-less-plugin-header",
            [
                'isGuest' => \Yii::$app->user->isGuest,
                'modelLabel' => 'news',
                'titleSection' => $titleSection,
                'subTitleSection' => $subTitleSection,
                'urlLinkAll' => $urlLinkAll,
                'labelLinkAll' => $labelLinkAll,
                'titleLinkAll' => $titleLinkAll,
                'labelCreate' => $labelCreate,
                'titleCreate' => $titleCreate,
                'labelManage' => $labelManage,
                'titleManage' => $titleManage,
                'urlCreate' => $urlCreate,
                'urlManage' => $urlManage,
               // 'canCreateCommunityWidget' => AmosDiscussioni::instance()->canCreateCommunityWidget,
            ]
        );
        ?>
    </div>
</div>

<?php if ($listaModels) { ?>
    <div class="list-view">
        <div>
            <div class="" role="listbox" data-role="list-view">
                <?php foreach ($listaModels as $singolaDiscussione) : ?>
                    <div>
                        <?= $this->render("@vendor/open20/amos-discussioni/src/views/discussioni-topic/_item", ['model' => $singolaDiscussione]); ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>

<?php } ?>
