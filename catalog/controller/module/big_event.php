<?php
################################################################################################
#  DIY Module Builder for Opencart 1.5.1.x From HostJars http://opencart.hostjars.com    	   #
################################################################################################
?><?php

class ControllerModuleBigEvent extends Controller {
	protected function index($setting) {
		//Load the language file for this module - catalog/language/module/my_module.php
		$this->language->load('module/big_event');

		//Get the title from the language file
      	$this->data['heading_title'] = $this->language->get('heading_title');
      	if(file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/big_event.css')) {
      		$this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/big_event.css');	
      	} else {
      		$this->document->addStyle('catalog/view/theme/default/stylesheet/big_event.css');	
      	}
      	$this->document->addScript('catalog/view/javascript/big_event.js');	

		//Load any required model files - catalog/product is a common one, or you can make your own DB access
		//methods in catalog/model/module/my_module.php
		$this->load->model('setting/setting');
		$this->load->model('tool/image');

		//Example functionality: pull through customer firstnames and make them available to the view.
		
		$module = $this->model_setting_setting->getSetting('big_event');
		$image = $module['image'];
		$this->data['module'] = $module;
		$this->data['link'] = $module['link'];
		$width = $setting['image_width'];
		$height = $setting['image_height'];
		$this->data['image'] = $this->model_tool_image->resize($image, $width, $height);
		$this->data['setting'] = $setting;
		//Choose which template to display this module with
		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/big_event.tpl')) {
			$this->template = $this->config->get('config_template') . '/template/module/big_event.tpl';
		} else {
			$this->template = 'default/template/module/big_event.tpl';
		}

		//Render the page with the chosen template
		$this->render();
	}
}
?>