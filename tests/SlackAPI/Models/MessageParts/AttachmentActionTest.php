<?php

namespace SlackPHP\Tests\SlackAPI\Models\MessageParts;

use PHPUnit\Framework\TestCase;
use SlackPHP\SlackAPI\Exceptions\SlackException;
use SlackPHP\SlackAPI\Models\MessageParts\AttachmentAction;
use SlackPHP\SlackAPI\Models\MessageParts\ActionConfirm;
use SlackPHP\SlackAPI\Models\MessageParts\ActionOption;
use SlackPHP\SlackAPI\Models\MessageParts\ActionOptionGroup;
use SlackPHP\SlackAPI\Enumerators\ActionStyle;
use SlackPHP\SlackAPI\Enumerators\ActionType;
use SlackPHP\SlackAPI\Enumerators\ActionDataSource;

/**
 * @author Dzianis Zhaunerchyk <dzhaunerchyk@gmail.com>
 * @author Zxurian
 * @covers AttachmentAction
 */
class AttachmentActionTest extends TestCase
{
    private $dummyString = 'string';
    
    private $dummyInt = 3;
    
    /**
     * Testing setter of name
     */
    public function testSettingName()
    {
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->setName($this->dummyString);
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $nameProperty = $refAttachmentActionObject->getProperty('name');
        $nameProperty->setAccessible(true);
    
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
        $this->assertEquals($this->dummyString, $nameProperty->getValue($attachmentActionObject));
    }
    
    /**
     * Test setting invalid name
     */
    public function testSettingInvalidName()
    {
        $this->expectException(\InvalidArgumentException::class);
        $nameProperty = new AttachmentAction();
        $nameProperty->setName(null);
    }
    
    /**
     * Test getting name
     */
    public function testGetName()
    {
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $nameProperty = $refAttachmentActionObject->getProperty('name');
        $nameProperty->setAccessible(true);
        $nameProperty->setValue($attachmentActionObject, $this->dummyString);
    
        $this->assertEquals($this->dummyString, $attachmentActionObject->getName());
    }
    
    /**
     * Test setting text
     */
    public function testSettingText()
    {
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->setText($this->dummyString);
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $textProperty = $refAttachmentActionObject->getProperty('text');
        $textProperty->setAccessible(true);
        
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
        $this->assertEquals($this->dummyString, $textProperty->getValue($attachmentActionObject));
    }
    
    /**
     * Test setting invalid text
     */
    public function testSettingInvalidText()
    {
        $this->expectException(\InvalidArgumentException::class);
        $textProperty = new AttachmentAction();
        $textProperty->setText(null);
    }
    
    /**
     * Test getting text
     */
    public function testGetText()
    {
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $textProperty = $refAttachmentActionObject->getProperty('text');
        $textProperty->setAccessible(true);
        $textProperty->setValue($attachmentActionObject, $this->dummyString);
    
        $this->assertEquals($this->dummyString, $attachmentActionObject->getText());
    }
    
    /**
     * Test setting style
     */
    public function testSettingStyle()
    {
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->setStyle(ActionStyle::DANGER_STYLE());
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $styleProperty = $refAttachmentActionObject->getProperty('style');
        $styleProperty->setAccessible(true);
        
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
        $this->assertEquals(ActionStyle::DANGER_STYLE(), $styleProperty->getValue($attachmentActionObject));
    }
    
    /**
     * Test for getting style
     */
    public function testGetStyle()
    {
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $styleProperty = $refAttachmentActionObject->getProperty('style');
        $styleProperty->setAccessible(true);
        $styleProperty->setValue($attachmentActionObject, $this->dummyString);
        
        $this->assertEquals($this->dummyString, $attachmentActionObject->getStyle());
    }
    
    /**
     * Test setting type
     */
    public function testSettingType()
    {
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->setType(ActionType::BUTTON());
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $typeProperty = $refAttachmentActionObject->getProperty('type');
        $typeProperty->setAccessible(true);
    
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
        $this->assertEquals(ActionType::BUTTON(), $typeProperty->getValue($attachmentActionObject));
    }
    
    /**
     * Test for getting type
     */
    public function testGetType()
    {
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $typeProperty = $refAttachmentActionObject->getProperty('type');
        $typeProperty->setAccessible(true);
        $typeProperty->setValue($attachmentActionObject, $this->dummyString);
    
        $this->assertEquals($this->dummyString, $attachmentActionObject->getType());
    }
    
