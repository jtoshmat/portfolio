<?php

namespace app\Transformer;

use app\Group;
use League\Fractal\TransformerAbstract;

class GroupTransformer extends TransformerAbstract
{
    protected $availableIncludes = [
        'users',
        'teachers',
        'students',
        'principals'
    ];

    /**
     * Turn this item object into a generic array.
     *
     * @return array
     */
    public function transform(Group $group)
    {
        return [
            'id'            => (int) $group->id,
            'title'         => $group->title,
            'description'   => $group->description,
            'created_at'    => (string) $group->created_at,
        ];
    }

    /**
     * Embed Friends.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeUsers(Group $group)
    {
        $users = $group->users;
        return $this->collection($users, new UserTransformer());
    }

    /**
     * Embed Teachers.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeTeachers(Group $group)
    {
        $teachers = $group->teachers;
        return $this->collection($teachers, new UserTransformer());
    }

    /**
     * Embed Students.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includeStudents(Group $group)
    {
        $students = $group->students;
        return $this->collection($students, new UserTransformer());
    }


    /**
     * Embed Principals.
     *
     * @return League\Fractal\Resource\Collection
     */
    public function includePrincipals(Group $group)
    {
        $principals = $group->principals;
        return $this->collection($principals, new UserTransformer());
    }
}
