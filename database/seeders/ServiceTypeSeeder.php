<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServiceType;

class ServiceTypeSeeder extends Seeder
{
    public function run()
    {
        $serviceTypes = [
            [
                'name' => 'Aadhaar Card Services',
                'description' => 'Aadhaar card application, correction, and update services',
                'price' => 299.00,
                'active' => true
            ],
            [
                'name' => 'PAN Card Services',
                'description' => 'PAN card application, correction, and reprint services',
                'price' => 399.00,
                'active' => true
            ],
            [
                'name' => 'Passport Services',
                'description' => 'New passport application and renewal assistance',
                'price' => 799.00,
                'active' => true
            ],
            [
                'name' => 'Voter ID Services',
                'description' => 'Voter ID card registration and correction services',
                'price' => 249.00,
                'active' => true
            ],
            [
                'name' => 'Ration Card Services',
                'description' => 'Ration card application and update services',
                'price' => 349.00,
                'active' => true
            ],
            [
                'name' => 'Birth Certificate',
                'description' => 'Birth certificate application and correction',
                'price' => 199.00,
                'active' => true
            ],
            [
                'name' => 'Income Certificate',
                'description' => 'Income certificate application services',
                'price' => 299.00,
                'active' => true
            ],
            [
                'name' => 'Domicile Certificate',
                'description' => 'Domicile certificate application and verification',
                'price' => 349.00,
                'active' => true
            ],
            [
                'name' => 'GST Registration',
                'description' => 'GST registration and compliance services',
                'price' => 1499.00,
                'active' => true
            ],
            [
                'name' => 'Shop License',
                'description' => 'Shop and establishment license application',
                'price' => 999.00,
                'active' => true
            ]
        ];

        foreach ($serviceTypes as $type) {
            ServiceType::create($type);
        }
    }
}