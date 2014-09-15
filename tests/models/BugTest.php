<?php
include_once "../models/Bug.php";
include_once "../models/User.php";
include_once "../models/Status.php";

class BugTest extends PHPUnit_Framework_TestCase{

    private $bug;

    public function setUp(){
        $this->bug = new Bug("Bug title", "Bug description", new User("username", "password"), new Status(null, "OPEN", 1));
    }

    public function tearDown(){

    }

    public function testReturnsCorrectTitle(){
        //$this->assertEquals($expected, $actual);
        $this->assertEquals("Bug title", $this->bug->getTitle());
    }

    public function testDetectsIncorrectTitle(){
        $this->assertNotEquals("Bug titl", $this->bug->getTitle());
    }

    public function testReturnsCorrectDescription(){
        $this->assertEquals("Bug description", $this->bug->getDescription());
    }

    public function testDetectsIncorrectDescription(){
        $this->assertNotEquals("Bug descriptions", $this->bug->getDescription());
    }

}