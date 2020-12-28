<?php

require_once 'class/Utility.php';
require_once 'class/Dbh.php';
require_once 'class/Vehicle.php';
/**
 *
 * Contains managing data query functions
 * - add vehicle
 * - delete vehicle
 * - update vehicle
 * - select vehicle by id
 * - select all vehicle
 * - advanced search
 *
 * Remember list
 * - ALWAYS RETURN $stmt
 */
class CarDAO extends Utility
{

    // mostly used for select queries, mapping results to a class
    function query($sql)
    {
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $car = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $car[] = new Vehicle(
                $row["vehicleId"],
                $row["make"],
                $row["yearMade"],
                $row["model"],
                $row["price"],
                $row["mileage"],
                $row["transmission"],
                $row["drivetrain"],
                $row["exterior"],
                $row["interior"],
                $row["engineCapacity"],
                $row["safety"],
                $row["category"],
                $row["cylinder"],
                $row["fuel"],
                $row["doors"],
                $row["status"],
                $row["dateAdded"]
            );
        }
        $stmt = null;
        return $car;
    }

    function getAllCars()
    {
        $sql = "SELECT\n"
            . " *\n"
            . "FROM\n"
            . " `vehicle`;";
        return $this->query($sql);
    }

    /**
     * Mainly used for pagination.
     * Does not return a car object.
     * usage:
     *  while($row['colName'] = fetch()) {}
     * @param $rowStart
     * @param $numRecordsPerPage
     * @return PDOStatement
     */
    function getCarsLimitByRecPerPage($rowStart, $numRecordsPerPage) {
        $sql = "SELECT\n"
            . " `vehicleId`,\n"
            . " `make`,\n"
            . " `yearMade`,\n"
            . " `model`,\n"
            . " `price`,\n"
            . " `mileage`,\n"
            . " `transmission`,\n"
            . " `drivetrain`,\n"
            . " `exterior`,\n"
            . " `interior`,\n"
            . " `engineCapacity`,\n"
             . " `safety`,\n"
            . " `category`,\n"
            . " `cylinder`,\n"
            . " `fuel`,\n"
            . " `doors`,\n"
            . " `status`,\n"
            . " `dateAdded`,\n"
            .  " CONCAT(`yearMade`,\n"
            . " ' ',\n"
            . " `make`,\n"
            . " ' ',\n"
            . " `model`) AS `vehicleTitle`\n"
            . "FROM\n"
            . " `vehicle`\n"
            . "LIMIT $rowStart, $numRecordsPerPage";
        //echo $sql;
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    /**
     * ALPHA
     * get vehicle with images all at one query
     * instead of two (no need to use DiagramDAO)
     * returns unique vehicle id since
     * vehicle can have more than one image
     * Problem diagramId and diagram is
     * not map since query() only returns
	 * a car object.
     *
     * Suggestion
     * You can add diagramId, and diagram
     * properties in vehicle entity.
     */
    function getVehiclesWithPhotos() {
        $sql = "SELECT\n"
            . " vehicle.vehicleId, vehicle.make, vehicle.yearMade,\n"
            . " vehicle.model, vehicle.price, vehicle.mileage,\n"
            . " vehicle.transmission, vehicle.drivetrain,vehicle.exterior,vehicle.interior,\n"
            . " vehicle.engineCapacity, vehicle.safety, vehicle.category, vehicle.cylinder, vehicle.fuel, \n"
            . " vehicle.doors, vehicle.status, vehicle.dateAdded,\n"
            . " cardiagram.diagramId, cardiagram.diagram\n"
            . "FROM\n"
            . " cardiagram\n"
            . "RIGHT JOIN\n"
            . " vehicle ON cardiagram.vehicleId = vehicle.vehicleId\n"
            . "GROUP BY\n"
            . " vehicle.vehicleId;";
        return $this->query($sql);
    }

    function getCarById($id) {
        $sql = "SELECT * FROM `vehicle` WHERE `vehicleId` = $id";
        return $this->query($sql);
    }

    function create(&$valueObject) {
        $sql =    '   INSERT  '.
            '   INTO  '.
            '     `vehicle`(  '.
            '       `vehicleId`,  '.
            '       `make`,  '.
            '       `yearMade`,  '.
            '       `model`,  '.
            '       `price`,  '.
            '       `mileage`,  '.
            '       `transmission`,  '.
            '       `drivetrain`,  '.
           '       `exterior`,  '.
            '       `interior`,  '.
            '       `engineCapacity`,  '.
            '       `safety`,  '.
            '       `category`,  '.
            '       `cylinder`,  '.
            '       `fuel`,  '.
            '       `doors`,  '.
            '       `status`,  '.
            '       `dateAdded`  '.
            '     )  '.
            '   VALUES(  '.
            '     '.$valueObject->getVehicleId().',  '.
            '     '.$valueObject->getMake().',  '.
            '     '.$valueObject->getYearMade().',  '.
            '     '.$valueObject->getModel().',  '.
            '     '.$valueObject->getPrice().',  '.
            '     '.$valueObject->getMileage().',  '.
            '     '.$valueObject->getTransmission().',  '.
            '     '.$valueObject->getDrivetrain().',  '.
            '     '.$valueObject->getExterior().',  '.
            '     '.$valueObject->getInterior().',  '.
            '     '.$valueObject->getEngineCapacity().',  '.
            '     '.$valueObject->getSafety().',  '.
            '     '.$valueObject->getCategory().',  '.
            '     '.$valueObject->getCylinder().',  '.
            '     '.$valueObject->getFuel().',  '.
            '     '.$valueObject->getDoors().',  '.
            '     '.$valueObject->getStatus().',  '.
            '     '.$valueObject->getDateAdded().'  '.
            '  );  ';
        // echo $sql;
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isCreated($postArray) {
        $lastCarId = $this->getLastCarId();
        // a varchar type must be quoted in a string so we can insert it
        $car = new Vehicle(
            $this->incrementId($lastCarId),
            $this->stringValue($postArray["make"]),
            $postArray["year"],
            $this->stringValue($postArray["model"]),
            $this->formatNumber($postArray["price"]),
            $this->formatNumber($postArray["mileage"]),
            $this->stringValue($postArray["transmission"]),
            $this->stringValue($postArray["drivetrain"]),
            $this->stringValue($postArray["exterior"]),
            $this->stringValue($postArray["interior"]),
            $this->stringValue($postArray["capacity"]),
            $this->stringValue($postArray["safety"]),
            $this->stringValue($postArray["category"]),
            $postArray["cylinder"],
             $this->stringValue($postArray["fuel"]),
            $postArray["doors"],
            $this->stringValue($postArray["status"]),
            $this->stringValue($this->getTimeStamp())
        );
        if($this->create($car)) {
            return 1;
        } else {
            return 0;
        }
    }

    // one car can have many photos
    function addDiagram($files, $id) {
        if(!empty($files)) {
            $sql = null;

            for($i = 0; $i < count($files); $i++) {
                $imageData = $files[$i];
                $sql .= "INSERT INTO `cardiagram`(`diagram`, `vehicleId`) VALUES ('{$imageData}',{$id});";
            }

            $db = Dbh::getInstance();
            $stmt = $db->prepare($sql);
            $stmt->execute();
            return $stmt;
        } else {
            return null;
        }
    }

    // precondition: this vehicle already exists
    function isDiagramAdded($files, $id)
    {
        if ($this->addDiagram($files, $id)) {
            return 1;
        } else {
            return 0;
        }
    }

    function update(&$carObject) {
        // some of them needs to be a varchar (string)
        $sql =  '   UPDATE  '.
            '     `vehicle`  '.
            '   SET  '.
            '     `make` = '.$this->stringValue($carObject->getMake()).',  '.
            '     `yearMade` = '.$carObject->getYearMade().',  '.
            '     `model` = '.$this->stringValue($carObject->getModel()).',  '.
            '     `price` = '.$carObject->getPrice().',  '.
            '     `mileage` = '.$carObject->getMileage().',  '.
            '     `transmission` = '.$this->stringValue($carObject->getTransmission()).',  '.
            '     `drivetrain` = '.$this->stringValue($carObject->getDrivetrain()).',  '.
            '     `exterior` = '.$this->stringValue($carObject->getExterior()).',  '.
            '     `interior` = '.$this->stringValue($carObject->getInterior()).',  '.
            '     `engineCapacity` = '.$this->stringValue($carObject->getEngineCapacity()).',  '.
            '     `safety` = '.$this->stringValue($carObject->getSafety()).',  '.
            '     `category` = '.$this->stringValue($carObject->getCategory()).',  '.
            '     `cylinder` = '.$carObject->getCylinder().',  '.
            '     `fuel` = '.$this->stringValue($carObject->getFuel()).',  '.
            '     `doors` = '.$carObject->getDoors().',  '.
            '     `status` = '.$this->stringValue($carObject->getStatus()).',  '.
            '     `dateAdded` = '.$this->stringValue($carObject->getDateAdded()).'  '.

            '   WHERE  '.
            '    `vehicleId` =  ' . $carObject->getVehicleId();
        // echo $sql;
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isUpdated($postArray) {
        $id = $postArray['update-vehicle-id'];
        if($this->isVehicleExist($id)) {
            $updateThisCar_obj = new Vehicle(
                $id, // syntax: $postArray['nameAttribute']
                $postArray["update-make"],
                $postArray["year"],
                $postArray["update-model"],
                $this->formatNumber($postArray["price"]),
                $this->formatNumber($postArray["mileage"]),
                $postArray["transmission"],
                $postArray["drivetrain"],
                $postArray["exterior"],
                $postArray["interior"],
                $postArray["capacity"],
                $postArray["safety"],
                $postArray["category"],
                $postArray["cylinder"],
                $postArray["fuel"],
                $postArray["doors"],
                $postArray["status"],
                $this->getTimeStamp()
            );
            if($this->update($updateThisCar_obj)) {
                return 1;
            }
        } else {
            return 0;
        }
        return 0;
    }

    function delete($id) {
        /**
         * Added ON DELETE CASCADE
         * since vehicleId is a
         * foreign key in cardiagram
         * table. The photos of this
         * vehicle being deleted
         * will also be deleted in
         * cardiagram table.
         */
        $sql = "DELETE FROM `vehicle` WHERE `vehicleId` = $id";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    function isDeleted($id) {
        if ($this->delete($id)) {
            return 1;
        } else {
            return 0;
        }
    }

    function countAllCars() {
        return count($this->getAllCars());
    }

    function getLastCarId() {
        $sql = "SELECT vehicleId FROM `vehicle` ORDER BY vehicleid DESC LIMIT 1";
        $db = Dbh::getInstance();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn(0);
    }

    // for registration if username is taken {boolean}
    function isVehicleExist($id) {
        if (($this->getCarById($id))) {
            return 1;
        } else {
            return 0;
        }
    }
}
