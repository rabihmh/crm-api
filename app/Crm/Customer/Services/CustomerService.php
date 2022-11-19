<?php

namespace Crm\Customer\Services;

use Crm\Customer\Events\CustomerCreation;
use Crm\Customer\Models\Customer;
use Crm\Customer\Requests\CreateCustomer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerService
{
    public function notFound()
    {
        return response()->json(['status' => 'Not Found'], Response::HTTP_NOT_FOUND);
    }

    public function index()
    {
        return Customer::all();
    }

    public function show($id)

    {
        return Customer::find($id);

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
