<?php

declare (strict_types = 1);

namespace NITSAN\NsCourses\Task;

use TYPO3\CMS\Scheduler\AdditionalFieldProviderInterface;
use TYPO3\CMS\Scheduler\Task\AbstractTask;

class CleanupOldStudentsTaskAdditionalFields implements AdditionalFieldProviderInterface
{
    public function getAdditionalFields(array &$taskInfo, $task, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule): array
    {
        if ($task instanceof CleanupOldStudentsTask) {
            $taskInfo['days'] = $task->days;
        }

        $fieldId                    = 'task_days';
        $fieldCode                  = '<input type="text" name="tx_scheduler[days]" id="' . $fieldId . '" value="' . htmlspecialchars((string) $taskInfo['days']) . '" />';
        $label                      = 'Number of days to keep (older records will be deleted)';
        $additionalFields[$fieldId] = [
            'code'     => $fieldCode,
            'label'    => $label,
            'cshKey'   => '',
            'cshLabel' => '',
        ];

        return $additionalFields;
    }

    public function validateAdditionalFields(array &$submittedData, \TYPO3\CMS\Scheduler\Controller\SchedulerModuleController $schedulerModule): bool
    {
        return is_numeric($submittedData['days']) && (int) $submittedData['days'] > 0;
    }

    public function saveAdditionalFields(array $submittedData, AbstractTask $task): void
    {
        $task->days = (int) $submittedData['days'];
    }
}
