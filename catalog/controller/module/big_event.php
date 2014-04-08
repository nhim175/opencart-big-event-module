<?php

class ControllerModuleBigEvent extends Controller {
  protected function index($setting) {
    $this->language->load('module/big_event');

    $this->load->model('setting/setting');
    $this->load->model('tool/image');

    $module = $this->model_setting_setting->getSetting('big_event');

    $width  = $setting['image_width'];
    $height = $setting['image_height'];
    $image  = $module['image'];

    $this->data['module']        = $module;
    $this->data['link']          = $module['link'];
    $this->data['image']         = $this->model_tool_image->resize($image, $width, $height);
    $this->data['setting']       = $setting;
    $this->data['heading_title'] = $this->language->get('heading_title');

    if(!$this->session->data['splashed'] || !$module['once_per_session'])
    {
      if(file_exists('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/big_event.css')) {
        $this->document->addStyle('catalog/view/theme/' . $this->config->get('config_template') . '/stylesheet/big_event.css');  
      } else {
        $this->document->addStyle('catalog/view/theme/default/stylesheet/big_event.css');  
      }

      $this->document->addScript('catalog/view/javascript/big_event.js');  
  
      if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/big_event.tpl')) {
        $this->template = $this->config->get('config_template') . '/template/module/big_event.tpl';
      } else {
        $this->template = 'default/template/module/big_event.tpl';
      }

      $this->render();
    }

    if($module['once_per_session'])
    {
      $this->session->data['splashed'] = 1;
    }
  }
}
?>
