<?php

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use DTApi\Repository\UserRepository;

class UserRepositoryTest extends TestCase
{
    public function testCreateOrUpdate(UserRepository $userRepository)
    {
        // Test case 1: Test with new user creation
        $requestData1 = [
            'role' => 'customer',
            'name' => 'John Doe',
            'company_id' => 1, 
            'department_id' => 1,
            'email' => 'john.doe@example.com',
            'dob_or_orgid' => '1998-01-01',
            'phone' => '1234567890',
            'mobile' => '9876543210',
            'password' => 'password',
            'consumer_type' => 'paid',
            'username' => 'johndoe',
            'post_code' => '12345',
            'address' => 'Street',
            'city' => 'City',
            'town' => 'Town',
            'country' => 'Country',
            'additional_info' => 'additional info',
        ];
        $result1 = $userRepository->createOrUpdate(null, $requestData1);
        $this->assertInstanceOf(User::class, $result1);

        // Test case 2: Test with existing user update
        $existingUser = factory(User::class)->create();
        $requestData2 = [
            'role' => 'translator',
            'name' => 'Updated Name',
            'translator_type' => 'translator_type',
            'worked_for' => 'yes',
            'organization_number' => '123456789',
            'gender' => 'male',
            'translator_level' => 'level1',
            'additional_info' => 'additional info',
            'post_code' => '54321',
            'address' => 'Updated Street',
            'address_2' => 'Address 2',
            'town' => 'Updated Town',
        ];
        $result2 = $userRepository->createOrUpdate($existingUser->id, $requestData2);
        $this->assertInstanceOf(User::class, $result2);
        $this->assertEquals('Updated Name', $result2->name);
    }
}