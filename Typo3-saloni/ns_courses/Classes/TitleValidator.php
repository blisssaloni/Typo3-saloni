<?php
namespace NITSAN\NsCourses;

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

final class TitleValidator extends AbstractValidator
{
    protected function isValid(mixed $value): void
    {
        // $value is the title string

        if ($value === null || trim($value) === '') {

            $this->addError('The title cannot be empty.', 1700001000);
            debug($value);die();
            return;
        }
    }
}
