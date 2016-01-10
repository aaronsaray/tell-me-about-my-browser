<?php
/**
 * The model for the browser access
 *
 * @author Aaron Saray
 */

namespace AboutBrowser\Model;
use UAParser\Parser;

/**
 * Class Visitor
 * @package AboutBrowser\Model
 * @Entity(repositoryClass="AboutBrowser\Repository\Visitor")
 * @Table(name="visitors")
 * @HasLifecycleCallbacks
 */
class Visitor
{
    /**
     * @var integer the identifier
     * @Id @Column(type="integer")
     * @GeneratedValue
     */
    protected $id = '';

    /**
     * @var \DateTime the time it was created
     * @Column(type="datetime", name="created_at")
     */
    protected $createdAt;

    /**
     * @var string the serialized json data
     * @Column(type="json_array", name="server_data")
     */
    protected $serverData;

    /**
     * @var string the serialized json data
     * @Column(type="json_array", name="javascript_data", nullable=true)
     */
    protected $javascriptData;

    /**
     * @var UAParser\Result\Client
     */
    protected $uaParserResult;

    /**
     * @return int the ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param array $serverData the server data array
     * @return self
     */
    public function setServerData(array $serverData)
    {
        if (isset($serverData['MYSQL_PASS'])) unset($serverData['MYSQL_PASS']);
        $this->serverData = $serverData;
        return $this;
    }

    /**
     * @return array
     */
    public function getServerData()
    {
        return $this->serverData;
    }

    /**
     * @param \DateTime $createdAt
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @PrePersist
     */
    public function onPrePersistSetCreatedAtDate()
    {
        $this->setCreatedAt(new \DateTime());
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @return string the public base 36 id
     */
    public function getPublicID()
    {
        return base_convert($this->getId(), 10, 36);
    }

    /**
     * @return string
     */
    public function getJavascriptData()
    {
        return $this->javascriptData;
    }

    /**
     * @param string $javascriptData
     * @return Visitor
     */
    public function setJavascriptData($javascriptData)
    {
        $this->javascriptData = $javascriptData;
        return $this;
    }


    /**************************  the following are used for display purposes mainly ***********************************/

    /**
     * @return string the URL to view this
     */
    public function getViewURL()
    {
        return 'http://' . $_SERVER['SERVER_NAME'] . '/me/' . $this->getPublicID();
    }

    /**
     * Get the IP Address
     * @return string|null
     */
    public function getIP()
    {
        return isset($this->serverData['REMOTE_ADDR']) ? $this->serverData['REMOTE_ADDR'] : null;
    }

    /**
     * Get the forwarded IP address
     * @return null|string
     */
    public function getIPForwardedFor()
    {
        return isset($this->serverData['HTTP_X_FORWARDED_FOR']) ? $this->serverData['HTTP_X_FORWARDED_FOR'] : null;
    }

    /**
     * Gets a full operating system string
     * @return string
     */
    public function getFullOperatingSystem()
    {
        $this->cacheParserResults();
        return $this->uaParserResult->os->toString();
    }

    /**
     * Gets the full browser version
     * @return string
     */
    public function getFullBrowserVersion()
    {
        $this->cacheParserResults();
        return $this->uaParserResult->ua->toString();
    }

    /**
     * Cache the parsed results.
     */
    protected function cacheParserResults()
    {
        if (is_null($this->uaParserResult)) {
            $uaParser = Parser::create();
            $this->uaParserResult = $uaParser->parse($this->serverData['HTTP_USER_AGENT']);
        }
    }
}