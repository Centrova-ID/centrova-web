<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\User;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Get some staff users to be managers
        $staff = User::whereNotNull('role')
                    ->where('role', '!=', 'customer')
                    ->whereIn('role', ['admin', 'manager', 'supervisor'])
                    ->limit(5)
                    ->get();

        $departments = [
            [
                'name' => 'Human Resources',
                'code' => 'HR',
                'description' => 'Responsible for recruitment, employee relations, benefits administration, and organizational development.',
                'manager_id' => $staff->first()?->id,
                'budget' => 150000.00,
                'location' => 'Building A, Floor 2',
                'phone' => '+1 (555) 123-4567',
                'email' => 'hr@centrova.com',
                'status' => 'active',
                'established_date' => '2020-01-15',
            ],
            [
                'name' => 'Information Technology',
                'code' => 'IT',
                'description' => 'Manages all technology infrastructure, software development, and IT support services.',
                'manager_id' => $staff->skip(1)->first()?->id,
                'budget' => 250000.00,
                'location' => 'Building B, Floor 3',
                'phone' => '+1 (555) 123-4568',
                'email' => 'it@centrova.com',
                'status' => 'active',
                'established_date' => '2019-03-10',
            ],
            [
                'name' => 'Marketing',
                'code' => 'MKT',
                'description' => 'Handles brand management, digital marketing, content creation, and customer acquisition strategies.',
                'manager_id' => $staff->skip(2)->first()?->id,
                'budget' => 180000.00,
                'location' => 'Building A, Floor 1',
                'phone' => '+1 (555) 123-4569',
                'email' => 'marketing@centrova.com',
                'status' => 'active',
                'established_date' => '2020-06-20',
            ],
            [
                'name' => 'Customer Service',
                'code' => 'CS',
                'description' => 'Provides customer support, handles inquiries, and ensures customer satisfaction.',
                'manager_id' => $staff->skip(3)->first()?->id,
                'budget' => 120000.00,
                'location' => 'Building C, Floor 1',
                'phone' => '+1 (555) 123-4570',
                'email' => 'support@centrova.com',
                'status' => 'active',
                'established_date' => '2019-08-05',
            ],
            [
                'name' => 'Finance',
                'code' => 'FIN',
                'description' => 'Manages financial planning, accounting, budgeting, and financial reporting.',
                'manager_id' => $staff->skip(4)->first()?->id,
                'budget' => 200000.00,
                'location' => 'Building A, Floor 3',
                'phone' => '+1 (555) 123-4571',
                'email' => 'finance@centrova.com',
                'status' => 'active',
                'established_date' => '2019-01-01',
            ],
            [
                'name' => 'Research & Development',
                'code' => 'RND',
                'description' => 'Focuses on innovation, product development, and technological advancement.',
                'budget' => 300000.00,
                'location' => 'Building B, Floor 2',
                'phone' => '+1 (555) 123-4572',
                'email' => 'research@centrova.com',
                'status' => 'inactive',
                'established_date' => '2021-04-01',
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }

        // Assign some staff to departments
        $createdDepartments = Department::all();
        $allStaff = User::whereNotNull('role')->where('role', '!=', 'customer')->get();
        
        foreach ($allStaff as $index => $staff) {
            $department = $createdDepartments->get($index % $createdDepartments->count());
            $staff->update(['department_id' => $department->id]);
        }
    }
}
