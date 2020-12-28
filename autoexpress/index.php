<?php
require_once 'admin/server/CarDAO.php';
require_once 'admin/server/DiagramDAO.php';
require_once 'admin/server/AdvanceSearchDAO.php';
require_once 'admin/server/class/Paging.php';

$v = new CarDAO();
$d = new DiagramDAO();
$s = new AdvanceSearchDAO();
$numberOfCars = $v->countAllCars();

$p = new Paging();
define('RECORDS_PER_PAGE', 5);
$p->setRecordsPerPage(RECORDS_PER_PAGE);
$p->setPageQueryStr('page');
$p->setStartingRow($p->getPageRowNumber());

$rowCarField = $v->getCarsLimitByRecPerPage($p->getStartingRow(), $p->getRecordsPerPage());
$carObjSearchResult = $s->getSearchInputResult('search-car');
//print_r($carObjSearchResult);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>AutoExpress</title>

    <link rel="apple-touch-icon" sizes="180x180" href="image/favicon_package_v0.16/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="image/favicon_package_v0.16/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="image/favicon_package_v0.16/favicon-16x16.png">
    <link rel="manifest" href="image/favicon_package_v0.16/site.webmanifest">
    <link rel="mask-icon" href="image/favicon_package_v0.16/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <link href="css/style.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet" >
