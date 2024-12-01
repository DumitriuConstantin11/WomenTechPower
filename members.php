<?php
session_start();
include_once "config/database.php";
include_once "includes/header.php";
$database = new DBController();

$search = isset($_GET['query']) ? $_GET['query'] : '';
$order = isset($_GET['order']) ? $_GET['order'] : 'created_at';
$direction = isset($_GET['direction']) ? $_GET['direction'] : 'DESC';
$selectedProfession = isset($_GET['profession']) ? $_GET['profession'] : '';
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

$validOrders = ['last_name', 'created_at', 'role'];
$validDirections = ['ASC', 'DESC'];

if (!in_array($order, $validOrders)) {
    $order = 'created_at';
}
if (!in_array($direction, $validDirections)) {
    $direction = 'DESC';
}

$directionToggle = ($direction === 'ASC') ? 'DESC' : 'ASC';
$nameDirection = ($order === 'last_name' && $direction === 'ASC') ? 'DESC' : 'ASC';
$dateDirection = ($order === 'created_at' && $direction === 'ASC') ? 'DESC' : 'ASC';

$professionQuery = "SELECT DISTINCT profession FROM members WHERE role != 'Admin' AND profession IS NOT NULL AND profession != (SELECT profession FROM members WHERE id = ?) ORDER BY profession";
$professions = $database->getDBResult($professionQuery, [$_SESSION['member_id']]);




$query = "SELECT * FROM members WHERE 1 AND role != :adminRole AND id != :currentUserId";
$params = [
    ':adminRole' => 'Admin',
    ':currentUserId' => $_SESSION['member_id']
];

if (!empty($search)) {
    $query .= " AND (first_name LIKE :search OR last_name LIKE :search OR profession LIKE :search)";
    $params[':search'] = '%' . $search . '%';
}

if (!empty($selectedProfession)) {
    $query .= " AND profession = :profession";
    $params[':profession'] = $selectedProfession;
}
$selectedRole = isset($_GET['roleFilter']) ? $_GET['roleFilter'] : '';

if (!empty($selectedRole)) {
    $query .= " AND role = :roleFilter";
    $params[':roleFilter'] = $selectedRole;
}

$query .= " ORDER BY $order $direction";

$allMembers = $database->getDBResult($query, $params);


$limit = 6;
$page = max($page, 1);
$totalMembers = count($allMembers);
$totalPages = ceil($totalMembers / $limit);
$membersToDisplay = array_slice($allMembers, ($page - 1) * $limit, $limit);




?>
<h2 class="text-white">Members Directory</h2>
<div style="display: flex; justify-content: space-between; align-items: center;">
    <div>
        <h5 class="text-white" style="display: inline;">
            Sort by:
            <a class="text-white" href="?order=last_name&direction=<?php echo $nameDirection; ?>">
                name <?php echo ($order === 'last_name') ? $direction : 'ASC'; ?>
            </a> /
            <a class="text-white" href="?order=created_at&direction=<?php echo $dateDirection; ?>">
                joining date <?php echo ($order === 'created_at') ? $direction : 'DESC'; ?>
            </a>
        </h5>
    </div>
</div>
<h5 class="text-white pt-1" style="display: flex; align-items: center; ">
    Profession:
    <form method="get">
        <select name="profession" onchange="this.form.submit()">
            <option value="">All</option>
            <?php
            $professionsQuery = "SELECT DISTINCT profession FROM members WHERE role != 'Admin' AND id!=? AND profession IS NOT NULL ORDER BY profession ";
            $params=[$_SESSION['member_id']];
            $professionsStmt = $database->getDBResult($professionsQuery, $params);
            foreach ($professionsStmt as $professionRow) {
                $selected = ($selectedProfession === $professionRow['profession']) ? 'selected' : '';
                echo "<option value='{$professionRow['profession']}' $selected>{$professionRow['profession']}</option>";
            }
            ?>
        </select>
    </form>
</h5>
<div style="display: flex; justify-content: space-between; align-items: center;">
<h5 class="text-white mb-0" >
    <form method="get" >
        <label for="roleFilter" class="text-white">Role:</label>
        <select name="roleFilter" id="roleFilter" onchange="this.form.submit()">
            <option value="">All</option>
            <option value="Member" <?php echo ($selectedRole === 'Member') ? 'selected' : ''; ?>>Members</option>
            <option value="Mentor" <?php echo ($selectedRole === 'Mentor') ? 'selected' : ''; ?>>Mentors</option>
        </select>
    </form>
</h5>
    <form method="get" style="display: flex; align-items: center">
        <input type="text" name="query" placeholder="Cauta un membru" value="<?php echo htmlspecialchars($search); ?>" style="padding: 5px;">
        <button type="submit" style="padding: 5px;">🔎</button>
    </form>
</div>

<div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>">Prev</a>
    <?php endif; ?>

    <?php if ($page < $totalPages): ?>
        <a href="?page=<?php echo $page + 1; ?>">Next</a>
    <?php endif; ?>
</div>
<div class="row">
    <?php foreach($membersToDisplay as $row): ?>

        <div class="col-md-4">

            <div class="card member-card">
                <a class="card-link" style="text-decoration: none; color: inherit;" href="m_profile.php?id=<?php echo $row['id']; ?>">
                <div class="card-head m-t-5">
                    <h5 class=" text-center text-white"><?php echo htmlspecialchars($row['role']); ?></h5>
                </div>
                </a>
                <div class="card-body">
                    <a class="card-link" style="text-decoration: none; color: inherit;" href="m_profile.php?id=<?php echo $row['id']; ?>">
                    <h5 class="card-title text-center"><?php echo htmlspecialchars($row['first_name'] . ' ' .
                            $row['last_name']); ?></h5>
                    <img src="<?php echo htmlspecialchars($row['profile_pic']); ?>" class="rounded-circle card-img-top" alt="..." >

                    <p class="card-text text-center">
                        <strong>Profession:</strong> <?php echo
                        htmlspecialchars($row['profession']); ?><br>
                        <strong>Company:</strong> <?php echo htmlspecialchars($row['company']);
                        ?>
                    </p>
                    </a>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'Admin'): ?>
                        <a href="edit_member.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm mx-1">Edit</a>
                        <a href="delete_member.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm mx-1" onclick="return confirm('Are you sure?')">Delete</a>
                    <?php endif; ?>

                </div>

            </div>
        </div>

    <?php endforeach; ?>
</div>

<?php
include_once "includes/footer.php";
?>

