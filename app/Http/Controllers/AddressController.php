<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;

class AddressController extends Controller
{
    public function getAll()
    {
        try {
            $addresses = Address::all();
            $result = [];
            $count = 0;
            foreach($addresses as $address){
                $result[$count] = ([
                    'id'            => $address->id_address,
                    'customer_id'   => $address->customer_id,
                    'address'       => $address->address,
                    'district'      => $address->district,
                    'city'          => $address->city,
                    'province'      => $address->province,
                    'postal_code'   => $address->postal_code,
                    'created_at'    => $address->created_at,
                    'updated_at'    => $address->updated_at
                ]);
                $count++;
            };
            return response()->json([
                'data' => $result
            ]);
        } catch (\Exception $error) {
            Log::error('Error: ' . $error->getMessage());
            return response()->json([
                'message' => 'Error: ' . $error->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try{
            $rules = [
                'customer_id'   => 'required',
                'address'       => 'required',
                'district'      => 'required',
                'city'          => 'required',
                'province'      => 'required',
                'postal_code'   => 'required',
            ];

            $validatedData = $request->validate($rules);

            $address = Address::Create([
                'customer_id' => $validatedData['customer_id'],
                'address'     => $validatedData['address'],
                'district'    => $validatedData['district'],
                'city'        => $validatedData['city'],
                'province'    => $validatedData['province'],
                'postal_code' => $validatedData['postal_code']
            ]);

            return response()->json(['data' => $address], 201);
        }catch (\Exception $error) {
            Log::error('Error: ' . $error->getMessage());
            return response()->json([
                'message' => 'Error: ' . $error->getMessage()
            ], 400);
        }
    }

    public function show($id)
    {
        try {
            $address = Address::select('id_address as id', 'customer_id','address', 'district', 'city', 'province', 'postal_code', 'created_at', 'updated_at')
                                ->where('id_address', $id)
                                ->firstOrFail();

            return response()->json([$address]);
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
            $address = Address::where('id_address', $id)->update([
                'customer_id' => $request->customer_id,
                'address'     => $request->address,
                'district'    => $request->district,
                'city'        => $request->city,
                'province'    => $request->province,
                'postal_code' => $request->postal_code
            ]);

            if (!$address) {
                return response()->json(['error' => 'Address not found.'], 404);
            }

            return response()->json(['data' => $address]);
        } catch (QueryException $error) {
            Log::error('Failed to update address: ' . $error->getMessage());
            return response()->json(['error' => 'Failed to update address.'], 500);
        }
    }

    public function delete($id)
    {
        try {
            $address = Address::where('id_address', $id)->delete();

            if (!$address) {
                return response()->json(['error' => 'Address not found.'], 404);
            }

            return response()->json(['message' => 'Address deleted successfully!'], 202);
        } catch (QueryException $e) {
            Log::error('Failed to delete address: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to delete address.'], 500);
        }
    }
}
