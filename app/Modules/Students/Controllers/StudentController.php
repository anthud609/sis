<?php
namespace App\Modules\Students\Controllers;

use App\Core\Controller;

class StudentController extends Controller
{
    public function index()
    {
        $students = [
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'project' => 'Build Installer'
            ],
            [
                'name' => 'Bob Smith',
                'email' => 'bob@example.com',
                'project' => 'Logging Engine'
            ]
        ];

$this->render('Students', 'index', [
    'students' => $students,
    'title' => 'All Students',
    'breadcrumbs' => ['Home' => '/', 'Students' => '/students']
]);
    }
}
