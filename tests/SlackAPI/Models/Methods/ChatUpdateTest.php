<?php

namespace SlackPHP\Tests\SlackAPI\Models\Methods;

use PHPUnit\Framework\TestCase;
use SlackPHP\SlackAPI\Exceptions\SlackException;
use SlackPHP\SlackAPI\Models\Methods\ChatUpdate;
use SlackPHP\SlackAPI\Models\MessageParts\Attachment;
use SlackPHP\SlackAPI\Enumerators\Parse;
use SlackPHP\SlackAPI\Enumerators\Method;
use SlackPHP\SlackAPI\Models\MessageParts\Message;

/**
 * @author Dzianis Zhaunerchyk <dzhaunerchyk@gmail.com>
 * @author Zxurian
 * @covers ChatUpdate
 */
class ChatUpdateTest extends TestCase
{
    private $dummyString = 'string';
    
    private $dummyBool = true;
    
    /**
     * Test for setting channel
     */
    public function testSettingChannel()
    {
        $chatUpdateObject = new ChatUpdate();
        $returnedObject = $chatUpdateObject->setChannel($this->dummyString);
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $channelProperty = $refChatUpdateObject->getProperty('channel');
        $channelProperty->setAccessible(true);
        
        $this->assertInstanceOf(ChatUpdate::class, $returnedObject);
        $this->assertEquals($this->dummyString, $channelProperty->getValue($chatUpdateObject));
    }
    
    /**
     * Test for setting invalid channel
     */
    public function testSettingInvalidChannel()
    {
        $this->expectException(\InvalidArgumentException::class);
        $chatUpdateObject = new ChatUpdate();
        $chatUpdateObject->setChannel(null);
    }
    
    /**
     * Test for getting channel
     */
    public function testGetChannel()
    {
        $chatUpdateObject = new ChatUpdate();
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $channelProperty = $refChatUpdateObject->getProperty('channel');
        $channelProperty->setAccessible(true);
        $channelProperty->setValue($chatUpdateObject, $this->dummyString);
        
        $this->assertEquals($this->dummyString, $chatUpdateObject->getChannel());
    }
    
    /**
     * Test for setting ts
     */
    public function testSettingTs()
    {
        $chatUpdateObject = new ChatUpdate();
        $returnedObject = $chatUpdateObject->setTs($this->dummyString);
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $tsProperty = $refChatUpdateObject->getProperty('ts');
        $tsProperty->setAccessible(true);
    
        $this->assertInstanceOf(ChatUpdate::class, $returnedObject);
        $this->assertEquals($this->dummyString, $tsProperty->getValue($chatUpdateObject));
    }
    
    /**
     * Test for setting invalid ts
     */
    public function testSettingInvalidTs()
    {
        $this->expectException(\InvalidArgumentException::class);
        $chatUpdateObject = new ChatUpdate();
        $chatUpdateObject->setTs(null);
    }
    
    /**
     * Test for getting ts
     */
    public function testGetTs()
    {
        $chatUpdateObject = new ChatUpdate();
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $tsProperty = $refChatUpdateObject->getProperty('ts');
        $tsProperty->setAccessible(true);
        $tsProperty->setValue($chatUpdateObject, $this->dummyString);
    
        $this->assertEquals($this->dummyString, $chatUpdateObject->getTs());
    }
    
    /**
     * Test for setting text
     */
    public function testSettingText()
    {
        $chatUpdateObject = new ChatUpdate();
        $returnedObject = $chatUpdateObject->setText($this->dummyString);
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $textProperty = $refChatUpdateObject->getProperty('text');
        $textProperty->setAccessible(true);
    
        $this->assertInstanceOf(ChatUpdate::class, $returnedObject);
        $this->assertEquals($this->dummyString, $textProperty->getValue($chatUpdateObject));
    }
    
    /**
     * Test for setting invalid text
     */
    public function testSettingInvalidText()
    {
        $this->expectException(\InvalidArgumentException::class);
        $chatUpdateObject = new ChatUpdate();
        $chatUpdateObject->setText(null);
    }
    
