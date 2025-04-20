<?php
require_once '../class/LabMember.php';
include 'header.php'; // Include header

$labMember = new LabMember();
$members = $labMember->getAllMembers();

// Initialize variables for the form
$edit_id = null;
$edit_name = '';
$edit_email = '';
$edit_phone = '';
$form_action = 'add_member'; // Default action is add

// --- Handle Form Submissions ---

// Handle Add/Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_member'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        if ($labMember->addMember($name, $email, $phone)) {
            // Redirect to avoid form resubmission
            header("Location: lab_members.php?status=added");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Failed to add member.</div>";
        }
    } elseif (isset($_POST['update_member'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        if ($labMember->updateMember($id, $name, $email, $phone)) {
            header("Location: lab_members.php?status=updated");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Failed to update member.</div>";
        }
    }
}

// Handle Delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($labMember->deleteMember($id)) {
        header("Location: lab_members.php?status=deleted");
        exit();
    } else {
        // Handle potential foreign key constraint error etc.
        echo "<div class='alert alert-danger'>Failed to delete member. It might be associated with an experiment.</div>";
        // Refresh member list after showing error
        $members = $labMember->getAllMembers();
    }
}

// Handle Edit - Prepare form for editing
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    // Fetch the specific member's data - requires a getById method or filtering the list
    // For simplicity, let's filter the existing list (not ideal for large datasets)
    foreach ($members as $member) {
        if ($member['id'] == $edit_id) {
            $edit_name = $member['name'];
            $edit_email = $member['email'];
            $edit_phone = $member['phone'];
            $form_action = 'update_member'; // Change form action to update
            break;
        }
    }
}

// Display status messages
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    $message = '';
    $alert_type = 'success';
    switch ($status) {
        case 'added': $message = 'Member added successfully!'; break;
        case 'updated': $message = 'Member updated successfully!'; break;
        case 'deleted': $message = 'Member deleted successfully!'; break;
        default: $message = ''; $alert_type = ''; break;
    }
    if ($message) {
        echo "<div class='alert alert-{$alert_type} alert-dismissible fade show' role='alert'>
                {$message}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    // Refresh member list after action
    $members = $labMember->getAllMembers();
}


?>

<h2><?php echo $edit_id ? 'Edit' : 'Add New'; ?> Lab Member</h2>
<form action="lab_members.php" method="POST" class="mb-5">
    <?php if ($edit_id): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_id); ?>">
    <?php endif; ?>
    <div class="row g-3">
        <div class="col-md-4">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($edit_name); ?>" required>
        </div>
        <div class="col-md-4">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($edit_email); ?>" required>
        </div>
        <div class="col-md-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($edit_phone); ?>">
        </div>
        <div class="col-md-1 align-self-end">
            <button type="submit" name="<?php echo $form_action; ?>" class="btn <?php echo $edit_id ? 'btn-success' : 'btn-primary'; ?> w-100">
                <?php echo $edit_id ? 'Update' : 'Add'; ?>
            </button>
        </div>
         <?php if ($edit_id): ?>
         <div class="col-md-1 align-self-end">
             <a href="lab_members.php" class="btn btn-secondary w-100">Cancel</a>
         </div>
         <?php endif; ?>
    </div>
</form>


<h2>Lab Members List</h2>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($members) > 0): ?>
            <?php foreach ($members as $member): ?>
            <tr>
                <td><?php echo htmlspecialchars($member['id']); ?></td>
                <td><?php echo htmlspecialchars($member['name']); ?></td>
                <td><?php echo htmlspecialchars($member['email']); ?></td>
                <td><?php echo htmlspecialchars($member['phone']); ?></td>
                <td>
                    <a href="lab_members.php?action=edit&id=<?php echo $member['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="lab_members.php?action=delete&id=<?php echo $member['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No lab members found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'footer.php'; // Include footer ?>
