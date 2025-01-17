<?php
class ModelCatalogSeoPackage extends Model {
  
  public function __construct($registry) {
    parent::__construct($registry);
    
    if (version_compare(VERSION, '3', '>=')) {
      $this->url_alias = 'seo_url';
    } else {
      $this->url_alias = 'url_alias';
    }
  }
  
  public function getSeoDescriptions($type, $item_id) {
		$seo_description_data = array();
    
    $extra_select = '';
    
    if ($this->config->get('mlseo_enabled')) {
      if (version_compare(VERSION, '3', '>=') || ($this->config->get('mlseo_multistore') && $this->config->get('mlseo_ml_mode'))) {
        $extra_select = ",(SELECT keyword FROM " . DB_PREFIX . $this->url_alias . " u WHERE query = '".$this->db->escape($type)."_id=".$item_id."' AND (u.language_id = d.language_id) AND (u.store_id = d.store_id) LIMIT 1) AS seo_keyword";
      } else if ($this->config->get('mlseo_multistore')) {
        $extra_select = ",(SELECT keyword FROM " . DB_PREFIX . $this->url_alias . " u WHERE query = '".$this->db->escape($type)."_id=".$item_id."' AND (u.store_id = d.store_id) LIMIT 1) AS seo_keyword";
      } else if ($this->config->get('mlseo_ml_mode')) {
        $extra_select = ",(SELECT keyword FROM " . DB_PREFIX . $this->url_alias . " u WHERE query = '".$this->db->escape($type)."_id=".$item_id."' AND (u.language_id = d.language_id OR u.language_id = 0) LIMIT 1) AS seo_keyword";
      } else {
        $extra_select = ",(SELECT keyword FROM " . DB_PREFIX . $this->url_alias . " WHERE query = '".$this->db->escape($type)."_id=".$item_id."' LIMIT 1) AS seo_keyword";
      }
    }
    
    try {
     $query = $this->db->query("SELECT * ".$extra_select." FROM " . DB_PREFIX . "seo_".$type."_description d WHERE ".$this->db->escape($type)."_id = '" . (int)$item_id . "'");
 
 		  foreach ($query->rows as $result) {
 			  $seo_description_data[$result['store_id']][$result['language_id']] = $result;
 		  }
    } catch (Exception $e) {
      echo '<div class="alert alert-danger" style="margin:20px"><i class="fa fa-exclamation-triangle"></i> The tables for extended SEO does not exist, please go at least once in module options in order to auto-create them</div>';
    }
    
		return $seo_description_data;
	}
  
