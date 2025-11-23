<?php

namespace App\Services;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public static function create(Request $request): Customer
    {
        $request->validate([
            'token' => 'required|string|max:255|min:2',
        ]);

        $customer = Customer::where('token', $request->token)->first();

        if(!$customer){

            $request->validate([
                'name' => 'required|string|max:255|min:2',
                'phone' => ['required', 'regex:/^\+[1-9]\d{7,14}$/'],
                'email' => 'required|email|max:255|min:2',
            ]);

            $customer = Customer::where('phone', $request->phone)->first();

            if($customer){
                $customer->update(['token' => $request->token]);
            }
        }

        if(!$customer){
            $customer = Customer::firstOrCreate([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'token' => $request->token
            ]);
        }

        return $customer;
    }

    public static function getCustomerForToken(Request $request)
    {
        return Customer::where('token', $request->token)->first();
    }
}
