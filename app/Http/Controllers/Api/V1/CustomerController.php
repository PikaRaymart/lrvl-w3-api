<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1CustomerCollection;
use App\Http\Resources\V1CustomerResource;
use App\Filters\V1\CustomersFilter;
use App\Http\Requests\V1\StoreCustomerRequest;
use Illuminate\Http\Request;

class CustomerController extends Controller{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Request $request){
		$filter = new CustomersFilter();
		$filterItems = $filter->transform($request);
		$includeInvoices = $request->query("includeInvoices");
		$customers = Customer::where($filterItems);

		if ($includeInvoices) {
			$customers = $customers->with("invoices");
		}

		$customersCollection = (new V1CustomerCollection($customers->paginate()))->appends($request->query());

		return $customersCollection;
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(StoreCustomerRequest $request){

		return new V1CustomerResource(Customer::create($request->all()));
	}

	/**
	 * Display the specified resource.
	 */
	public function show(Customer $customer, Request $request){
		$includeInvoices = $request->query("includeInvoices");

		if ($includeInvoices) {
			return new V1CustomerResource($customer->loadMissing("invoices"));
		}

		return new V1CustomerResource($customer);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Customer $customer)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(UpdateCustomerRequest $request, Customer $customer)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Customer $customer)
	{
		//
	}
}
