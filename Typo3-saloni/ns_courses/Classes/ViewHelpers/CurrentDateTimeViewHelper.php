<?php
declare (strict_types = 1);

namespace NITSAN\NsCourses\ViewHelpers;

use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

final class CurrentDateTimeViewHelper extends AbstractViewHelper
{
    public function initializeArguments(): void
    {
        $this->registerArgument('format', 'string', 'PHP date format', 'Y-m-d H:i:s');
        $this->registerArgument('timezone', 'string', 'Timezone identifier', date_default_timezone_get());
    }

    public function render(): string
    {
        $format   = $this->arguments['format'];
        $timezone = new \DateTimeZone($this->arguments['timezone']);
        $now      = new \DateTime('now', $timezone);

        return $now->format($format);
    }
}
