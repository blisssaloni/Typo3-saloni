<?php

declare(strict_types=1);

namespace NITSAN\NsCourses\Event;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Attribute\AsEventListener;
use TYPO3\CMS\Core\Mail\FluidEmail;
use TYPO3\CMS\Core\Mail\Mailer;
use NITSAN\NsCourses\Event\StudentCreatedEvent;
use Symfony\Component\Mime\Address;
use TYPO3\CMS\Core\Mail\MailerInterface;
use TYPO3\CMS\Core\Mail\MailMessage;
#[AsEventListener]
final class StudentCreatedEmailListener
{
    public function __construct(
        private readonly Mailer $mailer
    ) {}

    public function __invoke(StudentCreatedEvent $event): void
    {
        $student = $event->getStudent();

      


// Create the message
$mail = GeneralUtility::makeInstance(MailMessage::class);

// Prepare and send the message
$mail
    // Defining the "From" email address and name as an object
    // (email clients will display the name)
    ->from(new Address('noreply@t3v13-saloni.ddev.site', 'Saloni Thakkar'))

    // Set the "To" addresses
    ->to(
        new Address($student->getEmail(), $student->getName()),
        //new Address('other@example.org')
    )

    // Give the message a subject
    ->subject('Your subject')

    // Give it the text message
    ->text('Here is the message itself')

    // And optionally an HTML message
    ->html('<p>Here is the message itself</p>')

    // Optionally add any attachments
    // ->attachFromPath('/path/to/MCA-brochure.pdf')

    // And finally send it
    ->send();
//    $email = (new FluidEmail())
//     ->to(new Address($student->getEmail(), $student->getName())) //  FROM $student object
//     ->from(new Address('noreply@t3v13-saloni.ddev.site', 'Course Platform')) // Your default sender
//     ->subject('Welcome to the Course Platform, ' . $student->getName()) //  Subject using student name
//     ->format(FluidEmail::FORMAT_HTML) // Use HTML or BOTH
//      ->setTemplate('Welcome') //  Template: EXT:ns_courses/Resources/Private/Templates/Email/Welcome.html
//     ->assign('student', $student); //  Pass student to Fluid template

//         $this->mailer->send($email);
        
    }
}

 