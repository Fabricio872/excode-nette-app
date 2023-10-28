<?php

declare(strict_types=1);

namespace App\Presenters;

use App\DTO\EmployeeDTO;
use App\Forms\EmployeeFormFactory;
use App\Services\FileStorageService;
use Nette;
use Nette\Application\UI\Form;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class EmployeePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private FileStorageService $storageService,
        private ObjectNormalizer   $normalizer,
        private EmployeeFormFactory $formFactory
    )
    {
    }

    public function renderIndex(): void
    {
        $this->template->employeeList = $this->storageService->getList();
    }

    public function renderChart(): void
    {
        $employeeList = $this->storageService->getList();

        usort($employeeList, function (EmployeeDTO $a, EmployeeDTO $b){
            return $b->getAge()<=>$a->getAge();
        });
        $this->template->employeeList = $employeeList;
    }

    public function renderEdit(int $id): void
    {

        $this->template->employee = $this->storageService->getList()[$id];
    }

    public function renderDelete(int $id):void
    {
        $employee = $this->storageService->getList()[$id];
        $this->storageService->removeEmployee($id);

        $this->flashMessage(sprintf('Employee "%s" successfully deleted', $employee->getName()));
        $this->redirect('Employee:index');
    }

    protected function createComponentEmployeeAddForm(): Form
    {
        $form = $this->formFactory->create();
        // we can change the form, here for example we change the label on the button
        $form->onSuccess[] = [$this, 'formAddSucceeded']; // and add handler
        return $form;
    }

    protected function createComponentEmployeeEditForm(): Form
    {
        $form = $this->formFactory->create();
        // we can change the form, here for example we change the label on the button
        $form->onSuccess[] = [$this, 'formEditSucceeded']; // and add handler
        $form->setDefaults($this->storageService->getList()[$this->request->getParameter('id')]);
        return $form;
    }

    public function formAddSucceeded(Form $form, $data): void
    {
        $employee = $this->normalizer->denormalize($data, EmployeeDTO::class);
        $this->storageService->addEmployee($employee);

        $this->flashMessage(sprintf('Employee "%s" successfully added', $employee->getName()));
        $this->redirect('Employee:index');
    }

    public function formEditSucceeded(Form $form, $data): void
    {
        $employee = $this->normalizer->denormalize($data, EmployeeDTO::class);
        $this->storageService->editEmployee((int)$this->request->getParameter('id'), $employee);

        $this->flashMessage(sprintf('Employee "%s" successfully edited', $employee->getName()));
        $this->redirect('Employee:index');
    }
}
