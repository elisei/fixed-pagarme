<?php
/**
 * O2TI Fixed Pagarme.
 *
 * Copyright © 2024 O2TI. All rights reserved.
 *
 * @author    Bruno Elisei <brunoelisei@o2ti.com>
 * @license   See LICENSE for license details.
 */

namespace O2TI\FixedPagarme\Plugin\Checkout\Model;

use Magento\Checkout\Model\CompositeConfigProvider;

class CompositeConfigProviderPlugin
{
    public function afterGetConfig(CompositeConfigProvider $subject, array $result)
    {
        if (isset($result['payment']['ccform']['availableTypes']['pagbank_paymentmagento_cc'])) {
            $types = $result['payment']['ccform']['availableTypes']['pagbank_paymentmagento_cc'];

            foreach ($types as $cardType => $values) {
                if (is_array($values)) {
                    // $result['payment']['ccform']['availableTypes']['pagbank_paymentmagento_cc'][$cardType] = 
                    //     array_values(array_unique($values));
                }
            }
        }
        
        return $result;
    }
}