    /**
     * Test setting value
     */
    public function testSettingValue()
    {
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->setValue($this->dummyString);
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $valueProperty = $refAttachmentActionObject->getProperty('value');
        $valueProperty->setAccessible(true);
    
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
        $this->assertEquals($this->dummyString, $valueProperty->getValue($attachmentActionObject));
    }
    
    /**
     * Test that exception is thrown, if setting invalid value of more that 2000 characters
     */
    public function testLongInvalidValue()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::STRING_TOO_LONG);
        $attachmentActionObject = new AttachmentAction();
        $attachmentActionObject->setValue(str_repeat(' ', 2001));
    }
    
    /**
     * Test setting invalid value
     */
    public function testSettingInvalidValue()
    {
        $this->expectException(\InvalidArgumentException::class);
        $valueProperty = new AttachmentAction();
        $valueProperty->setValue(null);
    }
    
    /**
     * Test for getting value
     */
    public function testGetValue()
    {
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $valueProperty = $refAttachmentActionObject->getProperty('value');
        $valueProperty->setAccessible(true);
        $valueProperty->setValue($attachmentActionObject, $this->dummyString);
    
        $this->assertEquals($this->dummyString, $attachmentActionObject->getValue());
    }
    
    /**
     * Test setting confirm
     */
    public function testSettingConfirm()
    {
        $actionConfirmObject = new ActionConfirm();
        $actionConfirmObject->setText($this->dummyString);
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->setConfirm($actionConfirmObject);
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $confirmProperty = $refAttachmentActionObject->getProperty('confirm');
        $confirmProperty->setAccessible(true);
        
        $this->assertInstanceOf(ActionConfirm::class, $confirmProperty->getValue($attachmentActionObject));
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
    }
    
    /**
     * Test for getting confirm
     */
    public function testGetConfirm()
    {
        $actionConfirmObject = new ActionConfirm();
        $actionConfirmObject->setText($this->dummyString);
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $confirmProperty = $refAttachmentActionObject->getProperty('confirm');
        $confirmProperty->setAccessible(true);
        $confirmProperty->setValue($attachmentActionObject, $actionConfirmObject);
        
        $this->assertInstanceOf(ActionConfirm::class, $attachmentActionObject->getConfirm());
    }
    
    /**
     * Test for adding option
     */
    public function testAddOption()
    {
        $actionOptionObject = new ActionOption();
        $actionOptionObject->setText($this->dummyString)
            ->setValue($this->dummyString)
        ;
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->addOption($actionOptionObject);
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $optionsProperty = $refAttachmentActionObject->getProperty('options');
        $optionsProperty->setAccessible(true);
        
        $this->assertInstanceOf(ActionOption::class, $optionsProperty->getValue($attachmentActionObject)[0]);
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
        $this->assertInternalType('array', $optionsProperty->getValue($attachmentActionObject));
        $this->assertEquals(1, count($optionsProperty->getValue($attachmentActionObject)));
    }
    
    /**
     * Test that exception is thrown if more than 100 options added
     */
    public function testSettingMoreThan100Options()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::TOO_MANY_OPTIONS);
        $actionOption = new ActionOption();
        $attachmentActionObject = new AttachmentAction();
        
        for($i = 0; $i <= 101; $i++){
            $attachmentActionObject->addOption($actionOption);
        }
    }
    
    /**
     * Test for getting options
     */
    public function testGetOptions()
    {
        $actionOptionObject = new ActionOption();
        $actionOptionObject->setText($this->dummyString)
            ->setValue($this->dummyString)
        ;
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $optionsProperty = $refAttachmentActionObject->getProperty('options');
        $optionsProperty->setAccessible(true);
        $optionsProperty->setValue($attachmentActionObject, [$actionOptionObject]);
        
        $this->assertInternalType('array', $attachmentActionObject->getOptions());
        $this->assertEquals(1, count($attachmentActionObject->getOptions()));
        $this->assertInstanceOf(ActionOption::class, $attachmentActionObject->getOptions()[0]);
    }
    
    /**
     * Test for adding selected option
     */
    public function testAddSelectedOption()
    {
        $actionOptionObject = new ActionOption();
        $actionOptionObject->setText($this->dummyString)
            ->setValue($this->dummyString)
        ;
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->addSelectedOption($actionOptionObject);
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $selectedOptionsProperty = $refAttachmentActionObject->getProperty('selectedOptions');
        $selectedOptionsProperty->setAccessible(true);
    
        $this->assertInstanceOf(ActionOption::class, $selectedOptionsProperty->getValue($attachmentActionObject)[0]);
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
        $this->assertInternalType('array', $selectedOptionsProperty->getValue($attachmentActionObject));
        $this->assertEquals(1, count($selectedOptionsProperty->getValue($attachmentActionObject)));
    }
    
    /**
     * Test that exception is thrown if trying to set more than one selected option
     */
    public function testSettingMoreThanOneSelectedOption()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::TOO_MANY_OPTIONS);
        $actionOption = new ActionOption();
        $attachmentActionObject = new AttachmentAction();

        $attachmentActionObject
            ->addSelectedOption($actionOption)
            ->addSelectedOption($actionOption)
        ;

    }
    
    /**
     * Test for getting selected options
     */
    public function testGetSelectedOptions()
    {
        $actionOptionObject = new ActionOption();
        $actionOptionObject->setText($this->dummyString)
            ->setValue($this->dummyString)
        ;
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $selectedOptionsProperty = $refAttachmentActionObject->getProperty('selectedOptions');
        $selectedOptionsProperty->setAccessible(true);
        $selectedOptionsProperty->setValue($attachmentActionObject, [$actionOptionObject]);
    
        $this->assertInternalType('array', $attachmentActionObject->getSelectedOptions());
        $this->assertEquals(1, count($attachmentActionObject->getSelectedOptions()));
        $this->assertInstanceOf(ActionOption::class, $attachmentActionObject->getSelectedOptions()[0]);
    }
    
    /**
     * Test for adding option group
     */
    public function testAddOptionGroup()
    {
        $actionOptionObject = new ActionOption();
        $actionOptionObject->setText($this->dummyString)
            ->setValue($this->dummyString)
        ;
        $actionOptionGroupObject = new ActionOptionGroup();
        $actionOptionGroupObject->setText($this->dummyString)
            ->addOption($actionOptionObject)
        ;
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->addOptionGroup($actionOptionGroupObject);
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $optionGroupsProperty = $refAttachmentActionObject->getProperty('optionGroups');
        $optionGroupsProperty->setAccessible(true);
        
        $this->assertInstanceOf(ActionOptionGroup::class, $optionGroupsProperty->getValue($attachmentActionObject)[0]);
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
        $this->assertInternalType('array', $optionGroupsProperty->getValue($attachmentActionObject));
        $this->assertEquals(1, count($optionGroupsProperty->getValue($attachmentActionObject)));
    }
    
    /**
     * Test for getting option groups
     */
    public function testGetOptionGroups()
    {
        $actionOptionObject = new ActionOption();
        $actionOptionObject->setText($this->dummyString)
            ->setValue($this->dummyString)
        ;
        $actionOptionGroupObject = new ActionOptionGroup();
        $actionOptionGroupObject->setText($this->dummyString)
            ->addOption($actionOptionObject)
        ;
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $optionGroupsProperty = $refAttachmentActionObject->getProperty('optionGroups');
        $optionGroupsProperty->setAccessible(true);
        $optionGroupsProperty->setValue($attachmentActionObject, [$actionOptionGroupObject]);
    
        $this->assertInternalType('array', $attachmentActionObject->getOptionGroups());
        $this->assertEquals(1, count($attachmentActionObject->getOptionGroups()));
        $this->assertInstanceOf(ActionOptionGroup::class, $attachmentActionObject->getOptionGroups()[0]);
    }
    
    /**
     * Test for setting dataSource
     */
    public function testSettingDataSource()
    {
        $attachmentActionObject = new AttachmentAction();
        $attachmentActionObject->setDataSource(ActionDataSource::USERS_SOURCE());
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $dataSourceProperty = $refAttachmentActionObject->getProperty('dataSource');
        $dataSourceProperty->setAccessible(true);
        $this->assertEquals(ActionDataSource::USERS_SOURCE(), $dataSourceProperty->getValue($attachmentActionObject));
    }
    
    /**
     * Test setting minQueryLength property
     */
    public function testSettingMinQueryLength()
    {
        $attachmentActionObject = new AttachmentAction();
        $returnedObject = $attachmentActionObject->setMinQueryLength($this->dummyInt);
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $minQueryLengthProperty = $refAttachmentActionObject->getProperty('minQueryLength');
        $minQueryLengthProperty->setAccessible(true);
        
        $this->assertInstanceOf(AttachmentAction::class, $returnedObject);
        $this->assertEquals($this->dummyInt, $minQueryLengthProperty->getValue($attachmentActionObject));
    }
    
    /**
     * Test setting invalid minQueryLength value
     */
    public function testSettingInvalidMinQueryLength()
    {
        $this->expectException(\InvalidArgumentException::class);
        $valueProperty = new AttachmentAction();
        $valueProperty->setMinQueryLength(null);
    }
    
    /**
     * Test for getting minQueryLength
     */
    public function testGetMinQueryLength()
    {
        $attachmentActionObject = new AttachmentAction();
        $refAttachmentActionObject = new \ReflectionObject($attachmentActionObject);
        $minQueryLengthProperty = $refAttachmentActionObject->getProperty('minQueryLength');
        $minQueryLengthProperty->setAccessible(true);
        $minQueryLengthProperty->setValue($attachmentActionObject, $this->dummyInt);
    
        $this->assertEquals($this->dummyInt, $attachmentActionObject->getMinQueryLength());
    }
    
    /**
     * Test that exception is thrown, if name property is not set
     */
    public function testValidateModelName()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::MISSING_REQUIRED_FIELD);
        $attachmentActionObject = new AttachmentAction();
        $attachmentActionObject->setText($this->dummyString)
            ->setType(ActionType::BUTTON())
        ;
        $attachmentActionObject->validateModel();
    }
    
    /**
     * Test that exception is thrown, if text property is not set
     */
    public function testValidateModelText()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::MISSING_REQUIRED_FIELD);
        $attachmentActionObject = new AttachmentAction();
        $attachmentActionObject->setName($this->dummyString)
            ->setType(ActionType::BUTTON())
        ;
        $attachmentActionObject->validateModel();
    }
    
    /**
     * Test that exception is thrown, if type property is not set
     */
    public function testValidateModelType()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::MISSING_REQUIRED_FIELD);
        $attachmentActionObject = new AttachmentAction();
        $attachmentActionObject
            ->setName($this->dummyString)
            ->setText($this->dummyString)
        ;
        $attachmentActionObject->validateModel();
    }
    
    /**
     * Test successful validation of model 
     */
    public function testValidateModelWithStaticDataSourceSuccess()
    {
        $actionOption = new ActionOption();
        $actionOption
            ->setText($this->dummyString)
            ->setValue($this->dummyString)
        ;
        $selectedActionOption = new ActionOption();
        $selectedActionOption
            ->setText($this->dummyString)
            ->setValue($this->dummyString)
        ;
        $attachmentActionObject = new AttachmentAction();
        $attachmentActionObject
            ->setName($this->dummyString)
            ->setText($this->dummyString)
            ->setType(ActionType::BUTTON())
            ->setDataSource(ActionDataSource::STATIC_SOURCE())
            ->addOption($actionOption)
            ->addSelectedOption($selectedActionOption)
        ;
        $attachmentActionObject->validateModel();
    }
    
    /**
     * Test that exception is thrown if ActionOptions are not provided, when using static data source
     */
    public function testValidateModelStaticDataSourceWithoutActionOptions()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::MISSING_REQUIRED_FIELD);
        $attachmentActionObject = new AttachmentAction();
        $attachmentActionObject
            ->setName($this->dummyString)
            ->setText($this->dummyString)
            ->setType(ActionType::BUTTON())
            ->setDataSource(ActionDataSource::STATIC_SOURCE())
        ;
        $attachmentActionObject->validateModel();
    }
    
    /**
     * Test that exception is thrown if selectedOption is not in the list of provided options
     */
    public function testValidateModelSelectedOptionNotInListOfOptions()
    {
        $actionOption = new ActionOption();
        $actionOption
            ->setText($this->dummyString)
            ->setValue($this->dummyString)
        ;
        $selectedActionOption = new ActionOption();
        $selectedActionOption
            ->setText($this->dummyString)
            ->setValue('text')
        ;
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::SELECTED_OPTION_NOT_FOUND_IN_OPTIONS);
        $attachmentActionObject = new AttachmentAction();
        $attachmentActionObject
            ->setName($this->dummyString)
            ->setText($this->dummyString)
            ->setType(ActionType::BUTTON())
            ->setDataSource(ActionDataSource::STATIC_SOURCE())
            ->addOption($actionOption)
            ->addSelectedOption($selectedActionOption)
        ;
        $attachmentActionObject->validateModel();
        $this->assertTrue(true);
    }
}