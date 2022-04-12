<?php
require("../../connection.php");

$val = $_POST["val"];
$drop = $_POST["drop"];
$html = "";

if (isset($_POST["val"]) && !empty($_POST["val"])) {

    if ($drop != "NULL" && $drop != NULL && isset($_POST["drop"]) && isset($_POST["val"]) && !empty($_POST["val"])) {

        $sql = "SELECT `Name`,`ID`,`Image`,`Description`,`Price`,`Model` FROM `products` WHERE (`Name` LIKE '%" . $val . "%' OR  `Description` LIKE '%" . $val . "%' OR  `Model` LIKE '%" . $val . "%') AND `Category_ID` = $drop";
        $check = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_array($check)) {
            $html .= '<div class="col-12 border-bottom learts-pb-40 learts-mb-40">
            <div class="blog">
                <div class="row learts-mb-n30">
                    <div class="col-xl-2 col-md-5 col-5 learts-mb-30">
                        <div class="image mb-0">
                            <a  href="detail.php?Product=' . $row["ID"] . '"><img class="img-fluid" style="width: unset;height: 194px;" src="admin/uploads/Products/' . $row["Image"] . '" alt="' . $row["Name"] . '"></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-7 col-7 align-self-center learts-mb-30">
                        <div class="content">
                        <ul class="meta mb-3">
                                <li><i class="far fa-list-ol"></i><a href="detail.php?Product=' . $row["ID"] . '">' . highlightKeywords($row["Model"], $val) . '</a></li>                        </ul>
                            </ul>
                            <h5 class="title"><a style="font-family: Futura", Arial, Helvetica, sans-serif;"  href="detail.php?Product=' . $row["ID"] . '"> ' . highlightKeywords($row["Name"], $val) . '</a></h5>
                            <div class="desc">
                                <p>' .  highlightKeywords(substr($row["Description"], 0, 200), $val) . '........</p>
                            </div>
                           <p class="p-0 m-0">Rs. <b class="text-danger">' . number_format($row["Price"], 2) . '</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
    } else {
        $sql = "SELECT `Name`,`ID`,`Image`,`Description`,`Price`,`Model` FROM `products` WHERE `Name` LIKE '%" . $val . "%' OR  `Description` LIKE '%" . $val . "%' OR  `Model` LIKE '%" . $val . "%'";
        $check = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_array($check)) {

            $html .= '<div class="col-12 border-bottom learts-pb-40 learts-mb-40">
            <div class="blog">
                <div class="row learts-mb-n30">
                    <div class="col-xl-2 col-md-5 col-5 learts-mb-30">
                        <div class="image mb-0">
                            <a  href="detail.php?Product=' . $row["ID"] . '"><img class="img-fluid" style="width: unset;height: 194px;" src="admin/uploads/Products/' . $row["Image"] . '" alt="' . $row["Name"] . '"></a>
                        </div>
                    </div>
                    <div class="col-xl-8 col-md-7 col-7 align-self-center learts-mb-30">
                        <div class="content">
                        <ul class="meta mb-3">
                                <li><i class="far fa-list-ol"></i><a href="detail.php?Product=' . $row["ID"] . '">' . highlightKeywords($row["Model"], $val) . '</a></li>                        </ul>
                            </ul>
                            <h5 class="title"><a style="font-family: Futura", Arial, Helvetica, sans-serif;"  href="detail.php?Product=' . $row["ID"] . '"> ' . highlightKeywords($row["Name"], $val) . '</a></h5>
                            <div class="desc">
                                <p>' .  highlightKeywords(substr($row["Description"], 0, 200), $val) . '........</p>
                            </div>
                           <p class="p-0 m-0">Rs. <b class="text-danger">' . number_format($row["Price"], 2) . '</b></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
        }
    }
}


function highlightKeywords($text, $keyword)
{
    $wordsAry = explode(" ", $keyword);
    $wordsCount = count($wordsAry);

    for ($i = 0; $i < $wordsCount; $i++) {
        $highlighted_text = "<span style='background-color: rgb(255, 255, 0 ,0.5);font-weight:bolder;'>$wordsAry[$i]</span>";
        $text = str_ireplace($wordsAry[$i], $highlighted_text, $text);
    }

    return $text;
}
if (!empty($html)) {
    echo json_encode(["status" => "success", "html" => $html]);
} else {
    $html = "";
    echo json_encode(["status" => "success", "html" => $html]);
}