</head>
<body>
<div class="container_custom">
    <?php include 'template/header.php'; ?>
    <?php include 'template/advance-search.php'; ?>
    <?php include 'template/compare.php'; ?>
    <div class="content">
               <div class="content-car-section">
            <?php $hideIndexResult = empty($carObjSearchResult) ? "visible" : "hidden"; ?>
            <table id="inventory-vehicle-table"  class="<?php echo $hideIndexResult; ?>" >
                <thead><tr><th></th></tr></thead>
                <tbody>
                <?php  while($row = $rowCarField->fetch())  { ?>
                    <tr>
                        <td>
                            <div class="divTable" id="car-item-<?php  ?>">
                                <div class="divTableBody">
                                    <div class="divTableRow">
                                        <div class="divTableCell">
                                            <div class="row car-images" >
                                                <?php
                                                // first if stmt: use 'place hold' it as image if this car has no images
                                                // second if stmt: no badge for car that has no images
                                                $currSearchCarImg = $d->getPhotosBy_CarId($row['vehicleId']);
                                                $isMoreThanOneImg = 0;
                                                if($d->countAllPhotosByCarId($row['vehicleId']) == "0") {
                                                    $h = "https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111";
                                                } else {
                                                    $h = $currSearchCarImg[0]->getDiagram();
                                                    $isMoreThanOneImg = 1;
                                                }
                                                ?>
                                                <img style="width: 240px; height: 150px" src="<?php  echo $h; ?>">
                                                <?php if(!empty($d->countAllPhotosByCarId($row['vehicleId']))) { ?>
                                                <span class="badge">
                                                    <?php echo $d->countAllPhotosByCarId($row['vehicleId']); ?>
                                                </span>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="divTableCell">
                                            <div class="feature_links">
                                                <a href="#" class="calculate-payment-link" data-toggle="modal"
                                                   data-target="#calculatePaymentModal" data-price="<?php echo $row['price']; ?>" >
                                                    <p><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Estimate EMI</p>
                                                </a>
                                                <!--<a href="#" title="Refer this car" data-toggle="modal" data-target="#referACarModal">
                                                    <p><i class="fa fa-share" aria-hidden="true"></i>&nbsp;Vehicle Referral</p>
                                                </a>-->
                                                <a href="<?php echo 'details.php?carId='.$row['vehicleId']; ?>" title="View more details">
                                                    <p><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;More Details</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="divTableCell">
                                            <div class="car_info">
                                                <p>
                                                    <span class="car-title"><?php echo $row['vehicleTitle']; ?> - </span>
                                                    <span class="price-style">Rs.<?php echo $row['price']; ?></span>
                                                </p>
                                                <p><span class="availability"><?php echo $row['status']; ?></span></p>
                                                <p>
                                                    <span class="mileage"><?php echo $row['mileage']; ?> km</span>&nbsp;|&nbsp;
                                                    <span class="transmission"><?php echo $row['transmission']; ?></span>&nbsp;|&nbsp;
                                                    <span class="drivetrain"><?php echo $row['drivetrain']; ?></span>
                                                </p>
                                            </div>
                                        </div>

                                        <!--added -->
                                        <div class="divTableCell">
                                            <div class="car_info">
                                            </div>
                                        </div>

                                        <div class="divTableCell">
                                            <div class="car_info">
                                                    <a onclick="parent.choose('<?php echo $row['vehicleTitle'] ?>','<?php echo $row['vehicleId'] ?>' )" target=_blank >
                                                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add to Compare
                                                    </a><br><br>
                                                    <a href="fav.php?carid='<?php echo $row['vehicleId']?>'"><i class="fa fa-star" aria-hidden="true"></i>&nbsp;Favourite this car</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php   } ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example" class="<?php echo $hideIndexResult; ?>">
                <ul class="pagination">
                    <?php if($numberOfCars > $p->getRecordsPerPage()) { ?>
                        <?php if($p->getPrev() >= 0) { ?>
                            <li class="page-item"><a href="index.php?page=<?php echo $p->getPrev(); ?>">Previous</a></li>
                        <?php } ?>
                        <?php $pageNumber = 1; ?>
                        <?php for($i = 0; $i < $numberOfCars; $i = $i + $p->getRecordsPerPage()) { ?>
                            <?php if($i != $p->getStartingRow()) { ?>
                                <li class="page-item"><a href="index.php?page=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                            <?php } else { ?>
                                <li class="page-item active"><a href="index.php?page=<?php echo $i; ?>"><?php echo $pageNumber; ?></a></li>
                            <?php } ?>
                            <?php $pageNumber = $pageNumber + 1; ?>
                        <?php } ?>
                        <?php if($p->getNext() < $numberOfCars) { ?>
                            <li class="page-item"><a href="index.php?page=<?php echo $p->getNext(); ?>">Next</a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </nav>

            <?php if(!empty($carObjSearchResult)) { ?>
            <table id="search-result-vehicle-table">
                <thead>
                <tr>
                    <th>
                        <?php echo $s->getResultFoundMessage(); ?>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php  while($rowSearchResult = $carObjSearchResult->fetch())  { ?>
                    <tr>
                        <td>
                            <div class="divTable" id="car-item-<?php  ?>">
                                <div class="divTableBody">
                                    <div class="divTableRow">
                                        <div class="divTableCell">
                                            <div class="row car-images" >
                                                <?php
                                                // first if stmt: use 'place hold' it as image if this car has no images
                                                // second if stmt: no badge for car that has no images
                                                $currSearchCarImg = $d->getPhotosBy_CarId($rowSearchResult['vehicleId']);
                                                if($d->countAllPhotosByCarId($rowSearchResult['vehicleId']) == "0") {
                                                    //$h = "https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111";
                                                    $h = "https://placeholdit.co//i/272x150?text=Photo Unavailable&bg=111111";
                                                } else {
                                                    $h = $currSearchCarImg[0]->getDiagram();
                                                }
                                                ?>
                                                <img style="width: 240px; height: 150px" src="<?php  echo $h; ?>">
                                                <span class="badge">
                                                    <?php
                                                    if(!empty($d->countAllPhotosByCarId($rowSearchResult['vehicleId']))) {
                                                        echo $d->countAllPhotosByCarId($rowSearchResult['vehicleId']);
                                                    }
                                                    ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="divTableCell">
                                            <div class="feature_links">
                                                <a href="#" class="calculate-payment-link" data-toggle="modal"
                                                   data-target="#calculatePaymentModal" data-price="<?php echo $rowSearchResult['price']; ?>" >
                                                    <p><i class="fa fa-calculator" aria-hidden="true"></i>&nbsp;Estimate payment</p>
                                                </a>
                                                <a href="#" title="Refer this car" data-toggle="modal" data-target="#referACarModal">
                                                    <p><i class="fa fa-share" aria-hidden="true"></i>&nbsp;Vehicle Referral</p>
                                                </a>
                                                <a href="<?php echo 'details.php?carId='.$rowSearchResult['vehicleId']; ?>" title="View more details">
                                                    <p><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;More Details</p>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="divTableCell">
                                            <div class="car_info">
                                                <p>
                                                    <span class="car-title"><?php echo $rowSearchResult['vehicleTitle'] ?> - </span>
                                                    <span class="price-style">Rs. <?php echo $rowSearchResult['price']; ?></span>
                                                </p>
                                                <p><span class="availability"><?php echo $rowSearchResult['status']; ?></span></p>
                                                <p>
                                                    <span class="mileage"><?php echo $rowSearchResult['mileage']; ?> km</span>&nbsp;|&nbsp;
                                                    <span class="transmission"><?php echo $rowSearchResult['transmission']; ?></span>&nbsp;|&nbsp;
                                                    <span class="drivetrain"><?php echo $rowSearchResult['drivetrain']; ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="divTableCell">
                                            <div class="car_info">
                                            </div>
                                        </div>

                                        <div class="divTableCell">
                                            <div class="car_info">
                                                    <a onclick="parent.choose('<?php echo $rowSearchResult['vehicleTitle'] ?>','<?php echo $rowSearchResult['vehicleId'] ?>' )" target=_blank >
                                                    <i class="fa fa-plus" aria-hidden="true"></i>&nbsp;Add to Compare
                                                    </a><br><br>
                                                    <a href="fav.php?carid='<?php echo $rowSearchResult['vehicleId']?>'"><i class="fa fa-star" aria-hidden="true"></i>&nbsp;Favourite this car</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php   } // end while ?>
                </tbody>
            </table>
            <?php } // end if ?>
        </div>

        <?php include 'template/payment-modal.php'; ?>
        <?php include 'template/referral-modal.php'; ?>
    </div>
    <?php include 'template/footer.php'; ?>
    <div class="compare">

            <button id="hid" class="btn hide">Pending</button>

        </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/features.js"></script>
<script>
    $(document).ready(function () {
       PaymentCalculator.init();
       VehicleReferral.init();
       var searchResultVehicleTableExists = document.getElementById("search-result-vehicle-table");
       if(document.body.contains(searchResultVehicleTableExists)) {
        $('#search-result-vehicle-table').DataTable({
            "pageLength": 1,
            "lengthChange": false,
            searching: false,
            "ordering": false
        });
       }
    });
    function selectCarMakeFn(selectedMake) {
        var modelsSelect = $(selectedMake).parent().next().find('#searchModel');
        modelsSelect.empty();
        var selectVal = $(selectedMake).val();
        modelsSelect.append('<option selected value="%">Select model</option>');
        $.ajax({
            type: "GET",
            url: "admin/js/data/models.json",
            dataType: "json",
            success: function (json) {
                for (var key in json) {
                    if (json.hasOwnProperty(key)) {
                        if(selectVal === json[key].title) {
                            var modelsObj = json[key].models;
                            Object.keys(modelsObj).forEach(function(key) {
                                var h = '<option value="'+modelsObj[key].value+'" title="'+modelsObj[key].title+'">'+modelsObj[key].value+'</option>';
                                modelsSelect.append(h);
                            });
                            break;
                        }
                    }
                }
            }
        });
    }
</script>


</body>
</html>
