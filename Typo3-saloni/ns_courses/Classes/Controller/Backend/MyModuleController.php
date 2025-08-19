<?php
namespace Nitsan\NsCourses\Controller\Backend;

use NITSAN\NsCourses\Domain\Repository\CourseRepository;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Backend\Template\ModuleTemplateFactory;
use TYPO3\CMS\Extbase\Mvc\Controller\ActionController;

#[AsController]
final class MyModuleController extends ActionController
{
    public function __construct(
        protected readonly ModuleTemplateFactory $moduleTemplateFactory,
        protected readonly CourseRepository $courseRepository
    ) {
    }

    public function indexAction(ServerRequestInterface $request): ResponseInterface
    {
        $moduleTemplate = $this->moduleTemplateFactory->create($request);

        // Fetch all courses
        $courses = $this->courseRepository->findAll();

        // Pass data to Fluid template
        $moduleTemplate->assignMultiple([
            'courses' => $courses,
        ]);

        return $moduleTemplate->renderResponse('Backend/Module/Index');
    }
}
