<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Customer;
use App\Models\Address;
use Tests\TestCase;

class AddressTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }
    
    public function testGetAllAddress()
    {
        $response = $this->get('/address');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'customer_id',
                    'address',
                    'district',
                    'city',
                    'province',
                    'postal_code',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
    }
    
    public function testPostAddress()
    {
        $data = [
            'customer_id'   => 1,
            'address'       => 'Jl. Raya',
            'district'      => 'Kedungkandang',
            'city'          => 'Malang',
            'province'      => 'Jawa Timur',
            'postal_code'   => '65139',
        ];
    
        $response = $this->json('POST', '/address', $data);
    
        $response->assertStatus(201)
                ->assertJson([
                    'data' => [
                        'customer_id'   => 1,
                        'address'       => 'Jl. Raya',
                        'district'      => 'Kedungkandang',
                        'city'          => 'Malang',
                        'province'      => 'Jawa Timur',
                        'postal_code'   => '65139',
                    ],
                ]);
    }

    public function testGetAddressById()
    {
        $address = Address::factory()->create();
        $response = $this->get('/address/' . $address->id_address);

        $response->assertStatus(200)
                ->assertJsonStructure([
                        '*' => [
                            'id',
                            'customer_id',
                            'address',
                            'district',
                            'city',
                            'province',
                            'postal_code',
                            'created_at',
                            'updated_at'
                        ]
                ])
                ->assertJsonFragment([
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
    }

    public function testPatchAddress()
    {
        // Create a new address
        $address = Address::factory()->create();

        // Make a request to update the address
        $updatedAddressData = [
            'customer_id'   => $address->customer_id,
            'address'       => 'Updated address',
            'district'      => 'Updated district',
            'city'          => 'Updated city',
            'province'      => 'Updated province',
            'postal_code'   => '12345'
        ];

        $response = $this->PATCH('/address/' . $address->id_address, $updatedAddressData);

        // Assert the response
        $response->assertStatus(200)
            ->assertJson([
                'data' => 1
            ]);

        // Assert the database
        $this->assertDatabaseHas('addresses', [
            'id_address'    => $address->id_address,
            'customer_id'   => $address->customer_id,
            'address'       => 'Updated address',
            'district'      => 'Updated district',
            'city'          => 'Updated city',
            'province'      => 'Updated province',
            'postal_code'   => '12345'
        ]);
    }

    public function testDeleteAddress()
    {
        // Create a new address
        $address = Address::factory()->create();

        // Make a request to delete the address
        $response = $this->DELETE('/address/' . $address->id_address);

        // Assert the response
        $response->assertStatus(202)
                ->assertJson([
                    'message' => 'Address deleted successfully!'
                ]);

        // Assert the database
        $this->assertDatabaseMissing('addresses', [
            'id_address' => $address->id_address,
        ]);
    }

}
