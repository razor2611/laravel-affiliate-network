<?php
namespace Padosoft\AffiliateNetwork\Networks;

use Padosoft\AffiliateNetwork\Transaction;
use Padosoft\AffiliateNetwork\Merchant;


use Padosoft\AffiliateNetwork\AbstractNetwork;
use Padosoft\AffiliateNetwork\NetworkInterface;
use Padosoft\AffiliateNetwork\DealsResultset;
use Padosoft\AffiliateNetwork\ProductsResultset;

class VigLink extends AbstractNetwork implements NetworkInterface
{
    
    private $_network = null;
    private $_apiClient = null;
   // private $_username = '';
   // private $_password = '';
    private $_apiKey = '';
    private $_logged    = false;
    protected $_tracking_parameter    = 'key';    
    
    /**
     * @method __construct
     */
    public function __construct(string $apiKey)
    {
        $this->_network = new \Oara\Network\Publisher\VigLink;

        //$this->_username = $username;
       // $this->_password = $password;
        $this->_apiKey = $apiKey;
        $this->_apiClient = null;
        $this->login($this->_apiKey);
    }
    
    
    public function login(string $apiKey): bool
    {
        
        if (isNullOrEmpty( $apiKey ) || isNullOrEmpty( $apiKey )) {
            return false;
        }        

        $this->_apiKey = $apiKey;
        $credentials = array();
        $credentials["apiKey"] = $this->_apiKey;

        $this->_network->login($credentials);
        
        if ($this->_network->checkConnection()) {
            $this->_logged = true;
        }
        return $this->_logged;
    }    
    
    
    /**
     * @return bool
     */
    public function checkLogin() : bool
    {
        return $this->_logged;
    }    
    
    
    /**
     * @return array of Merchants
     */
    public function getMerchants() : array
    {
        if (!$this->checkLogin()) {
            return array();
        }
        
        
        $arrResult = array();
        $merchantList = $this->_network->getMerchantList();
                
        foreach($merchantList as $merchant) {
            $Merchant = Merchant::createInstance();
            $Merchant->merchant_ID = $merchant['cid'];
            $Merchant->name = $merchant['name'];
            $Merchant->url = $merchant['url'];
            $Merchant->status = $merchant['status'];
            $arrResult[] = $Merchant;
        }
        return $arrResult;
    }
    
    
    /**
     * @param int|null $merchantID
     * @param int $page
     * @param int $items_per_page
     *
     * @return DealsResultset
     */
    public function getDeals($merchantID,int $page=0,int $items_per_page=10) : DealsResultset
    {
       // TODO
       throw new \Exception("Not implemented yet");        
    }
        
    
    /**
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param int $merchantID
     * @return array of Transaction
     */
    public function getSales(\DateTime $dateFrom, \DateTime $dateTo, array $arrMerchantID = array()) : array
    {
       // TODO
       throw new \Exception("Not implemented yet");
    }    
    
    
    /**
     * @param \DateTime $dateFrom
     * @param \DateTime $dateTo
     * @param int $merchantID
     * @return array of Stat
     */
    public function getStats(\DateTime $dateFrom, \DateTime $dateTo, int $merchantID = 0) : array
    {
        // TODO
        throw new \Exception("Not implemented yet");
    }


    /**
     * @param  array $params
     *
     * @return ProductsResultset
     */
    public function getProducts(array $params = []): ProductsResultset
    {
        // TODO: Implement getProducts() method.
        throw new \Exception("Not implemented yet");
    }    
    
    /**
     * @return string
     */
    public function getTrackingParameter(){
        return $this->_tracking_parameter;
    }    
    
}