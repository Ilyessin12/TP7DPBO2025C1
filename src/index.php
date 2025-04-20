<?php
// Include necessary class files
require_once 'class/LabMember.php';
require_once 'class/Gadget.php';
require_once 'class/Experiment.php';

// Load stats for the dashboard
$labMember = new LabMember();
$gadget = new Gadget();
$experiment = new Experiment();

$memberCount = count($labMember->getAllMembers());
$gadgetCount = count($gadget->getAllGadgets());
$experimentCount = count($experiment->getAllExperiments());

// Get recent experiments (limit to 5)
$recentExperiments = $experiment->getAllExperiments();
// Sort experiments by start date, newest first
usort($recentExperiments, function($a, $b) {
    return strtotime($b['start_date']) - strtotime($a['start_date']);
});
// Take only the first 5
$recentExperiments = array_slice($recentExperiments, 0, 5);

// Include header
include 'view/header.php';
?>

<div class="container-fluid px-4 py-2">
    <div class="row align-items-center mb-4">
        <div class="col">
            <h1 class="display-5 fw-bold text-success">Future Gadget Laboratory</h1>
            <p class="lead">Welcome to the Future Gadget Lab Management System</p>
        </div>
        <div class="col-auto">
            <div class="d-flex">
                <a href="view/lab_members.php" class="btn btn-primary me-2">
                    <i class="bi bi-people-fill me-2"></i>Lab Members
                </a>
                <a href="view/experiments.php" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i>New Experiment
                </a>
            </div>
        </div>
    </div>

    <!-- Dashboard Stats -->
    <div class="row">
        <div class="col-md-4">
            <div class="card stats-card mb-4">
                <div class="card-body">
                    <div class="stat-value"><?php echo $memberCount; ?></div>
                    <div class="stat-label">Lab Members</div>
                    <div class="mt-3">
                        <a href="view/lab_members.php" class="btn btn-outline-success btn-sm">View All</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stats-card mb-4">
                <div class="card-body">
                    <div class="stat-value"><?php echo $gadgetCount; ?></div>
                    <div class="stat-label">Gadgets</div>
                    <div class="mt-3">
                        <a href="view/gadgets.php" class="btn btn-outline-success btn-sm">View All</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stats-card mb-4">
                <div class="card-body">
                    <div class="stat-value"><?php echo $experimentCount; ?></div>
                    <div class="stat-label">Experiments</div>
                    <div class="mt-3">
                        <a href="view/experiments.php" class="btn btn-outline-success btn-sm">View All</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions Section -->
    <div class="row mb-4">
        <div class="col-12">
            <h3 class="text-success mb-3">Quick Actions</h3>
        </div>
        <div class="col-md-3">
            <a href="view/lab_members.php?action=new" class="action-btn text-decoration-none text-dark mb-4">
                <i class="bi bi-person-plus"></i>
                <span>Add Lab Member</span>
            </a>
        </div>
        <div class="col-md-3">
            <a href="view/gadgets.php?action=new" class="action-btn text-decoration-none text-dark mb-4">
                <i class="bi bi-tools"></i>
                <span>Add Gadget</span>
            </a>
        </div>
        <div class="col-md-3">
            <a href="view/experiments.php?action=new" class="action-btn text-decoration-none text-dark mb-4">
                <i class="bi bi-clipboard-data"></i>
                <span>Record Experiment</span>
            </a>
        </div>
        <div class="col-md-3">
            <a href="#" class="action-btn text-decoration-none text-dark mb-4">
                <i class="bi bi-search"></i>
                <span>Search</span>
            </a>
        </div>
    </div>

    <!-- Recent Experiments -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Recent Experiments</span>
                    <a href="view/experiments.php" class="btn btn-sm btn-outline-light">View All</a>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Gadget</th>
                                <th>Researcher</th>
                                <th>Start Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($recentExperiments) > 0): ?>
                                <?php foreach ($recentExperiments as $exp): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($exp['gadget_name']); ?></td>
                                    <td><?php echo htmlspecialchars($exp['member_name']); ?></td>
                                    <td><?php echo htmlspecialchars($exp['start_date']); ?></td>
                                    <td>
                                        <?php if (empty($exp['end_date'])): ?>
                                            <span class="badge bg-success">Ongoing</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">Completed</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No experiments found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'view/footer.php'; ?>
