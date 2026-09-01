<?php

namespace App\Modules\User\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
    protected $deletedField     = 'deleted_at';

    protected $allowedFields = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
    ];

    /**
     * Roles a user may hold. Used by the model rules and the form select.
     *
     * @var list<string>
     */
    public const ROLES = ['admin', 'editor', 'user'];

    protected $validationRules = [
        // Present only on update, where it resolves the {id} placeholder in the
        // is_unique rule below. CI4 requires the placeholder field to have rules.
        'id'       => 'permit_empty|is_natural_no_zero',
        'name'     => 'required|min_length[2]|max_length[120]',
        'email'    => 'required|valid_email|max_length[190]|is_unique[users.email,id,{id}]',
        'password' => 'permit_empty|min_length[8]|max_length[72]',
        'role'     => 'required|in_list[admin,editor,user]',
    ];

    protected $validationMessages = [
        'email' => [
            'is_unique' => 'That email address is already registered.',
        ],
    ];

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    /**
     * Hash the password on the way in, and never store an empty one — on edit a
     * blank password field means "leave the existing password alone".
     *
     * @param array<string, mixed> $data
     *
     * @return array<string, mixed>
     */
    protected function hashPassword(array $data): array
    {
        if (! isset($data['data']['password'])) {
            return $data;
        }

        if ((string) $data['data']['password'] === '') {
            unset($data['data']['password']);

            return $data;
        }

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

        return $data;
    }
}
