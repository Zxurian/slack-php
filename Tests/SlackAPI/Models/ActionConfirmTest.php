<?php

namespace Tests\SlackAPI\Models;

use SlackPHP\SlackAPI\Models\ActionConfirm;
use PHPUnit\Framework\TestCase;
use SlackPHP\SlackAPI\Exceptions\SlackException;

/**
 * @author Dzianis Zhaunerchyk <dzhaunerchyk@gmail.com>
 * @covers ActionConfirm
 */
class ActionConfirmTest extends TestCase
{
    private $dummyString = 'string';
    
    /**
     * Testing setting valid title 
     */
    public function testSettingTitle()
    {
        $actionConfirmObject = new ActionConfirm();
        $returnedObject = $actionConfirmObject->setTitle($this->dummyString);
        $refActionConfirmObject = new \ReflectionObject($actionConfirmObject);
        $titleProperty = $refActionConfirmObject->getProperty('title');
        $titleProperty->setAccessible(true);
        
        $this->assertInstanceOf(ActionConfirm::class, $returnedObject);
        $this->assertEquals($this->dummyString, $titleProperty->getValue($actionConfirmObject));
    }
    
    /**
     * Testing setting invalid title
     */
    public function testSettingInvalidTitle()
    {
        $this->expectException(\InvalidArgumentException::class);
        $actionConfirm = new ActionConfirm();
        $actionConfirm->setTitle(new \stdClass());
    }
    
    /**
     * Testing getting title
     */
    public function testGetTitle()
    {
        $actionConfirmObject = new ActionConfirm();
        $refActionConfirmObject = new \ReflectionObject($actionConfirmObject);
        $titleProperty = $refActionConfirmObject->getProperty('title');
        $titleProperty->setAccessible(true);
        $titleProperty->setValue($actionConfirmObject, $this->dummyString);
        
        $this->assertEquals($this->dummyString, $actionConfirmObject->getTitle());
    }
    
    /**
     * Testing setting valid text
     */
    public function testSettingText()
    {
        $actionConfirmObject = new ActionConfirm();
        $returnedObject = $actionConfirmObject->setText($this->dummyString);
        $refActionConfirmObject = new \ReflectionObject($actionConfirmObject);
        $textProperty = $refActionConfirmObject->getProperty('text');
        $textProperty->setAccessible(true);
        
        $this->assertInstanceOf(ActionConfirm::class, $returnedObject);
        $this->assertEquals($this->dummyString, $textProperty->getValue($actionConfirmObject));
    }
    
    /**
     * Testing setting invalid text
     */
    public function testSettingInvalidText()
    {
        $this->expectException(\InvalidArgumentException::class);
        $actionConfirm = new ActionConfirm();
        $actionConfirm->setText(new \stdClass());
    }
    
    /**
     * Testing get text
     */
    public function testGetText()
    {
        $actionConfirmObject = new ActionConfirm();
        $refActionConfirmObject = new \ReflectionObject($actionConfirmObject);
        $textProperty = $refActionConfirmObject->getProperty('text');
        $textProperty->setAccessible(true);
        $textProperty->setValue($actionConfirmObject, $this->dummyString);
        
        $this->assertEquals($this->dummyString, $actionConfirmObject->getText());
    }
    
    /**
     * Testing setting ok text
     */
    public function testSettingOkText()
    {
        $actionConfirmObject = new ActionConfirm();
        $returnedObject = $actionConfirmObject->setOkText($this->dummyString);
        $refActionConfirmObject = new \ReflectionObject($actionConfirmObject);
        $okTextProperty = $refActionConfirmObject->getProperty('okText');
        $okTextProperty->setAccessible(true);
        
        $this->assertInstanceOf(ActionConfirm::class, $returnedObject);
        $this->assertEquals($this->dummyString, $okTextProperty->getValue($actionConfirmObject));
    }
    
    /**
     * Testing setting invalid ok text
     */
    public function testSettingInvalidOkText()
    {
        $this->expectException(\InvalidArgumentException::class);
        $actionConfirm = new ActionConfirm();
        $actionConfirm->setOkText(new \stdClass());
    }
    
    /**
     * Testing get ok text
     */
    public function testGetOkText()
    {
        $actionConfirmObject = new ActionConfirm();
        $refActionConfirmObject = new \ReflectionObject($actionConfirmObject);
        $okTextProperty = $refActionConfirmObject->getProperty('okText');
        $okTextProperty->setAccessible(true);
        $okTextProperty->setValue($actionConfirmObject, $this->dummyString);
        
        $this->assertEquals($this->dummyString, $actionConfirmObject->getOkText());
    }
    
    /**
     * Testing setting dismiss text
     */
    public function testSettingDismissText()
    {
        $actionConfirmObject = new ActionConfirm();
        $returnedObject = $actionConfirmObject->setDismissText($this->dummyString);
        $refActionConfirmObject = new \ReflectionObject($actionConfirmObject);
        $dismissTextProperty = $refActionConfirmObject->getProperty('dismissText');
        $dismissTextProperty->setAccessible(true);
        
        $this->assertInstanceOf(ActionConfirm::class, $returnedObject);
        $this->assertEquals($this->dummyString, $dismissTextProperty->getValue($actionConfirmObject));
    }
    
    /**
     * Testing setting invalid dismiss text
     */
    public function testSettingInvalidDismissText()
    {
        $this->expectException(\InvalidArgumentException::class);
        $actionConfirm = new ActionConfirm();
        $actionConfirm->setDismissText(new \stdClass());
    }
    
    /**
     * Testing get dismiss text
     */
    public function testGetDismissText()
    {
        $actionConfirmObject = new ActionConfirm();
        $refActionConfirmObject = new \ReflectionObject($actionConfirmObject);
        $dismissTextProperty = $refActionConfirmObject->getProperty('dismissText');
        $dismissTextProperty->setAccessible(true);
        $dismissTextProperty->setValue($actionConfirmObject, $this->dummyString);
    
        $this->assertEquals($this->dummyString, $actionConfirmObject->getDismissText());
    }
    
    /**
     * Testing that exception is thrown if required text property is not set
     */
    public function testValidateRequiredText()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::MISSING_REQUIRED_FIELD);
        $actionConfirmObject = new ActionConfirm();
        $actionConfirmObject->validateRequired();
    }
}