<?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userid = $_POST['userid'];
    $roleid = $_POST['roleid'];
    include_once("functions.php");
    $link = connect_to_db("localhost", "root", "", "agencydb", 3306);
    $upd = 'UPDATE users SET roleid=' . $roleid;

    $upd .= ' WHERE id=' . $userid;
    mysqli_query($link, $upd);
}
?>

<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>Login</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?
            include_once("functions.php");
            $link = connect_to_db("localhost", "root", "", "agencydb", 3306);

            $sel = "SELECT Ci.Id, Ci.Login, Co.RoleName FROM Users Ci LEFT JOIN Roles Co ON Ci.RoleId = Co.Id";
            $res = mysqli_query($link, $sel);

            while ($row = mysqli_fetch_array($res)) {
                echo '<tr>';
                echo '<td>' . $row[0] . '</td>';
                echo '<td>' . $row[1] . '</td>';
                echo '<td>' . $row[2] . '</td>';
                echo '</tr>';
            }

            mysqli_free_result($res);
            ?>
        </tbody>
    </table>
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="userid">ID пользователя:</label>
            <input type="text" class="form-control" id="userid" name="userid" required>
        </div>
        <div class="form-group">
            <label for="roleid">Новая роль:</label>
            <select class="form-control" id="roleid" name="roleid">
                <option value="1">Admin</option>
                <option value="2">Customer</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Изменить роль</button>
    </form>
</div>