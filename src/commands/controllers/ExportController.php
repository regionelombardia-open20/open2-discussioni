<?php

namespace open20\amos\discussioni\commands\controllers;

use open20\amos\discussioni\AmosDiscussioni;
use open20\amos\discussioni\models\DiscussioniTopic;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Yii;
use yii\db\Exception;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;
use PHPExcel;
use PHPExcel_IOFactory;
use PHPExcel_Style_Alignment;
use open20\amos\taskmanager\models\TaskManagerJob;


/**
 * Export controller
 */
class ExportController extends \yii\console\Controller
{
    /**
     * @var string $title
     */
    public $title = 'Discussioni';

    /**
     * @var string $filename
     */
    public $filename = '';

    /**
     * @var array $data
     */
    public $data = [];

    /**
     * @var string[] $passedOptions
     */
    public $passedOptions = [
        'filename',
        'data'
    ];

    /**
     * @param $actionID
     * @return array|string[]
     */
    public function options($actionID)
    {
        return ArrayHelper::merge(parent::options($actionID), $this->passedOptions);
    }

    /**
     * @return void
     */
    public function init()
    {
        $this->module = AmosDiscussioni::instance();
        $this->filename = strtolower($this->title) . '_export.xlsx';

        parent::init();
    }

    /**
     * @return void
     * @throws \PHPExcel_Exception
     * @throws \PHPExcel_Reader_Exception
     * @throws \PHPExcel_Writer_Exception
     * @throws \yii\base\InvalidConfigException
     * @throws Exception
     */
    public function actionExportDiscussioniTopic()
    {
        $filename = $this->filename;

        // Base news query
        $rawQuery = htmlspecialchars_decode($this->data['query']);
        $rawQuery .= ' ORDER BY discussioni_topic.created_at DESC';
        $query = \Yii::$app->db->createCommand($rawQuery);
        $models = $query->queryAll();

        $model = new DiscussioniTopic();

        // Excel header columns
        $xlsData = [];
        $xlsData[] = [
            AmosDiscussioni::t('amosdiscussioni', 'Titolo'),
            AmosDiscussioni::t('amosdiscussioni', 'Pubblicato Da'),
            AmosDiscussioni::t('amosdiscussioni', 'Data Pubblicazione'),
            AmosDiscussioni::t('amosdiscussioni', $model->getAttributeLabel('status')),
            AmosDiscussioni::t('amosdiscussioni', 'Contributi'),
            AmosDiscussioni::t('amosdiscussioni', $model->getAttributeLabel('hints')),
            AmosDiscussioni::t('amosdiscussioni', 'Partecipanti'),
            AmosDiscussioni::t('amosdiscussioni', 'Ultimo Commento/Risposta')
        ];

        // Populate rows
        foreach ($models as $model) {
            $model = DiscussioniTopic::findOne($model['id']);

            $title = $model->titolo;
            $created_by = $model->createdUserProfile->nomeCognome;
            $date_created = Yii::$app->formatter->asDatetime($model->created_at, 'php:d/m/Y H:i');
            $status_label = $model->hasWorkflowStatus() ? $model->getWorkflowStatus()->getLabel() : '--';
            $contributions = $model->getDiscussionComments()->count();
            $hints = $model->hints;
            $participants = $model->getDiscussionComments()->groupBy('created_by')->count();
            $last_comment = AmosDiscussioni::t('amosdiscussioni', 'Non ci sono ancora contributi');
            if ($model->lastCommentUser) {
                $ultima_risposta = $model->lastCommentUser->nome . ' ' . $model->lastCommentUser->cognome;
                $data = ' ' . PHP_EOL . Yii::$app->formatter->asDatetime($model->lastCommentDate);

                $last_comment = $ultima_risposta . $data;
            }

            $xlsData[] = [
                $title,
                $created_by,
                $date_created,
                $status_label,
                $contributions,
                $hints,
                $participants,
                $last_comment
            ];
        }

        // Initialize PhpSpreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Cells styles
        foreach (range('A', 'H') as $column) {
            $column .= '1';
            $sheet->getStyle($column)->getFont()->setBold(true);
            $sheet->getStyle($column)->getBorders()->getBottom()->setBorderStyle(Border::BORDER_MEDIUM);
        }

        // Add data to the sheet
        $sheet->fromArray($xlsData, NULL, 'A1');

        // Save file
        $writer = new Xlsx($spreadsheet);
        $writer->save($filename);

        Console::stdout($this->title . " exported successfully.\n");
    }

}