<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="admin.css">
    <title>ELYSIUM - Contact Dashboard</title>
</head>

<body>
    <div style="display: flex; flex-direction: row;">
        <div style="display: flex; flex-direction: column;" class="divbtns">
            <button id="addButton" class="optionsbtns">
                <i class="fa-solid fa-plus"></i>
            </button>
            <button id="editButton" class="optionsbtns">
                <i class="fa-solid fa-pen-to-square"></i>
            </button>
            <button id="deleteButton" class="optionsbtns">
                <i class="fa-solid fa-trash"></i>
            </button>
            <button id="reserveButton" class="optionsbtns">
                <i class="fa-solid fa-chair"></i>
            </button>
            <button id="employeeButton" class="optionsbtns">
                <img src="../../assets/apron.svg" alt="" style='width: 55%'>
            </button>
            <button id="contactButton" class="optionsbtns">
                <i class="fa-solid fa-message"></i>
            </button>
            <button class="optionsbtns">
                <i class="fa-solid fa-user-tie"></i>
            </button>
        </div>
        <div class="dashboard-container text-center ">
            <div class="header">
                <h1>ELYSIUM</h1>
            </div>
            <h2 class="title text-center">Admin Management Dashboard</h2>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Authorization</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        session_start(); 
                        if (!isset($_SESSION['admin_name']) || $_SESSION['admin_role'] !== 'super admin') {
                            header("Location: ../login/dash_home.php");
                            exit();
                        }
                        
                        $conn = mysqli_connect("localhost", "root", "", "restaurant", 3307, "/opt/lampp/var/mysql/mysql.sock");

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT id, name, password, authorization FROM admins;";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "
                                    <tr data-id='" . $row['id'] . "'>
                                        <td>" . $row['id'] . "</td>
                                        <td class='editable name'>" . $row['name'] . "</td>
                                        <td class='editable authorization'>" . $row['authorization'] . "</td>
                                        <td> 
                                            <button class='manipulation edit-btn'><i class='fa-solid fa-pen-to-square'></i></button>
                                            <button class='manipulation delete-btn'><i class='fa-solid fa-trash'></i></button>
                                        </td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No Admins found</td></tr>";
                        }
                        $conn->close();
                    ?>
                </tbody>
            </table>
            <div class="header add">
                <h2 class="title mb-0 mt-2 p-0">Add An Admin</h2>
                <form class="login-form p-0" id="loginForm" method="post">
                    <span> <label for="name" style="display: block;">Name:</label>
                        <input type="text" id="name" name="name" placeholder="Enter your name" /> </span>

                    <span><label for="password" style="display: block;">Password:</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password" /></span>

                    <div class="d-flex checkbox m-0 p-0">
                        <label for="role">Select Role:</label>
                        <label>
                            <input type="radio" name="role" value="moderator" id="moderator" /> Moderator
                        </label>
                        <label>
                            <input type="radio" name="role" value="super admin" id="super_admin" /> SuperAdmin
                        </label>
                    </div>

                    <span class="error" id="errorMsg"></span>

                    <button type="submit" name="login-btn">Add</button>
                </form>
                <script>
                    const addAdminForm = document.getElementById('loginForm');

                    addAdminForm.addEventListener('submit', function (e) {
                        e.preventDefault();

                        const name = document.getElementById('name').value.trim();
                        const password = document.getElementById('password').value.trim();
                        const role = document.querySelector('input[name="role"]:checked')?.value;

                        if (!name || !password || !role) {
                            alert('All fields are required.');
                            return;
                        }

                        fetch('add_admin.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ name, password, role }),
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                alert(data.message || 'Admin added successfully.');
                                location.reload();
                            } else {
                                alert(data.error || 'Failed to add the admin.');
                            }
                        })
                        .catch((error) => {
                            console.error('Error:', error);
                            alert('Failed to add the admin. Please try again.');
                        });
                    });
                </script>


            </div>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('addButton').addEventListener('click', function () {
            window.location.href = '../../add/add.php';
        });

        document.getElementById('editButton').addEventListener('click', function () {
            window.location.href = '../../edit/edit.php';
        });
        
        document.getElementById('deleteButton').addEventListener('click', function () {
            window.location.href = '../../delete/delete.php';
        });

        document.getElementById('reserveButton').addEventListener('click', function () {
            window.location.href = '../../reserve/reserve.php';
        });

        document.getElementById('employeeButton').addEventListener('click', function () {
            window.location.href = '../../employee/employee.php';
        });

        document.getElementById('contactButton').addEventListener('click', function () {
            window.location.href = '../../contact/contact.php';
        });
        document.querySelectorAll('.edit-btn').forEach((btn) => {
            btn.addEventListener('click', function () {
                const row = this.closest('tr');
                const id = row.getAttribute('data-id');

                const nameCell = row.querySelector('.name');
                const authCell = row.querySelector('.authorization');

                nameCell.innerHTML = `<input type="text" class="form-control edit-name" value="${nameCell.textContent.trim()}">`;
                authCell.innerHTML = `<input type="text" class="form-control edit-auth" value="${authCell.textContent.trim()}">`;

                nameCell.querySelector('input').focus();

                row.addEventListener('keypress', function (event) {
                    if (event.key === 'Enter') {
                        const updatedName = row.querySelector('.edit-name').value.trim();
                        const updatedAuth = row.querySelector('.edit-auth').value.trim();

                        fetch('update_admin.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({ id, name: updatedName, authorization: updatedAuth }),
                        })
                            .then((response) => response.json())
                            .then((data) => {
                                if (data.success) {
                                    nameCell.textContent = updatedName;
                                    authCell.textContent = updatedAuth;
                                } else {
                                    alert(data.error || 'Update failed');
                                }
                            })
                            .catch((error) => console.error('Error:', error));
                    }
                });
            });
        });
        document.querySelectorAll('.delete-btn').forEach((btn) => {
            btn.addEventListener('click', function () {
                const row = this.closest('tr');
                const id = row.getAttribute('data-id');

                if (confirm('Are you sure you want to delete this admin?')) {
                    fetch('delete_admin.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id }),
                    })
                    .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                row.remove();
                alert('Admin deleted successfully.');
            } else {
                alert(data.error || 'Failed to delete the admin.');
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('Failed to delete admin. Please try again.');
        });
                }
            });
        });

    </script>
</body>

</html>
