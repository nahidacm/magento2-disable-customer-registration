<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Deved\DisableRegistration\Plugin\Webapi\Magento\Customer\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class AccountManagement
{
    const XML_PATH_DISABLE_CUSTOMER_REGISTRATION = 'customer/create_account/disable_customer_registration';

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function beforeCreateAccount(
        \Magento\Customer\Model\AccountManagement $subject,
        $customer,
        $redirectUrl = '',
        $password = null
    ) {
        if ($this->scopeConfig->isSetFlag(
            self::XML_PATH_DISABLE_CUSTOMER_REGISTRATION,
            ScopeInterface::SCOPE_STORE
        )) {
            throw new \Exception('Registration Restricted');
        }


        return [$customer, $redirectUrl, $password];
    }
}
