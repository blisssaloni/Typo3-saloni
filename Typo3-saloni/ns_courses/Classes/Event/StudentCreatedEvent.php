<?php

declare (strict_types = 1);

namespace NITSAN\NsCourses\Event;

use NITSAN\NsCourses\Domain\Model\Students;

final class StudentCreatedEvent
{
    public function __construct(
        private readonly Students $student
    ) {}

    public function getStudent(): Students
    {
        return $this->student;
    }
}
