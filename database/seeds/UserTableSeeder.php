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

			for ($i=1; $i<5; $i++) {
				$teacher = User::create(array(
					"name" => "teacher".$i,
					"email" => "teacher@yahoo.com".$i,
					"password" => Hash::make("business"),
					"slug" => 'teacher_slug'.$i,
				));
			}

			for ($i=1; $i<5; $i++) {
				$guardian = User::create(array(
					"name" => "parent".$i,
					"email" => "jontoshmatov@yahoo.com".$i,
					"password" => Hash::make("business"),
					"slug" => 'parent_slug'.$i,
				));
			}

			for ($i=1; $i<5; $i++) {
				$child = User::create(array(
					"name" => "child".$i,
					"email" => "child@child.com".$i,
					"password" => Hash::make("business"),
					"slug" => 'child_slug'.$i,
				));
			}


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

			for ($i=1; $i<5; $i++) {
				$district = District::create(array(
					"title" => "District ".$i,
					"description" => "District:".$i." Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy tex ",
				));
			}
			for ($i=1; $i<5; $i++) {
				$organization = Organization::create(array(
					"title" => "Organization ".$i,
					"description" => "School:".$i." Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy tex ",
				));
			}

			DB::table('district_organization')->insert([
				'district_id' => $district->id,
				'organization_id' => $organization->id,
			]);

			for ($i=1; $i<5; $i++) {
				$class = Group::create(array(
					"organization_id" => $organization->id,
					"title" => "Class ".$i,
					"description" => "Class:".$i." Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy tex ",
				));
			}




			//$child->delete();

		}

	}
