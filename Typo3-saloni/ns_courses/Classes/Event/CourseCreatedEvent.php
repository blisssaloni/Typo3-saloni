<?php

declare (strict_types = 1);

namespace NITSAN\NsCourses\Event;

use NITSAN\NsCourses\Domain\Model\Course;

final class CourseCreatedEvent
{
    public function __construct(
        private readonly Course $course
    ) {}

    public function getCourse(): Course
    {
        return $this->course;
    }
}
