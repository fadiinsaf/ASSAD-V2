<?php
session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../index.html");
    exit();
}
require_once __DIR__ . "/../database/database.php";
$stmt = $db->query("SELECT a.name AS animal_name, h.name AS habitat_name , a.diet_type , a.image, a.id FROM animals a INNER JOIN habitats h ON h.id = a.id_habitat", PDO::FETCH_ASSOC);
$animals = $stmt->fetchAll();

$stmt = $db->query("SELECT * FROM habitats", PDO::FETCH_ASSOC);
$habitats = $stmt->fetchAll();

$stmt = $db->query("SELECT * FROM users WHERE id != 1", PDO::FETCH_ASSOC);
$users = $stmt->fetchAll();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assad Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v6.3.0/css/all.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
        }

        .sidebar {
            background-color: #2c3e50;
            min-height: 100vh;
            color: white;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
        }

        .sidebar a:hover {
            background-color: #34495e;
        }

        .card-header {
            font-weight: bold;
        }

        .table thead {
            background-color: #d4edda;
        }
    </style>
</head>

<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h3 class="mb-4">ASAAD Admin</h3>
        </div>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <div class="container-fluid p-4">

            <div class="text-end mb-3">
                    <a href="../controllers/logout.php" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
                <section id="animals">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between">
                            <span><i class="fas fa-table me-1"></i> Animals List</span>
                            <a href="#add-animal" class="btn btn-success btn-sm">+ Add Animal</a>
                        </div>
                        <div class="card-body">
                            <!-- Filters -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="filterHabitat" class="form-label">Filter by Habitat</label>
                                    <select id="filterHabitat" class="form-select">
                                        <option value="all">All Habitats</option>
                                        <?php
                                        foreach ($habitats as $habitat) {
                                            echo "<option value='{$habitat['name']}'>{$habitat['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="filterType" class="form-label">Filter by Type</label>
                                    <select id="filterType" class="form-select">
                                        <option value="all">All Types</option>
                                        <option value="CARNIVORE">CARNIVORE</option>
                                        <option value="HERBIVORE">HERBIVORE</option>
                                        <option value="OMNIVORE">OMNIVORE</option>
                                    </select>
                                </div>
                            </div>

                            <table class="table table-striped" id="animalsTable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Habitat</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($animals) > 0) {
                                        foreach ($animals as $animal) {
                                            echo "
                                                <tr>
                                                    <td>{$animal['animal_name']}</td>
                                                    <td>{$animal['diet_type']}</td>
                                                    <td>{$animal['habitat_name']}</td>
                                                    <td><img src='/../assets/{$animal['image']}' width='50'></td>
                                                    <td class='d-flex gap-2'>
                                                        <a href='/../controllers/edit_animal.php?id={$animal['id']}' class='btn btn-primary btn-sm'>Edit</a>
                                                        <form action='/../controllers/delete_animal.php' method='post'>
                                                            <input type='hidden' name='id' value='{$animal['id']}'/>
                                                            <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            ";
                                        }
                                    } else {
                                        echo "NO ANIMALS FOR NOW";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Add Animal -->
                <section id="add-animal">
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-plus me-1"></i> Add New Animal</div>
                        <div class="card-body">
                            <form action="/../controllers/add_animal.php" enctype="multipart/form-data" method="post">
                                <div class="mb-3">
                                    <label class="form-label">Animal Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g. Lion">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Animal Species</label>
                                    <input type="text" name="species" class="form-control" placeholder="Pnathera">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Type</label>
                                    <select class="form-select" name="diet_type">
                                        <option value="CARNIVORE">CARNIVORE</option>
                                        <option value="HERBIVORE">HERBIVORE</option>
                                        <option value="OMNIVORE">OMNIVORE</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Habitat</label>
                                    <select class="form-select" name="id">
                                        <?php
                                        foreach ($habitats as $habitat) {
                                            echo "
                                                <option value='{$habitat['id']}'>{$habitat['name']}</option>
                                            ";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Short Description</label>
                                    <input type="text" class="form-control" name="short_description"
                                        placeholder="Description">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Image</label>
                                    <input type="file" class="form-control" name="image">
                                </div>

                                <button type="submit" class="btn btn-success">Add Animal</button>
                            </form>
                        </div>
                    </div>
                </section>

                <!-- Habitats -->
                <section id="habitats">
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-leaf me-1"></i> Habitats</div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($habitats) > 0) {
                                        foreach ($habitats as $habitat) {
                                            echo "
                                                <tr>
                                                        <td>{$habitat['name']}</td>
                                                        <td>{$habitat['description']}</td>
                                                        <td class='d-flex gap-2'>
                                                            <a href='/../controllers/edit_habitat.php?id={$habitat['id']}' class='btn btn-primary btn-sm'>Edit</a>
                                                            <form method='post' action='/../controllers/delete_habitat.php'>
                                                                <input type='hidden' name='id' value='{$habitat['id']}'>
                                                                <button type='submit' class='btn btn-danger btn-sm'>Delete</button>
                                                            </form>
                                                        </td>
                                                </tr>
                                            ";
                                        }
                                    } else {
                                        echo "NO HABITATS FOR NOW";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Add Habitat -->
                <section id="add-habitat">
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-plus me-1"></i> Add New Habitat</div>
                        <div class="card-body">
                            <form method="post" action="/../controllers/add_habitat.php">
                                <div class="mb-3">
                                    <label class="form-label">Habita Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Jangle">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Zoo Zone</label>
                                    <input type="text" class="form-control" placeholder='REPTILE_HOUSE' name="zoo_zone"
                                        value="<?= $habtiat["zoo_zone"] ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Habitat Description</label>
                                    <input type="text" class="form-control" name="description"
                                        placeholder="Description">
                                </div>

                                <button type="submit" class="btn btn-success">Add Habitat</button>
                            </form>
                        </div>
                    </div>
                </section>

                <!-- Users Section -->
                <section id="users">
                    <div class="card mb-4">
                        <div class="card-header">Users Management</div>
                        <div class="card-body">
                            <table class="table table-striped">

                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    foreach ($users as $user) {
                                        $sts;
                                        $active_button;
                                        $approved;
                                        if ($user["is_active"] === 0) {
                                            $sts = "desactive";
                                            $activate_button = "Activate";
                                        } else {
                                            $sts = "Active";
                                            $activate_button = "desactivate";
                                        }

                                        if ($user["is_approved"] === 0) {
                                            echo "    
                                                <tr>
                                                    <td>{$user['name']}</td>
                                                    <td>{$user['email']}</td>
                                                    <td>{$user['role']}</td>
                                                    <td>Wait Approving</td>
                                                    <td class='d-flex gap-2'>

                                                        <form method='POST' action='/../controllers/user_approve.php'>
                                                            <input type='hidden' name='id' value='{$user['id']}'>
                                                            <button type='submit' class='btn btn-success btn-sm'>Approve</button>
                                                        </form>
                                                </tr>                                   
                                            ";
                                        } else {
                                            echo "    
                                            <tr>
                                                <td>{$user['name']}</td>
                                                <td>{$user['email']}</td>
                                                <td>{$user['role']}</td>
                                                <td>$sts</td>
                                                <td class='d-flex gap-2'>
                                                    <form method='POST' action='/../controllers/user_activate.php'>
                                                        <input type='hidden' name='id' value='{$user['id']}'>
                                                        <input type='hidden' name='status' value='{$user['is_active']}'>
                                                         <button type='submit' class='btn btn-warning btn-sm'>$activate_button</button>
                                                    </form>
                                                </td>
                                            </tr>                                   
                                        ";
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>