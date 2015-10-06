<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use cmwn\User;
use cmwn\Role;
use cmwn\Group;
use cmwn\Organization;
use cmwn\District;


	class UserTableSeeder extends Seeder {

		public function run()
		{

			DB::table('users')->delete();
			DB::table('child_guardian')->delete();


			$teacher = User::create(array(
				"name" => "teacher",
				"email" => "teacher@yahoo.com",
				"password" => Hash::make("business"),
				"slug" => 'teacher_slug',
			));

			$guardian = User::create(array(
                "name" => "parent",
                "email" => "jontoshmatov@yahoo.com",
                "password" => Hash::make("business"),
                "slug" => 'parent_slug',
            ));


			$child = User::create(array(
				"name" => "child",
				"email" => "child@child.com",
				"password" => Hash::make("business"),
				"slug" => 'child_slug',
			));


			DB::table('roles')->delete();

			$admin = Role::create(array(
				"title" => "admin",
			));

			Role::create(array(
				"title" => "principal",
			));

			$role_teacher = Role::create(array(
				"title" => "teacher",
			));

			$role_student = Role::create(array(
				"title" => "student",
			));



			DB::table('child_guardian')->insert([
				'guardian_id' => $guardian->id,
				'child_id' => $child->id,
			]);

			$district = District::create(array(
				"title" => "District 1",
			));

			$organization = Organization::create(array(
				"title" => "Organization 1",
			));

			DB::table('district_organization')->insert([
				'district_id' => $district->id,
				'organization_id' => $organization->id,
			]);

			$class = Group::create(array(
				"organization_id" => $organization->id,
				"title" => "Class 1",
			));


			DB::table('organization_user')->insert([
				'user_id' => $teacher->id,
				'organization_id' => $organization->id,
				'role_id' => $role_teacher->id,
			]);

			DB::table('group_user')->insert([
				'user_id' => $teacher->id,
				'group_id' => $class->id,
				'role_id' => $role_teacher->id,
			]);

			DB::table('organization_user')->insert([
				'user_id' => $child->id,
				'organization_id' => $organization->id,
				'role_id' => $role_student->id,
			]);

			DB::table('group_user')->insert([
				'user_id' => $child->id,
				'group_id' => $class->id,
				'role_id' => $role_student->id,
			]);

			//$child->delete();

		}

	}
