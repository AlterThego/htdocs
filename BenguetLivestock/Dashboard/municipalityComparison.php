
                        <!-- <?php include 'municipalityComparison.php'; ?> -->
<div class="row">

    <div id="bokod-row" class="que-content" style="display: none;">
        <div class="card">
            <div class="card-header">
                <div class="card-body">
                    <table class="display table-bordered" id="bokod-table">
                        <h5 class="card-title text-center">Bokod</h5>
                        <?php
                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                        $fetch_query = "SELECT * FROM livestockpopulation;";

                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                        if (mysqli_num_rows($fetch_query_run) > 0) {
                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                if ($row['municipality_id'] == 2604) {
                                    ?>

                                    <tr>
                                        <th>Carabao Count</th>
                                        <td>
                                            <?php echo number_format($row['carabao_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Cattle Count</th>
                                        <td>
                                            <?php echo number_format($row['cattle_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Swine Count</th>
                                        <td>
                                            <?php echo number_format($row['swine_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Goat Count</th>
                                        <td>
                                            <?php echo number_format($row['goat_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Dog Count</th>
                                        <td>
                                            <?php echo number_format($row['dog_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sheep Count</th>
                                        <td>
                                            <?php echo number_format($row['sheep_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Horse Count</th>
                                        <td>
                                            <?php echo number_format($row['horse_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div id="tuba-row" class="que-content" style="display: none;">
        <div class="card">
            <div class="card-header">
                <div class="card-body">
                    <table class="display table-bordered" id="tuba-table">
                        <h5 class="card-title text-center">Tuba</h5>
                        <?php
                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                        $fetch_query = "SELECT * FROM livestockpopulation;";

                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                        if (mysqli_num_rows($fetch_query_run) > 0) {
                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                if ($row['municipality_id'] == 2603) {
                                    ?>
                                    <tr>
                                        <th>Carabao Count</th>
                                        <td>
                                            <?php echo number_format($row['carabao_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Cattle Count</th>
                                        <td>
                                            <?php echo number_format($row['cattle_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Swine Count</th>
                                        <td>
                                            <?php echo number_format($row['swine_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Goat Count</th>
                                        <td>
                                            <?php echo number_format($row['goat_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Dog Count</th>
                                        <td>
                                            <?php echo number_format($row['dog_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sheep Count</th>
                                        <td>
                                            <?php echo number_format($row['sheep_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Horse Count</th>
                                        <td>
                                            <?php echo number_format($row['horse_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div id="itogon-row" style="display: none; ">
        <div class="card">
            <div class="card-header">
                <div class="card-body">
                    <table class="display table-bordered" id="itogon-table">
                        <h5 class="card-title text-center">Itogon</h5>
                        <?php
                        $connection = mysqli_connect("localhost", "root", "", "benguetlivestockdb");

                        $fetch_query = "SELECT * FROM livestockpopulation;";

                        $fetch_query_run = mysqli_query($connection, $fetch_query);

                        if (mysqli_num_rows($fetch_query_run) > 0) {
                            while ($row = mysqli_fetch_array($fetch_query_run)) {
                                if ($row['municipality_id'] == 2604) {
                                    ?>
                                    <tr>
                                        <th>Carabao Count</th>
                                        <td>
                                            <?php echo number_format($row['carabao_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Cattle Count</th>
                                        <td>
                                            <?php echo number_format($row['cattle_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Swine Count</th>
                                        <td>
                                            <?php echo number_format($row['swine_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Goat Count</th>
                                        <td>
                                            <?php echo number_format($row['goat_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Dog Count</th>
                                        <td>
                                            <?php echo number_format($row['dog_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Sheep Count</th>
                                        <td>
                                            <?php echo number_format($row['sheep_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Horse Count</th>
                                        <td>
                                            <?php echo number_format($row['horse_count'], 0, '.', ','); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>