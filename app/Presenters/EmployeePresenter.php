<?php

declare(strict_types=1);

namespace App\Presenters;

use App\DTO\EmployeeDTO;
use App\Services\FileStorageService;
use Nette;
use Nette\Application\UI\Form;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class EmployeePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private FileStorageService $storageService,
        private ObjectNormalizer   $normalizer
    )
    {
    }

    public function renderIndex(): void
    {
        $this->template->employeeList = $this->storageService->getList();
    }

    protected function createComponentEmployeeForm(): Form
    {
        $form = new Form();
        $form->addText('name', 'Name:');
        $form->addText('sex', 'Sex:');
        $form->addInteger('age', 'Age:');
        $form->addSubmit('send', 'Add');
        $form->onSuccess[] = [$this, 'formSucceeded'];
        $form->onError[] = [$this, 'formError'];
        return $form;
    }

    public function formSucceeded(Form $form, $data): void
    {
        $employee = $this->normalizer->denormalize($data, EmployeeDTO::class);
        $this->storageService->addEmployee($employee);

        $this->flashMessage(sprintf('Employee "%s" successfully added', $employee->getName()));
        $this->redirect('Employee:index');
    }
}
