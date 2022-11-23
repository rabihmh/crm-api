<?php

namespace Crm\Customer\Services;

use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Models\Customer;
use Crm\Customer\Repositories\CustomerRepository;
use Crm\Customer\Requests\CreateCustomer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerService
{
    private CustomerRepository $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function notFound($message = 'Not Found', $status = Response::HTTP_NOT_FOUND)
    {
        return response()->json(['status' => $message], $status);
    }


    public function index()
    {
        return $this->customerRepository->all();
    }

    public function show($id)

    {
        return $this->customerRepository->find($id);

    }

    public function store(CreateCustomer $request)
    {
        $customer = new Customer();
        $customer->name = $request->post('name');
        $customer->save();
        event(new CustomerCreation($customer));
        return $customer;
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->notFound();
        }
        $customer->name = $request->post('name');
        $customer->save();
        return $customer;
    }

    public function destroy(int $id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return $this->notFound();
        }
        $customer->delete();
        return \Illuminate\Support\Facades\Response::json(['status' => 'delete'], Response::HTTP_OK);
    }

}
