<?
if (isset($_SESSION["cityadderr"]))
    echo "<div class='alert alert-warning'>" . $_SESSION["cityadderr"] . "</div>";
?>
<table class="table table-striped mb-3">
    <thead>
        <tr>
            <th>Id</th>
            <th>City name</th>
            <th>Country</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?
        $q4 = "SELECT Ci.Id, Ci.CIty, Co.Country FROM Cities Ci LEFT JOIN 
                    Countries Co ON Ci.CountryId = Co.Id";
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
                echo "<td><input type='checkbox' class='form-check-input'
                         name='delcities[]' value='" . $row[0] . "' form='cityform'></input></td>";
                echo "</tr>";
            }
        mysqli_free_result($res);
        ?>
    </tbody>
</table>
<form method="post" id="cityform">
    <div class="mb-3">
        <select class="form-select" aria-label="Default select example" name="countryid">
            <option value="0" selected>Choose country</option>
            <?
            $q5 = "SELECT * FROM Countries";
            $res = mysqli_query($link, $q5);
            while ($row = mysqli_fetch_array($res, MYSQLI_NUM)) {
                echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
            }
            ?>
            mysqli_free_result($res);
        </select>
    </div>
    <div class="mb-3">
        <label for="cityname" class="form-label">City name</label>
        <input type="text" class="form-control" id="cityname" placeholder="Add new city..." name="cityname">
    </div>
    <button type="submit" class="btn btn-sm btn-success" name="addcity">Add</button>
    <button type="submit" class="btn btn-sm btn-warning" name="delcity">Delete</button>
</form>
<?
if (isset($_POST["addcity"])) {
    $countryId = $_POST["countryid"];
    $cityname = $_POST["cityname"];
    $q6 = "INSERT Cities(City, CountryId) VALUES('" . $cityname . "', '" . $countryId . "')";
    $res = mysqli_query($link, $q6);
    $err = mysqli_errno($link);
    if ($err)
        $_SESSION["cityadderr"] = "Error when adding city!";
    else {
        unset($_SESSION["cityadderr"]);
        echo "<script>
                location = document.URL;
                </script>";
    }
    mysqli_free_result($res);
}
if (isset($_POST["delcity"])) {
    if (isset($_POST["delcities"])) {
        $delcities = $_POST["delcities"];
        $count2 = count($delcities);
        // var_dump($delcountries);
        foreach ($delcities as $cityId) {
            $q7 = "DELETE FROM Cities WHERE id=$cityId";
            mysqli_query($link, $q7);
        }
        echo "<script>
                alert('" . $count2 . " countries was deleted!');
                location = document.URL;
                </script>";
    }
}
?>