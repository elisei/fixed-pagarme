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
            $typesPagBank = isset($result['payment']['ccform']['availableTypes']['pagbank_paymentmagento_cc']) ?
                $result['payment']['ccform']['availableTypes']['pagbank_paymentmagento_cc'] : null;
            $typesGetnet = isset($result['payment']['ccform']['availableTypes']['getnet_paymentmagento_cc']) ?
                $result['payment']['ccform']['availableTypes']['getnet_paymentmagento_cc'] : null;

            if ($typesPagBank) {
                foreach ($typesPagBank as $cardType => $values) {
                    if (is_array($values)) {
                        $result['payment']['ccform']['availableTypes']['pagbank_paymentmagento_cc'][$cardType] =
                            array_values(array_unique($values));
                    }
                }

                $months = $result['payment']['ccform']['months']['pagbank_paymentmagento_cc'];

                foreach ($months as $key => $month) {
                    if ($key > 12) {
                        unset($months[$key]);
                    }
                }

                $result['payment']['ccform']['months']['pagbank_paymentmagento_cc'] = $months;

                $years = $result['payment']['ccform']['years']['pagbank_paymentmagento_cc'];

                foreach ($years as $key => $year) {
                    if ($key != $year) {
                        unset($years[$key]);
                    }
                }

                $result['payment']['ccform']['years']['pagbank_paymentmagento_cc'] = $years;
            }

            if ($typesGetnet) {
                foreach ($typesGetnet as $cardType => $values) {
                    if (is_array($values)) {
                            $result['payment']['ccform']['availableTypes']['getnet_paymentmagento_cc'][$cardType] =
                            array_values(array_unique($values));
                    }
                }

                $months = $result['payment']['ccform']['months']['getnet_paymentmagento_cc'];

                foreach ($months as $key => $month) {
                    if ($key > 12) {
                        unset($months[$key]);
                    }
                }

                $result['payment']['ccform']['months']['getnet_paymentmagento_cc'] = $months;

                $years = $result['payment']['ccform']['years']['getnet_paymentmagento_cc'];

                foreach ($years as $key => $year) {
                    if ($key != $year) {
                        unset($years[$key]);
                    }
                }

                $result['payment']['ccform']['years']['getnet_paymentmagento_cc'] = $years;
            }
        }
        
        return $result;
    }
}