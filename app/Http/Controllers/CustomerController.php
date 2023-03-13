<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;


class CustomerController extends Controller
{
    public function getAll()
    {
        try {
            $customers = Customer::select('customers.*', 'addresses.*')
                ->leftJoin('addresses', 'customers.id', '=', 'addresses.customer_id')
                ->orderBy('name', 'asc')
                ->paginate(10);

            $response = array();

            foreach ($customers as $customer) {
                $id = $customer->id;

                if (!array_key_exists($id, $response)) {
                    $response[$id] = array(
                        'id'            => $customer->id,
                        'title'         => $customer->title,
                        'name'          => $customer->name,
                        'gender'        => $customer->gender,
                        'phone_number'  => $customer->phone_number,
                        'image'         => $customer->image,
                        'email'         => $customer->email,
                        'address'       => array()
                    );
                }
                // Menambahkan alamat ke array address customer
                $address = array(
                    'id'            => $customer->id_address,
                    'address'       => $customer->address,
                    'district'      => $customer->district,
                    'city'          => $customer->city,
                    'province'      => $customer->province,
                    'postal_code'   => $customer->postal_code,
                    'created_at'    => $customer->created_at,
                    'updated_at'    => $customer->updated_at
                );

                array_push($response[$id]['address'], $address);
            }
            // Ubah response dari array asosiatif ke array numerik
            $response = array_values($response);
            // Konversi response ke format JSON
            return response()->json($response);
        } catch (\Exception $error) {
            return response()->json(['error' => 'Error occurred while fetching data.'], 500);
        }
    }

    public function store(Request $request)
    {
        try{
        $rules = [
            'title'         => 'required',
            'name'          => 'required',
            'gender'        => 'required',
            'phone_number'  => 'required',
            'image'         => 'required',
            'email'         => 'required|email',
        ];

        $validatedData = $request->validate($rules);

        $customer = Customer::Create([
        'title'         => $validatedData['title'],
        'name'          => $validatedData['name'],
        'gender'        => $validatedData['gender'],
        'phone_number'  => $validatedData['phone_number'],
        'image'         => $validatedData['image'],
        'email'         => $validatedData['email']
        ]);
        return response()->json(['data' => $customer], 201);
        } catch (\Illuminate\Validation\ValidationException $error) {
            return response()->json(['message' => $error->getMessage()], 400);
        } catch (\Exception $error) {
            return response()->json(['message' => 'Error: ' . $error>getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $customer = Customer::select('customers.*', 'addresses.*')
                ->leftJoin('addresses', 'customers.id', '=', 'addresses.customer_id')
                ->where('customers.id', $id)
                ->first();

            if ($customer) {
                $response = array(
                    'id'            => $customer->id,
                    'title'         => $customer->title,
                    'name'          => $customer->name,
                    'gender'        => $customer->gender,
                    'phone_number'  => $customer->phone_number,
                    'image'         => $customer->image,
                    'email'         => $customer->email,
                    'address'       => array()
                );
                // Menambahkan alamat ke array address customer
                $address = array(
                    'id'            => $customer->id_address,
                    'address'       => $customer->address,
                    'district'      => $customer->district,
                    'city'          => $customer->city,
                    'province'      => $customer->province,
                    'postal_code'   => $customer->postal_code,
                    'created_at'    => $customer->created_at,
                    'updated_at'    => $customer->updated_at
                );
                array_push($response['address'], $address);
                // Konversi response ke format JSON
                return response()->json($response);
            } else {
                return response()->json([
                    'message' => 'Customer not found'
                ], 404);
            }
        } catch (\Exception $error) {
            Log::error('Error: ' . $error->getMessage());
            return response()->json([
                'message' => 'Error: ' . $error->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $customer = Customer::findOrFail($id);
            $customer->update([
                'title'         => $request->title,
                'name'          => $request->name,
                'gender'        => $request->gender,
                'phone_number'  => $request->phone_number,
                'image'         => $request->image,
                'email'         => $request->email
            ]);
            return response()->json([
                'data' => $customer
            ]);
        } catch (\Exception $error) {
            Log::error('Error: ' . $error->getMessage());
            return response()->json([
                'message' => 'Error: ' . $error->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        try {
            $validator = Validator::make(['id' => $id], [
                'id' => 'required|exists:customers,id',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => $validator->errors()->first()
                ], 400);
            }

            $customer = Customer::findOrFail($id);
            Address::where('customer_id', $id)->delete();
            $customer->delete();

            return response()->json([
                'message' => 'Customer and address deleted successfully!'
            ], 202);

        } catch (\Exception $error) {
            Log::error('Error: ' . $error->getMessage());
            return response()->json([
                'message' => 'Error: ' . $error->getMessage()
            ], 400);
        }
    }
}
