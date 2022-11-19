<?php

namespace App\Http\Controllers;

use Crm\Customer\Requests\CreateCustomer;
use Crm\Customer\Services\CustomerService;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    private CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function notFound()
    {
        return response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
    }

    public function index()
    {
        return $this->customerService->index();
    }

    public function show($id)

    {
        return $this->customerService->show($id) ?? $this->notFound();

    }

    public function store(CreateCustomer $request)
    {

        return $this->customerService->store($request);
    }

    public function update(CreateCustomer $request, $id)
    {
        return $this->customerService->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->customerService->destroy((int)$id);
    }


}
