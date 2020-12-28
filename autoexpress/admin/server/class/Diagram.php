<?php

class Diagram implements JsonSerializable
{
    private $_diagramId;
    private $_diagram;
    private $_vehicleId;

    /**
     * Diagram constructor.
     * @param $_diagramId
     * @param $_diagram
     * @param $_vehicleId
     */
    public function __construct($_diagramId, $_diagram, $_vehicleId)
    {
        $this->_diagramId = $_diagramId;
        $this->_diagram = $_diagram;
        $this->_vehicleId = $_vehicleId;
    }

    /**
     * @return mixed
     */
    public function getDiagramId()
    {
        return $this->_diagramId;
    }

    /**
     * @param mixed $diagramId
     */
    public function setDiagramId($diagramId)
    {
        $this->_diagramId = $diagramId;
    }

    /**
     * @return mixed
     */
    public function getDiagram()
    {
        return $this->_diagram;
    }

    /**
     * @param mixed $diagram
     */
    public function setDiagram($diagram)
    {
        $this->_diagram = $diagram;
    }

    /**
     * @return mixed
     */
    public function getVehicleId()
    {
        return $this->_vehicleId;
    }

    /**
     * @param mixed $vehicleId
     */
    public function setVehicleId($vehicleId)
    {
        $this->_vehicleId = $vehicleId;
    }

    function __toString()
    {
        $out = "";
        $out .= 'id ' . $this->_diagramId."\n";
        $out .= 'diagram src ' . $this->_diagram."\n";
        $out .= 'vehicle id ' . $this->_vehicleId."\n";
        return $out;
    }

    // function called when encoded with json_encode
    public function jsonSerialize()
    {
        return get_object_vars($this);
    }


}
