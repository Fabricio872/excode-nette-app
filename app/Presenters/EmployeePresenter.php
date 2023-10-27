<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Services\FileStorageService;
use Nette;


final class EmployeePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(
        private FileStorageService $storageService
    )
    {
    }

    public function renderIndex(): void
    {
        $this->template->employeeList = $this->storageService->getList();
    }
}
