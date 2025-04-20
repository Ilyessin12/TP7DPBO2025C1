<?php
require_once '../class/Experiment.php';
require_once '../class/Gadget.php';     // Needed for dropdown
require_once '../class/LabMember.php'; // Needed for dropdown
include 'header.php'; // Include header

$experiment = new Experiment();
$gadget = new Gadget();
$labMember = new LabMember();

$experiments = $experiment->getAllExperiments();
$gadgets = $gadget->getAllGadgets();         // Fetch gadgets for dropdown
$members = $labMember->getAllMembers();     // Fetch members for dropdown

// Initialize variables for the form
$edit_id = null;
$edit_gadget_id = '';
$edit_member_id = '';
$edit_start_date = date('Y-m-d'); // Default to today
$edit_end_date = '';
$form_action = 'add_experiment'; // Default action is add

// --- Handle Form Submissions ---

// Handle Add/Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gadget_id = $_POST['gadget_id'];
    $member_id = $_POST['member_id'];
    $start_date = $_POST['start_date'];
    // Handle potentially empty end date
    $end_date = !empty($_POST['end_date']) ? $_POST['end_date'] : null;

    if (isset($_POST['add_experiment'])) {
        if ($experiment->addExperiment($gadget_id, $member_id, $start_date, $end_date)) {
            header("Location: experiments.php?status=added");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Failed to add experiment.</div>";
        }
    } elseif (isset($_POST['update_experiment'])) {
        $id = $_POST['id'];
        if ($experiment->updateExperiment($id, $gadget_id, $member_id, $start_date, $end_date)) {
            header("Location: experiments.php?status=updated");
            exit();
        } else {
            echo "<div class='alert alert-danger'>Failed to update experiment.</div>";
        }
    }
}

// Handle Delete
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($experiment->deleteExperiment($id)) {
        header("Location: experiments.php?status=deleted");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Failed to delete experiment.</div>";
        $experiments = $experiment->getAllExperiments(); // Refresh list
    }
}

// Handle Edit - Prepare form for editing
if (isset($_GET['action']) && $_GET['action'] === 'edit' && isset($_GET['id'])) {
    $edit_id = $_GET['id'];
    // Fetch the specific experiment's data - requires a getById method or filtering
    // Filtering the list for simplicity
    foreach ($experiments as $exp) {
        if ($exp['id'] == $edit_id) {
            $edit_gadget_id = $exp['gadget_id'];
            $edit_member_id = $exp['member_id'];
            $edit_start_date = $exp['start_date'];
            $edit_end_date = $exp['end_date'];
            $form_action = 'update_experiment';
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
        case 'added': $message = 'Experiment added successfully!'; break;
        case 'updated': $message = 'Experiment updated successfully!'; break;
        case 'deleted': $message = 'Experiment deleted successfully!'; break;
        default: $message = ''; $alert_type = ''; break;
    }
    if ($message) {
        echo "<div class='alert alert-{$alert_type} alert-dismissible fade show' role='alert'>
                {$message}
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
              </div>";
    }
    // Refresh list after action
    $experiments = $experiment->getAllExperiments();
}

?>

<h2><?php echo $edit_id ? 'Edit' : 'Add New'; ?> Experiment</h2>
<form action="experiments.php" method="POST" class="mb-5">
    <?php if ($edit_id): ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_id); ?>">
    <?php endif; ?>
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label for="gadget_id" class="form-label">Gadget</label>
            <select class="form-select" id="gadget_id" name="gadget_id" required>
                <option value="">Select Gadget</option>
                <?php foreach ($gadgets as $g): ?>
                    <option value="<?php echo $g['id']; ?>" <?php echo ($g['id'] == $edit_gadget_id) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($g['name']) . " (" . htmlspecialchars($g['gadget_number']) . ")"; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-6">
            <label for="member_id" class="form-label">Lab Member</label>
            <select class="form-select" id="member_id" name="member_id" required>
                <option value="">Select Member</option>
                 <?php foreach ($members as $member): ?>
                    <option value="<?php echo $member['id']; ?>" <?php echo ($member['id'] == $edit_member_id) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($member['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
     <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label for="start_date" class="form-label">Start Date</label>
            <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo htmlspecialchars($edit_start_date); ?>" required>
        </div>
        <div class="col-md-6">
            <label for="end_date" class="form-label">End Date (Optional)</label>
            <input type="date" class="form-control" id="end_date" name="end_date" value="<?php echo htmlspecialchars($edit_end_date); ?>">
        </div>
    </div>
    <div class="d-flex justify-content-end">
         <?php if ($edit_id): ?>
             <a href="experiments.php" class="btn btn-secondary me-2">Cancel</a>
         <?php endif; ?>
        <button type="submit" name="<?php echo $form_action; ?>" class="btn <?php echo $edit_id ? 'btn-success' : 'btn-primary'; ?>">
            <?php echo $edit_id ? 'Update Experiment' : 'Add Experiment'; ?>
        </button>
    </div>
</form>


<h2>Experiments List</h2>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Gadget</th>
            <th>Member</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($experiments) > 0): ?>
            <?php foreach ($experiments as $exp): ?>
            <tr>
                <td><?php echo htmlspecialchars($exp['id']); ?></td>
                <td><?php echo htmlspecialchars($exp['gadget_name']); ?></td>
                <td><?php echo htmlspecialchars($exp['member_name']); ?></td>
                <td><?php echo htmlspecialchars($exp['start_date']); ?></td>
                <td><?php echo htmlspecialchars($exp['end_date'] ?? 'Ongoing'); ?></td>
                <td>
                    <a href="experiments.php?action=edit&id=<?php echo $exp['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="experiments.php?action=delete&id=<?php echo $exp['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete();">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">No experiments found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include 'footer.php'; // Include footer ?>
