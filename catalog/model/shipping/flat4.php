<?php
class ModelShippingFlat4 extends Model {
	function getQuote($address) {
		$this->load->language('shipping/flat4');

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "zone_to_geo_zone WHERE geo_zone_id = '" . (int)$this->config->get('flat4_geo_zone_id') . "' AND country_id = '" . (int)$address['country_id'] . "' AND (zone_id = '" . (int)$address['zone_id'] . "' OR zone_id = '0')");

		if (!$this->config->get('flat4_geo_zone_id')) {
			$status = true;
		} elseif ($query->num_rows) {
			$status = true;
		} else {
			$status = false;
		}
		if (get_class($this)!='ModelShippingFree') {
			if (($this->config->get('free_status') == 1) && (float)$this->cart->getTotal() >= $this->config->get('free_total')) {
                $status = false;
            }
        }

		$method_data = array();

		if ($status) {
			$quote_data = array();

			$quote_data['flat4'] = array(
				'code'         => 'flat4.flat4',
				'title'        => $this->language->get('text_description'),
				'cost'         => $this->config->get('flat4_cost'),
				'tax_class_id' => $this->config->get('flat4_tax_class_id'),
				'text'         => $this->currency->format($this->tax->calculate($this->config->get('flat4_cost'), $this->config->get('flat4_tax_class_id'), $this->config->get('config_tax')))
			);

			$method_data = array(
				'code'       => 'flat4',
				'title'      => $this->language->get('text_title'),
				'quote'      => $quote_data,
				'sort_order' => $this->config->get('flat4_sort_order'),
				'error'      => false
			);
		}

		return $method_data;
	}
}