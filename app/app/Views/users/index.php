<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5.3 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Users</h1>
            <a href="<?php echo site_url('users/create') ?>" class="btn btn-success">Add User</a>
        </div>

        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>

        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Username</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Date Created</th>
                        <th scope="col">Date Updated</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $user): ?>
                    <tr>
                        <td><?php echo esc($key + 1) ?></td>
                        <td><?php echo esc($user['name']) ?></td>
                        <td><?php echo esc($user['email']) ?></td>
                        <td><?php echo esc($user['username']) ?></td>
                        <td><?php echo esc($user['role_id'] == 1 ? 'Admin' : 'User') ?></td>
                        <td><?php echo esc($user['status'] == 1 ? 'Active' : 'Inactive') ?></td>
                        <td><?php echo esc($user['created_at']) ?></td>
                        <td><?php echo esc($user['updated_at']) ?></td>
                        <td class="text-center">
                            <a href="<?php echo site_url('users/edit/' . $user['id']) ?>"
                                class="btn btn-sm btn-primary me-1">Edit</a>
                            <form action="<?php echo site_url('users/delete/' . $user['id']) ?>" method="post"
                                class="d-inline">
                                <?php echo csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="<?php echo site_url('logout') ?>" class="btn btn-warning">Logout</a>

    </div>

    <!-- Bootstrap JS (for alert close button) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>