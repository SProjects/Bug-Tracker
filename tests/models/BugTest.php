<?php
include_once "../models/Bug.php";
include_once "../models/User.php";
include_once "../models/Status.php";

class BugTest extends PHPUnit_Framework_TestCase{

    private $bug;

    public function setUp(){
        $this->bug = new Bug("Bug title", "Bug description", new User("username", "password", null, null), new Status(null, "OPEN", 1), null);
    }

    public function tearDown(){
        unset($this->bug);
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

    public function testReturnsCorrectUser(){
        $new_bug =  new Bug("Bug title", "Bug description", new User("username", "password", null, null), new Status(null, "OPEN", 1), null);
        $this->assertEquals(TRUE, $this->bug->getUser()->equals($new_bug->getUser()));
    }

    public function testReturnsIncorrectUser(){
       $new_bug =  new Bug("Bug title", "Bug description", new User("username1", "password1", null, null), new Status(null, "OPEN", 1), null);
       $this->assertNotEquals(TRUE, $this->bug->getUser()->equals($new_bug->getUser()));
    }

    public function testTwoBugsAreEqual(){
        $newBug = new Bug("Bug title", "Bug description", new User("username", "password", null, null), new Status(null, "OPEN", 1), null);
        $this->assertEquals(TRUE, $newBug->equals($this->bug));
    }

    public function testTwoBugsAreNotEqual(){
        $newBug = new Bug("Bug title1", "Bug description1", new User("username1", "password", null, null), new Status(null, "OPEN", 1), null);
        $this->assertNotEquals(TRUE, $newBug->equals($this->bug));
    }
}