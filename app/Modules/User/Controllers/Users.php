<?php

namespace App\Modules\User\Controllers;

use App\Modules\Admin\Controllers\AdminController;
use App\Modules\User\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Users extends AdminController
{
    protected string $menu = 'users';

    protected UserModel $users;

    /**
     * Rows shown per page in the listing.
     */
    protected int $perPage = 15;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        $this->helpers = ['form', 'url'];

        parent::initController($request, $response, $logger);

        $this->users = new UserModel();
    }

    /**
     * Paginated, searchable listing.
     */
    public function index(): string
    {
        $search = trim((string) $this->request->getGet('q'));

        if ($search !== '') {
            $this->users->groupStart()
                ->like('name', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        return $this->render('App\Modules\User\Views\index', [
            'title'  => 'Users',
            'users'  => $this->users->orderBy('id', 'DESC')->paginate($this->perPage),
            'pager'  => $this->users->pager,
            'search' => $search,
            'breadcrumbs' => ['Users' => ''],
        ]);
    }

    /**
     * Blank create form.
     */
    public function new(): string
    {
        return $this->render('App\Modules\User\Views\form', [
            'title'       => 'Add User',
            'user'        => null,
            'breadcrumbs' => ['Users' => 'admin/users', 'Add' => ''],
        ]);
    }

    public function create(): RedirectResponse
    {
        // Unlike edit, a new user must actually supply a password.
        $this->users->setValidationRule('password', 'required|min_length[8]|max_length[72]');

        if (! $this->users->save($this->payload())) {
            return redirect()->back()->withInput()->with('errors', $this->users->errors());
        }

        return redirect()->to('admin/users')->with('message', 'User created.');
    }

    /**
     * Edit form for one user.
     *
     * @return RedirectResponse|string
     */
    public function edit(int $id)
    {
        $user = $this->users->find($id);

        if ($user === null) {
            return redirect()->to('admin/users')->with('error', 'That user no longer exists.');
        }

        return $this->render('App\Modules\User\Views\form', [
            'title'       => 'Edit User',
            'user'        => $user,
            'breadcrumbs' => ['Users' => 'admin/users', 'Edit' => ''],
        ]);
    }

    public function update(int $id): RedirectResponse
    {
        if ($this->users->find($id) === null) {
            return redirect()->to('admin/users')->with('error', 'That user no longer exists.');
        }

        // A blank password on edit means "keep the current one" — the model
        // drops the empty value before it reaches the database.
        $payload = $this->payload();

        if ($payload['password'] === '') {
            unset($payload['password']);
        }

        // is_unique[users.email,id,{id}] resolves {id} from the data being
        // validated, so without this the row collides with its own email.
        // allowedFields still keeps the id out of the UPDATE itself.
        $payload['id'] = $id;

        if (! $this->users->update($id, $payload)) {
            return redirect()->back()->withInput()->with('errors', $this->users->errors());
        }

        return redirect()->to('admin/users')->with('message', 'User updated.');
    }

    public function delete(int $id): RedirectResponse
    {
        if ($this->users->find($id) === null) {
            return redirect()->to('admin/users')->with('error', 'That user no longer exists.');
        }

        $this->users->delete($id);

        return redirect()->to('admin/users')->with('message', 'User deleted.');
    }

    /**
     * The subset of the request the model is allowed to persist.
     *
     * @return array<string, mixed>
     */
    protected function payload(): array
    {
        return [
            'name'      => trim((string) $this->request->getPost('name')),
            'email'     => trim((string) $this->request->getPost('email')),
            'password'  => (string) $this->request->getPost('password'),
            'role'      => (string) $this->request->getPost('role'),
            'is_active' => $this->request->getPost('is_active') !== null ? 1 : 0,
        ];
    }
}
