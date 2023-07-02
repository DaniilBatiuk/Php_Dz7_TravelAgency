<?
if (isset($_SESSION["hoteladderr"]))
    echo "<div class='alert alert-warning'>" . $_SESSION["hoteladderr"] . "</div>";
?>
<table class="table table-striped mb-3">
    <thead>
        <tr>
            <th>Id</th>
            <th>HotelName</th>
            <th>Description</th>
            <th>Price</th>
            <th>Stars</th>
            <th>City</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?
        $q4 = "SELECT Ci.Id, Ci.HotelName,Ci.Description,Ci.Price,Ci.Stars, Co.City FROM Hotels Ci LEFT JOIN Cities Co ON Ci.CityId = Co.Id";
        $res = mysqli_query($link, $q4);
        $err = mysqli_errno($link);
        if ($err) {
            echo "<div class='alert alert-warning'>$err</div>";
        } else
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                echo "<tr>";
                echo "<td>$row[0]</td>";
                echo "<td>$row[1]</td>";
                echo "<td>$row[2]</td>";
                echo "<td>$row[3]</td>";
                echo "<td>$row[4]</td>";
                echo "<td>$row[5]</td>";
                echo "<td><input type='checkbox' class='form-check-input'
                         name='delhotels[]' value='" . $row[0] . "' form='hotelform'></input></td>";
                echo "</tr>";
            }
        mysqli_free_result($res);
        ?>
    </tbody>
</table>
<form method="post" id="hotelform">
    <div class="mb-3">
        <select class="form-select" aria-label="Default select example" name="CityId">
            <option value="0" selected>Choose city</option>
            <?
            $q5 = "SELECT * FROM Cities";
            $res = mysqli_query($link, $q5);
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
            }
            ?>
            mysqli_free_result($res);
        </select>
    </div>
    <div class="mb-3">
        <label for="HotelName" class="form-label">HotelName</label>
        <input type="text" class="form-control" id="HotelName" placeholder="Add new HotelName..." name="HotelName">
    </div>
    <div class="mb-3">
        <label for="Description" class="form-label">Description</label>
        <input type="text" class="form-control" id="Description" placeholder="Add new Description..." name="Description">
    </div>
    <div class="mb-3">
        <label for="Stars" class="form-label">Stars</label>
        <input type="text" class="form-control" id="Stars" placeholder="Add new Stars..." name="Stars">
    </div>
    <div class="mb-3">
        <label for="Price" class="form-label">Price</label>
        <input type="text" class="form-control" id="Price" placeholder="Add new Price..." name="Price">
    </div>
    <button type="submit" class="btn btn-sm btn-success" name="addhotem">Add</button>
    <button type="submit" class="btn btn-sm btn-warning" name="delhotem">Delete</button>
</form>
<?
if (isset($_POST["addhotem"])) {
    $CityId = $_POST["CityId"];
    $HotelName = $_POST["HotelName"];
    $Description = $_POST["Description"];
    $Stars = $_POST["Stars"];
    $Price = $_POST["Price"];
    $q6 = "INSERT Hotels(HotelName,Description,Stars,Price, CityId) VALUES('" . $HotelName . "', '" . $Description . "', '" . $Stars . "', '" . $Price . "', '" . $CityId . "')";
    $res = mysqli_query($link, $q6);
    $err = mysqli_errno($link);
    if ($err)
        $_SESSION["hoteladderr"] = "Error when adding hotel!";
    else {
        unset($_SESSION["hoteladderr"]);
        echo "<script>
                location = document.URL;
                </script>";
    }
    mysqli_free_result($res);
}
if (isset($_POST["delhotem"])) {
    if (isset($_POST["delhotels"])) {
        $delhotels = $_POST["delhotels"];
        $hotel2 = count($delhotels);
        // var_dump($delcountries);
        foreach ($delhotels as $hotelId) {
            $q7 = "DELETE FROM Hotels WHERE id=$hotelId";
            mysqli_query($link, $q7);
        }
        echo "<script>
                alert('" . $hotel2 . " countries was deleted!');
                location = document.URL;
                </script>";
    }
}
?>