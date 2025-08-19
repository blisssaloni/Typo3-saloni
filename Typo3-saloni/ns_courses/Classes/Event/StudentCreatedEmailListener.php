<?php

declare (strict_types = 1);

namespace NITSAN\NsCourses\Event;

use NITSAN\NsCourses\Event\StudentCreatedEvent;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Mail\Mailer;
use TYPO3\CMS\Core\Mail\MailMessage;
use TYPO3\CMS\Core\Utility\GeneralUtility;

#[AsEventListener]
final class StudentCreatedEmailListener
{
    public function __construct(
        private readonly Mailer $mailer
    ) {}

    public function __invoke(StudentCreatedEvent $event): void
    {
        $student = $event->getStudent();

        $mail = GeneralUtility::makeInstance(MailMessage::class);

        $mail
            ->from(new Address('noreply@t3v13-saloni.ddev.site', 'Saloni Thakkar'))

            ->to(
                new Address($student->getEmail(), $student->getName()),
            )

            ->subject('Your subject')

            ->text('Here is the message itself')

            ->html('<p>Here is the message itself</p>')

            ->send();
    }
}