    /**
     * Test for getting text
     */
    public function testGetText()
    {
        $chatUpdateObject = new ChatUpdate();
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $textProperty = $refChatUpdateObject->getProperty('text');
        $textProperty->setAccessible(true);
        $textProperty->setValue($chatUpdateObject, $this->dummyString);
    
        $this->assertEquals($this->dummyString, $chatUpdateObject->getText());
    }
    
    /**
     * Test for adding Attachment
     */
    public function testAddingAttachment()
    {
        $attachmentObject = new Attachment();
        $attachmentObject->setFallback($this->dummyString);
        $chatUpdateObject = new ChatUpdate();
        $returnedObject = $chatUpdateObject->addAttachment($attachmentObject);
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $attachmentsProperty = $refChatUpdateObject->getProperty('attachments');
        $attachmentsProperty->setAccessible(true);
        
        $this->assertInstanceOf(Attachment::class, $attachmentsProperty->getValue($chatUpdateObject)[0]);
        $this->assertInstanceOf(ChatUpdate::class, $returnedObject);
        $this->assertInternalType('array', $attachmentsProperty->getValue($chatUpdateObject));
        $this->assertEquals(1, count($attachmentsProperty->getValue($chatUpdateObject)));
    }
    
    /**
     * Test for getting attachments
     */
    public function testGetAttachments()
    {
        $attachmentObject = new Attachment();
        $attachmentObject->setFallback($this->dummyString);
        $chatUpdateObject = new ChatUpdate();
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $attachmentsProperty = $refChatUpdateObject->getProperty('attachments');
        $attachmentsProperty->setAccessible(true);
        $attachmentsProperty->setValue($chatUpdateObject, [$attachmentObject]);
        
        $this->assertInternalType('array', $chatUpdateObject->getAttachments());
        $this->assertEquals(1, count($chatUpdateObject->getAttachments()));
        $this->assertInstanceOf(Attachment::class, $chatUpdateObject->getAttachments()[0]);
    }
    
    /**
     * Test for setting parse
     */
    public function testSettingParse()
    {
        $chatUpdateObject = new ChatUpdate();
        $returnedObject = $chatUpdateObject->setParse(Parse::FULL());
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $parseProperty = $refChatUpdateObject->getProperty('parse');
        $parseProperty->setAccessible(true);
    
        $this->assertInstanceOf(ChatUpdate::class, $returnedObject);
        $this->assertEquals(Parse::FULL(), $parseProperty->getValue($chatUpdateObject));
    }
    
    /**
     * Test for getting parse
     */
    public function testGetParse()
    {
        $chatUpdateObject = new ChatUpdate();
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $parseProperty = $refChatUpdateObject->getProperty('parse');
        $parseProperty->setAccessible(true);
        $parseProperty->setValue($chatUpdateObject, $this->dummyString);
    
        $this->assertEquals($this->dummyString, $chatUpdateObject->getParse());
    }
    
    /**
     * Test for setting linkNames
     */
    public function testSettingLinkNames()
    {
        $chatUpdateObject = new ChatUpdate();
        $returnedObject = $chatUpdateObject->setLinkNames($this->dummyBool);
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $linkNamesProperty = $refChatUpdateObject->getProperty('linkNames');
        $linkNamesProperty->setAccessible(true);
    
        $this->assertInstanceOf(ChatUpdate::class, $returnedObject);
        $this->assertEquals($this->dummyBool, $linkNamesProperty->getValue($chatUpdateObject));
    }
    
    /**
     * Test for setting invalid linkNames
     */
    public function testSettingInvalidLinkNames()
    {
        $this->expectException(\InvalidArgumentException::class);
        $chatUpdateObject = new ChatUpdate();
        $chatUpdateObject->setLinkNames(null);
    }
    
    /**
     * Test for getting linkNames
     */
    public function testGetLinkNames()
    {
        $chatUpdateObject = new ChatUpdate();
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $linkNamesProperty = $refChatUpdateObject->getProperty('linkNames');
        $linkNamesProperty->setAccessible(true);
        $linkNamesProperty->setValue($chatUpdateObject, $this->dummyBool);
    
        $this->assertEquals($this->dummyBool, $chatUpdateObject->getLinkNames());
    }
    
