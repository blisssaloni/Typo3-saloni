<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Task;



use TYPO3\CMS\Scheduler\Task\AbstractTask;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

class CleanupOldStudentsTask extends AbstractTask
{
    public int $days = 30; // default, can be overridden via additional fields

    public function execute(): bool
    {
        $timestampLimit = time() - ($this->days * 24 * 60 * 60);

        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('tx_nscourses_domain_model_students');

        $connection->delete(
            'tx_nscourses_domain_model_students',
            ['created_at' => ['<', $timestampLimit]]
        );

        return true;
    }
}
