<?php

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Customer;
use App\Models\Address;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate');
    }
    
    public function testGetAllCustomer()
    {
        // Create 5 customers
        Customer::factory()->count(5)->create();

        // Hit the endpoint to get all customers
        $response = $this->get('/customer');

        // Assert the response status is 200
        $response->assertStatus(200);

        // Assert the response has the correct structure
        $response->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'name',
                    'gender',
                    'phone_number',
                    'image',
                    'email'
                ]
        ]);
    }

    public function testGetCustomerById()
    {
        // Create a customer with address
        $customer = Customer::factory()->create();
        $address = $address = Address::factory()->create(['customer_id' => $customer->id]);

        // Send request to show customer detail
        $response = $this->get("/customer/{$customer->id}");

        // Assert response
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'title',
            'name',
            'gender',
            'phone_number',
            'image',
            'email',
            'address' => [
                [
                    'id',
                    'address',
                    'district',
                    'city',
                    'province',
                    'postal_code',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);
        $response->assertJson([
            'id'            => $customer->id,
            'title'         => $customer->title,
            'name'          => $customer->name,
            'gender'        => $customer->gender,
            'phone_number'  => $customer->phone_number,
            'image'         => $customer->image,
            'email'         => $customer->email,
            'address' => [
                [
                    'id'            => $address->id_address,
                    'address'       => $address->address,
                    'district'      => $address->district,
                    'city'          => $address->city,
                    'province'      => $address->province,
                    'postal_code'   => $address->postal_code,
                    'created_at'    => $address->created_at->toISOString(),
                    'updated_at'    => $address->updated_at->toISOString()
                ]
            ]
        ]);
    }

    public function testPostCustomer()
    {
        $data = [
            'title'         => $this->faker->title,
            'name'          => $this->faker->name,
            'gender'        => $this->faker->randomElement(['M', 'F']),
            'phone_number'  => $this->faker->phoneNumber,
            'image'         => $this->faker->imageUrl(),
            'email'         => $this->faker->email
        ];

        $response = $this->postJson('/customer', $data);

        $response->assertStatus(201)
            ->assertJson([
                'data' => [
                    'title'         => $data['title'],
                    'name'          => $data['name'],
                    'gender'        => $data['gender'],
                    'phone_number'  => $data['phone_number'],
                    'image'         => $data['image'],
                    'email'         => $data['email']
                ]
            ]);
    }
    public function testPatchCustomer()
    {
        $customer = Customer::factory()->create();

        $updatedData = [
            'title'         => 'Ms',
            'name'          => 'Jane Doe',
            'gender'        => 'female',
            'phone_number'  => '08123456789',
            'image'         => 'https://example.com/image.jpg',
            'email'         => 'jane.doe@example.com'
        ];

        $response = $this->json('PATCH', '/customer/' . $customer->id, $updatedData);

        $response->assertStatus(200)
            ->assertJson([
                'data' => [
                    'id'            => $customer->id,
                    'title'         => $updatedData['title'],
                    'name'          => $updatedData['name'],
                    'gender'        => $updatedData['gender'],
                    'phone_number'  => $updatedData['phone_number'],
                    'image'         => $updatedData['image'],
                    'email'         => $updatedData['email']
                ]
            ]);

        $this->assertDatabaseHas('customers', [
            'id'            => $customer->id,
            'title'         => $updatedData['title'],
            'name'          => $updatedData['name'],
            'gender'        => $updatedData['gender'],
            'phone_number'  => $updatedData['phone_number'],
            'image'         => $updatedData['image'],
            'email'         => $updatedData['email']
        ]);
    }

    public function testDeleteCustomer()
    {
        $customer = Customer::factory()->create();
        $response = $this->json('DELETE', '/customer/' . $customer->id);
        $response->assertStatus(202);
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
        $this->assertDatabaseMissing('addresses', ['customer_id' => $customer->id]);
    }
}