    /**
     * Test for setting asUser
     */
    public function testSettingAsUser()
    {
        $chatUpdateObject = new ChatUpdate();
        $returnedObject = $chatUpdateObject->setAsUser($this->dummyBool);
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $asUserProperty = $refChatUpdateObject->getProperty('asUser');
        $asUserProperty->setAccessible(true);
    
        $this->assertInstanceOf(ChatUpdate::class, $returnedObject);
        $this->assertEquals($this->dummyBool, $asUserProperty->getValue($chatUpdateObject));
    }
    
    /**
     * Test for setting invalid asUser
     */
    public function testSettingInvalidAsUser()
    {
        $this->expectException(\InvalidArgumentException::class);
        $chatUpdateObject = new ChatUpdate();
        $chatUpdateObject->setAsUser(null);
    }
    
    /**
     * Test for getting asUser
     */
    public function testGetAsUser()
    {
        $chatUpdateObject = new ChatUpdate();
        $refChatUpdateObject = new \ReflectionObject($chatUpdateObject);
        $asUserProperty = $refChatUpdateObject->getProperty('asUser');
        $asUserProperty->setAccessible(true);
        $asUserProperty->setValue($chatUpdateObject, $this->dummyBool);
    
        $this->assertEquals($this->dummyBool, $chatUpdateObject->getAsUser());
    }
    
    /**
     * Test that exception is thrown if required ts property is not set
     */
    public function testValidatePayloadTs()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::MISSING_REQUIRED_FIELD);
        $chatUpdateObject = new ChatUpdate();
        $chatUpdateObject->setChannel($this->dummyString)
            ->setText($this->dummyString)
        ;
        $chatUpdateObject->validatePayload();
    }
    
    /**
     * Test that exception is thrown if required channel property is not set
     */
    public function testValidatePayloadChannel()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::MISSING_REQUIRED_FIELD);
        $chatUpdateObject = new ChatUpdate();
        $chatUpdateObject->setTs($this->dummyString)
            ->setText($this->dummyString)
        ;
        $chatUpdateObject->validatePayload();
    }
    
    /**
     * Test that exception is thrown if required text property is not set
     */
    public function testValidatePayloadText()
    {
        $this->expectException(SlackException::class);
        $this->expectExceptionCode(SlackException::MISSING_REQUIRED_FIELD);
        $chatUpdateObject = new ChatUpdate();
        $chatUpdateObject->setTs($this->dummyString)
            ->setChannel($this->dummyString)
        ;
        $chatUpdateObject->validatePayload();
    }
    
    /**
     * Test for getting response class
     */
    public function testGetResponseClass()
    {
        $chatUpdateObject = new ChatUpdate();
    
        $this->assertEquals(get_class($chatUpdateObject).'Response', $chatUpdateObject->getResponseClass());
    }
    
    /**
     * Test for getting API method
     */
    public function testGetMethod()
    {
        $chatUpdateObject = new ChatUpdate();
    
        $this->assertEquals(Method::CHAT_UPDATE(), $chatUpdateObject->getMethod());
    }
    
    public function testCreateFromMessage()
    {
        $attachment = new Attachment();
        $attachment->setFallback($this->dummyString);
        
        $message = new Message();
        $message
        ->setText($this->dummyString)
        ->setChannel($this->dummyString)
        ->addAttachment($attachment)
        ->setThreadTs($this->dummyString)
        ;
        
        $chatUpdate = ChatUpdate::createFromMessage($message);
        $refChatUpdate = new \ReflectionObject($chatUpdate);
        $this->assertInstanceOf(ChatUpdate::class, $chatUpdate);
        
        $fieldsToCheck = [
            'text',
            'channel',
            'attachments',
            'threadTs',
        ];
        
        foreach ($fieldsToCheck as $field) {
            $methodName = 'get'.strtoupper(substr($field, 0, 1)).substr($field, 1);
            $property = $refChatUpdate->getProperty($field);
            $property->setAccessible(true);
            $this->assertEquals($message->$methodName(), $property->getValue($chatUpdate));
        }
        
    }
    
}