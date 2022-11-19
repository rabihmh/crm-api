<?php

namespace App\Http\Controllers;

use Crm\Customer\Services\CustomerService;
use Crm\Project\Requests\CreateProjectRequest;
use Crm\Project\Service\ProjectService;

class ProjectController extends Controller
{
    private CustomerService $customerService;
    private ProjectService $projectService;

    public function __construct(ProjectService $projectService, CustomerService $customerService)
    {
        $this->projectService = $projectService;
        $this->customerService = $customerService;
    }

    public function createProject(CreateProjectRequest $request, $customer_id)
    {
        $customer = $this->customerService->show($customer_id);
        if (!$customer) {
            return $this->projectService->notFound('Customer Not Found');
        }
        return $this->projectService->createProject($request, $customer_id);

    }
}