  public function setSeoDescriptions($type, $data, $item_id = false) {
    if (!$this->config->get('mlseo_enabled')) return;
    
    if (!isset($data['seo_'.$type.'_description'])) return;
    
    $this->load->model('tool/seo_package');
    
    $this->db->query("DELETE FROM " . DB_PREFIX . "seo_".$this->db->escape($type)."_description WHERE ".$this->db->escape($type)."_id = '" . (int)$item_id . "'");
    
    foreach ($data['seo_'.$type.'_description'] as $store_id => $languages) {
      foreach ($languages as $language_id => $value) {
        $data[$type.'_id'] = $item_id; // add item id into dataset for use with patterns
        
        $seo_kw = '';
        $extra_fields = '';
        
        if (empty($value['seo_keyword']) && $this->config->get('mlseo_insertautourl')) {
          $seo_kw = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_url_pattern'), $language_id, $data);
        } else if (!empty($value['seo_keyword'])) {
          $seo_kw = html_entity_decode($value['seo_keyword'], ENT_QUOTES, 'UTF-8');
        }
        
        if ($seo_kw) {
          $seo_kw = $this->model_tool_seo_package->filter_seo($seo_kw, $type, $item_id, $language_id);
        }
        
        if (version_compare(VERSION, '3', '>=') || ($this->config->get('mlseo_multistore') && $this->config->get('mlseo_ml_mode'))) {
          $this->db->query("INSERT INTO " . DB_PREFIX . $this->url_alias . " SET query = '".$this->db->escape($type)."_id=" . (int)$item_id . "', store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', keyword = '" . $this->db->escape($seo_kw) . "'");
        } else if ($this->config->get('mlseo_multistore')) {
          $this->db->query("INSERT INTO " . DB_PREFIX . $this->url_alias . " SET query = '".$this->db->escape($type)."_id=" . (int)$item_id . "', store_id = '" . (int)$store_id . "', keyword = '" . $this->db->escape($seo_kw) . "'");
        } else if ($type == 'manufacturer') {
          $this->db->query("INSERT INTO " . DB_PREFIX . $this->url_alias . " SET query = '".$this->db->escape($type)."_id=" . (int)$item_id . "', keyword = '" . $this->db->escape($seo_kw) . "'");
        }
        
        foreach (array('meta_title', 'meta_description', 'meta_keyword', 'seo_h1', 'seo_h2', 'seo_h3', 'image_title', 'image_alt') as $key) {
          if (!isset($value[$key])) {
            $value[$key] = '';
          }
        }
        
        if (empty($value['meta_title']) && $this->config->get('mlseo_insertautoseotitle')) {
          $value['meta_title'] = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_title_pattern'), $language_id, $data);
        }
        if (empty($value['meta_description']) && $this->config->get('mlseo_insertautometadesc')) {
          $value['meta_description'] = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_description_pattern'), $language_id, $data);
        }
        if (empty($value['meta_keyword']) && $this->config->get('mlseo_insertautometakeyword')) {
          $value['meta_keyword'] = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_keyword_pattern'), $language_id, $data);
        }
        if (empty($value['seo_h1']) && $this->config->get('mlseo_insertautoh1')) {
          $value['seo_h1'] = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_h1_pattern'), $language_id, $data);
        }
        if (empty($value['seo_h2']) && $this->config->get('mlseo_insertautoh2')) {
          $value['seo_h2'] = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_h2_pattern'), $language_id, $data);
        }
        if (empty($value['seo_h3']) && $this->config->get('mlseo_insertautoh3')) {
          $value['seo_h3'] = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_h3_pattern'), $language_id, $data);
        }
        if ($type == 'product') {
          if (empty($value['image_title']) && $this->config->get('mlseo_insertautoimgtitle')) {
            $value['image_title'] = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_image_title_pattern'), $language_id, $data);
          }
          if (empty($value['image_alt']) && $this->config->get('mlseo_insertautoimgalt')) {
            $value['image_alt'] = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_image_alt_pattern'), $language_id, $data);
          }
          
          $extra_fields .= ", image_alt = '" . $this->db->escape($value['image_alt']) . "', image_title = '" . $this->db->escape($value['image_title']) . "'";
        }
        // if (empty($value['tag']) && $this->config->get('mlseo_insertautotags')) {
          // $value['tag'] = $this->model_tool_seo_package->{'transform'.ucfirst($type)}($this->config->get('mlseo_'.$type.'_tag_pattern'), $language_id, $data);
        // }
        
        if (isset($value['description'])) {
          $extra_fields .= ", description = '" . $this->db->escape($value['description']) . "'";
        }
        
        if (isset($value['name'])) {
          $extra_fields .= ", name = '" . $this->db->escape($value['name']) . "'";
        }
        
        
        $this->db->query("INSERT INTO " . DB_PREFIX . "seo_".$this->db->escape($type)."_description SET ".$this->db->escape($type)."_id = '" . (int)$item_id . "', store_id = '" . (int)$store_id . "', language_id = '" . (int)$language_id . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "', seo_h1 = '" . $this->db->escape($value['seo_h1']) . "', seo_h2 = '" . $this->db->escape($value['seo_h2']) . "', seo_h3 = '" . $this->db->escape($value['seo_h3']) . "'" . $extra_fields);
      }
    }
  }
}