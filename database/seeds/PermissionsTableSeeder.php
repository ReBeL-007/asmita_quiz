<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            [
                'title' => 'user_management_access',
                'slug' => 'user-management-access',
            ],
            [
                'title' => 'permission_create',
                'slug' => 'permission-create',
            ],
            [
                'title' => 'permission_edit',
                'slug' => 'permission-edit',
            ],
            [
                'title' => 'permission_show',
                'slug' => 'permission-show',
            ],
            [
                'title' => 'permission_delete',
                'slug' => 'permission-delete',
            ],
            [
                'title' => 'permission_access',
                'slug' => 'permission-access',
            ],
            [
                'title' => 'role_create',
                'slug' => 'role-create',
            ],
            [
                'title' => 'role_edit',
                'slug' => 'role-edit',
            ],
            [
                'title' => 'role_show',
                'slug' => 'role-show',
            ],
            [
                'title' => 'role_delete',
                'slug' => 'role-delete',
            ],
            [
                'title' => 'role_access',
                'slug' => 'role-access',
            ],
            [
                'title' => 'user_create',
                'slug' => 'user-create',
            ],
            [
                'title' => 'user_edit',
                'slug' => 'user-edit',
            ],
            [
                'title' => 'user_show',
                'slug' => 'user-show',
            ],
            [
                'title' => 'user_delete',
                'slug' => 'user-delete',
            ],
            [
                'title' => 'user_access',
                'slug' => 'user-access',
            ],
            // [
            //     'title' => 'group_create',
            //     'slug' => 'group-create',
            // ],
            // [
            //     'title' => 'group_edit',
            //     'slug' => 'group-edit',
            // ],
            // [
            //     'title' => 'group_show',
            //     'slug' => 'group-show',
            // ],
            // [
            //     'title' => 'group_delete',
            //     'slug' => 'group-delete',
            // ],
            // [
            //     'title' => 'group_access',
            //     'slug' => 'group-access',
            // ],
            [
                'title' => 'course_create',
                'slug' => 'course-create',
            ],
            [
                'title' => 'course_edit',
                'slug' => 'course-edit',
            ],
            [
                'title' => 'course_show',
                'slug' => 'course-show',
            ],
            [
                'title' => 'course_delete',
                'slug' => 'course-delete',
            ],
            [
                'title' => 'course_access',
                'slug' => 'course-access',
            ],
            [
                'title' => 'lesson_create',
                'slug' => 'lesson-create',
            ],
            [
                'title' => 'lesson_edit',
                'slug' => 'lesson-edit',
            ],
            [
                'title' => 'lesson_show',
                'slug' => 'lesson-show',
            ],
            [
                'title' => 'lesson_delete',
                'slug' => 'lesson-delete',
            ],
            [
                'title' => 'lesson_access',
                'slug' => 'lesson-access',
            ],
            [
                'title' => 'category_create',
                'slug' => 'category-create',
            ],
            [
                'title' => 'category_edit',
                'slug' => 'category-edit',
            ],
            [
                'title' => 'category_show',
                'slug' => 'category-show',
            ],
            [
                'title' => 'category_delete',
                'slug' => 'category-delete',
            ],
            [
                'title' => 'category_access',
                'slug' => 'category-access',
            ],
            [
                'title' => 'quiz_create',
                'slug' => 'quiz-create',
            ],
            [
                'title' => 'quiz_edit',
                'slug' => 'quiz-edit',
            ],
            [
                'title' => 'quiz_show',
                'slug' => 'quiz-show',
            ],
            [
                'title' => 'quiz_delete',
                'slug' => 'quiz-delete',
            ],
            [
                'title' => 'quiz_access',
                'slug' => 'quiz-access',
            ],
            [
                'title' => 'question_create',
                'slug' => 'question-create',
            ],
            [
                'title' => 'question_edit',
                'slug' => 'question-edit',
            ],
            [
                'title' => 'question_show',
                'slug' => 'question-show',
            ],
            [
                'title' => 'question_delete',
                'slug' => 'question-delete',
            ],
            [
                'title' => 'question_access',
                'slug' => 'question-access',
            ],
            [
                'title' => 'grade_create',
                'slug' => 'grade-create',
            ],
            [
                'title' => 'grade_edit',
                'slug' => 'grade-edit',
            ],
            [
                'title' => 'grade_show',
                'slug' => 'grade-show',
            ],
            [
                'title' => 'grade_delete',
                'slug' => 'grade-delete',
            ],
            [
                'title' => 'grade_access',
                'slug' => 'grade-access',
            ]
            // [
            //     'title' => 'student_create',
            //     'slug' => 'student-create',
            // ],
            // [
            //     'title' => 'student_edit',
            //     'slug' => 'student-edit',
            // ],
            // [
            //     'title' => 'student_show',
            //     'slug' => 'student-show',
            // ],
            // [
            //     'title' => 'student_delete',
            //     'slug' => 'student-delete',
            // ],
            // [
            //     'title' => 'student_access',
            //     'slug' => 'student-access',
            // ],
        ];

        Permission::insert($permissions);
    }
}
