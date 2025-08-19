<?php

declare (strict_types = 1);

namespace NITSAN\NsCourses;

use TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator;

final class PdfFileValidator extends AbstractValidator
{

    private const MAX_FILE_SIZE = 5242880;

    protected function isValid(mixed $value): void
    {

        print_r("hello");

        if ($extension !== 'pdf') {
            var_dump($extension, 'Validator value');
            die();

            $this->addError('Only PDF files are allowed.', 1700000001);
            return;
        }

        if ($size > self::MAX_FILE_SIZE) {
            $this->addError('File size must not exceed 5 MB.', 1700000003);
            return;
        }
    }
}
