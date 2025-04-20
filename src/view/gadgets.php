<?php
require_once '../class/Gadget.php';
include 'header.php'; // Include header

$gadget = new Gadget();
$gadgets = $gadget->getAllGadgets();

// Initialize variables for the form
$edit_id = null;
$edit_name = '';
$edit_description = '';
$edit_gadget_number = '';
$edit_quantity = 0;
$form_action = 'add_gadget'; // Default action is add

// --- Handle Form Submissions ---

// Handle Add/Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_gadget'])) {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $gadget_number = $_POST['gadget_number'];
        $quantity = $_POST['quantity'];
        if ($gadget->addGadget($name, $description, $gadget_number, $quantity)) {
            header("Location: gadgets.php?status=added");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Failed to add gadget.</div>";
        }
    } elseif (isset($_POST['update_gadget'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $gadget_number = $_POST['gadget_number'];
        $quantity = $_POST['quantity'];
        if ($gadget->updateGadget($id, $name, $description, $gadget_number, $quantity)) {
            header("Location: gadgets.php?status=updated");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Failed to update gadget.</div>";
        }
    }
}

// Handle Delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($gadget->deleteGadget($id)) {
        header("Location: gadgets.php?status=deleted");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Failed to delete gadget. It might be associated with an experiment.</div>";
        $gadgets = $gadget->getAllGadgets(); // Refresh list
    }
}

// Handle Edit - Prepare form for editing
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    foreach ($gadgets as $g) {
        if ($g['id'] == $edit_id) {
            $edit_name = $g['name'];
            $edit_description = $g['description'];
            $edit_gadget_number = $g['gadget_number'];
            $edit_quantity = $g['quantity'];
            $form_action = 'update_gadget';
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
        case 'added': $message = 'Gadget added successfully!'; break;
        case 'updated': $message = 'Gadget updated successfully!'; break;
        case 'deleted': $message = 'Gadget deleted successfully!'; break;
        default: $message = ''; $alert_type = ''; break;
    }
    if ($message) {
        echo "<div class='alert alert-{$alert_type} alert-dismissible fade show' role='alert'>
                {$message}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    // Refresh list after action
    $gadgets = $gadget->getAllGadgets();
}

?>

<h2><?php echo $edit_id ? 'Edit' : 'Add New'; ?> Gadget</h2>
<form action="gadgets.php" method="POST" class="mb-5">
    <?php if ($edit_id): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_id); ?>">
    <?php endif; ?>
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($edit_name); ?>" required>
        </div>
        <div class="col-md-3">
            <label for="gadget_number" class="form-label">Gadget Number</label>
            <input type="text" class="form-control" id="gadget_number" name="gadget_number" value="<?php echo htmlspecialchars($edit_gadget_number); ?>" required>
        </div>
         <div class="col-md-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($edit_quantity); ?>" min="0" required>
        </div>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="2" required><?php echo htmlspecialchars($edit_description); ?></textarea>
    </div>
    <div class="d-flex justify-content-end">
         <?php if ($edit_id): ?>
             <a href="gadgets.php" class="btn btn-secondary me-2">Cancel</a>
         <?php endif; ?>
        <button type="submit" name="<?php echo $form_action; ?>" class="btn <?php echo $edit_id ? 'btn-success' : 'btn-primary'; ?>">
            <?php echo $edit_id ? 'Update Gadget' : 'Add Gadget'; ?>
        </button>
    </div>
</form>


<h2>Gadgets List</h2>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Gadget No.</th>
            <th>Quantity</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($gadgets) > 0): ?>
            <?php foreach ($gadgets as $g): ?>
            <tr>
                <td><?php echo htmlspecialchars($g['id']); ?></td>
                <td><?php echo htmlspecialchars($g['name']); ?></td>
                <td><?php echo htmlspecialchars($g['description']); ?></td>
                <td><?php echo htmlspecialchars($g['gadget_number']); ?></td>
                <td><?php echo htmlspecialchars($g['quantity']); ?></td>
                <td>
                    <a href="gadgets.php?action=edit&id=<?php echo $g['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="gadgets.php?action=delete&id=<?php echo $g['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No gadgets found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'footer.php'; // Include footer ?>
