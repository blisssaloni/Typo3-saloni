<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Event;

use Psr\Log\LoggerInterface;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Database\ConnectionPool;

#[AsEventListener(identifier: 'ns_courses/course-created-listener')]
final class CourseCreatedEventListener
{
    public function __construct(
        private readonly LoggerInterface $logger
    ) {}

    public function __invoke(CourseCreatedEvent $event): void
    {
        $course = $event->getCourse();

       $this->writeSysLog('Course created: ' . $course->getTitle());

       
    }

    private function writeSysLog(string $logMessage): void
    {
        $connection = GeneralUtility::makeInstance(ConnectionPool::class)
            ->getConnectionForTable('sys_log');

        $userId = 0;
        if (isset($GLOBALS['BE_USER']) && is_object($GLOBALS['BE_USER'])) {
            $userId = (int)($GLOBALS['BE_USER']->user['uid'] ?? 0);
        }

        $connection->insert('sys_log', [
            'userid' => $userId,
            'type' => 1,
            'action' => 0,
            'error' => 0,
            'details' => $logMessage,
            'log_data' => json_encode([]),
            'IP' => $_SERVER['REMOTE_ADDR'] ?? '',
            'tstamp' => time(),
            'workspace' => 0,
        ]);
    }
}


