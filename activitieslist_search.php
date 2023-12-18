<?php
    session_start();
    include("include/config.php");
?>

<!DOCTYPE HTML>
<html lang="en">

<html>

<head>
    <title>Activities List | MyStudyKPI </title>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Jost">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="sitejavascript.js"></script>
    <script type="text/javascript">
        function createPath(target) {
            let scriptPath = "action_scripts/activitieslist_remove_action.php?id=";
            let overallPath = scriptPath.concat(target);
            return overallPath;
        }
        function confirmRemoval(target_id) {
            var promptConfirm = confirm("Are you sure you want to remove this record?");

            if (promptConfirm) {
                // if OK is clicked, redirect to challenge_remove_action with the target id
                var path = createPath(target_id);
                window.location.href = path;
            }
            // do nothing otherwise
        }
    </script>
    <style>
        #activitiesTable-container {
            padding-left: 5%;
            padding-right: 5%;
            width: 100%;
            box-sizing: border-box;
            min-height: 100vh;
        }
        #activitiesTable {
            border: 1px solid black;
            width: 100%;
        }
        #activitiesTable th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #EAE1A8;
            color: #000000;
        }
        #activitiesTable tr {
            transition: background-color 0.1s, color 0.1s;
        }
        #activitiesTable tr:nth-child(odd) {
            background-color: #DDDDDD;
        }
        #activitiesTable tr:hover {
            background-color: #C8B4BA;
            font-weight: bold;
        }
        #activitiesTable #edit, #remove, #image, #close {
            text-decoration: none;
            color: black;
            transition: color 0.08s;
        }
        #activitiesTable #edit:hover {
            cursor: pointer;
            color: #3BB143;
        }
        #activitiesTable #remove:hover {
            cursor: pointer;
            color: #FF0000;
        }
        #activitiesTable #image:hover {
            cursor: pointer;
            color: #1E90FF;
        }
        #searchBar {
            text-align: right;
            font-family: Jost, monospace;
            padding-left: 2%;
            padding-right: 2%
        }
        @media screen and (max-width: 600px) {
            .tab button {
                width: 25%;
            }
            #activitiesTable-container {
                padding-left: 2%;
                padding-right: 2%;
                overflow-x: auto;
            }
        }
    </style>
</head>

<body>
    <header>
        <img class="header" src="images/activitieslistheader.png">
    </header>
    <nav class="topnav" id="myTopnav">
        <a href="index.php" class="logo"><img src="images/mystudykpi-topnavbtn-2-white.png"></a>
        <a href="aboutme.php" class="tabs">About Me</a>
        <a href="kpimodule.php" class="tabs">MyKPI Indicator Module</a>
        <a href="activitieslist.php" class="active">Activities List</a>
        <a href="challenges.php" class="tabs">Challenges and Future Plans</a>
        <a href="logout.php" class="tabs">Logout</a>
        <a href="javascript:void(0);" class="icon" onClick="adjustTopnav()"><i class="fa fa-bars"></i></a>
    </nav>
    <main>
        <?php
            // save the search string into a variable
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $search = $_POST["search"];
            }
        ?>
        <br>
        <form id="searchBar" action="activitieslist_search.php" method="POST">
                <input type="text" placeholder="Search..." name="search" style="width: 30%;">
                <input type="submit" value="Search">
        </form>
        <p style="padding-left: 2%; padding-right: 2%">Showing all search results for: "<?=$search;?>" <a id="close" title="Close" href="activitieslist.php"><i class="fa fa-times"></i></a></p>
        <div id="activitiesTable-container">
            <table id="activitiesTable">
                <?php
                    if ($search != "") {
                        // split the search string into individual words
                        $keywords = explode(" ", $search);

                        // prepare the SQL query with multiple LIKE conditions
                        $searchQuery = "SELECT * FROM activity WHERE (";
                        
                        // build the conditions dynamically for single keyword
                        $conditions = [];
                        foreach ($keywords as $index => $keyword) {
                            $conditions[] = "activityDetails LIKE '%$keyword%'";
                        }

                        // combine
                        $searchQuery .= implode(" OR ", $conditions);

                        // select only with this accountID
                        $searchQuery .= " OR activityDetails LIKE '%$search%') AND accountID=".$_SESSION["UID"];

                        $result = mysqli_query($conn, $searchQuery);

                        if (mysqli_num_rows($result) > 0) {
                            echo "
                                <tr>
                                    <th>No.</th>
                                    <th>Session</th>
                                    <th>Type</th>
                                    <th>Level</th>
                                    <th>Details</th>
                                    <th>Remarks</th>
                                    <th>Image</th>
                                    <th>&nbsp;</th>
                                </tr>
                            ";

                            $rowIndex = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $editID = $removeID = $imageID = $row["activityID"];

                                // this block is to determine the output for activityType
                                $typeOutput = '';
                                switch($row["activityType"]) {
                                    case "1": $typeOutput = "Activities"; break;
                                    case "2": $typeOutput = "Clubs"; break;
                                    case "3": $typeOutput = "Associations"; break;
                                    case "4": $typeOutput = "Competitions"; break;
                                    default: $typeOutput = "";
                                }

                                // this block is to determine the output for activityLevel
                                $levelOutput = '';
                                switch($row["activityLevel"]) {
                                    case "1": $levelOutput = "Faculty"; break;
                                    case "2": $levelOutput = "University"; break;
                                    case "3": $levelOutput = "National"; break;
                                    case "4": $levelOutput = "International"; break;
                                    default: $levelOutput = "";
                                }

                                echo "
                                    <tr>
                                        <td>".$rowIndex."</td>
                                        <td>Sem ".$row["activitySem"]." Year ".$row["activityYear"]."</td>
                                        <td>".$typeOutput."</td>
                                        <td>".$levelOutput."</td>
                                        <td>".$row["activityDetails"]."</td>
                                        <td>".$row["activityRemarks"]."</td>
                                ";

                                if ($row["activityImagePath"] != '') {
                                    echo "
                                        <td style='text-align: center'>
                                            <a id='image' title='Open image' href='show_activity_image.php?id=".$imageID."' target='blank'><i class='fa fa-image'></i></a>
                                        </td>
                                    ";
                                }
                                else {
                                    echo "<td>&nbsp;</td>";
                                }

                                echo "
                                    <td style='text-align: center'>
                                        <a id='edit' title='Edit activity' href='activitieslist_edit.php?id=".$editID."'><i class='fa fa-pencil-square-o'></i></a>
                                        <a id='remove' title='Remove activity' onclick='confirmRemoval($removeID)'><i class='fa fa-trash-o'></i></a>
                                    </td>
                                </tr>
                                ";
                            }
                        }
                    }
                ?>
            </table>
            <br>
        </div>
    </main>
    <footer>
            <h5>© Chiew Cheng Yi | BI21110236 | KK34703 Individual Project</h5>
    </footer>
</body>

</html>