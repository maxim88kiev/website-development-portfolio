<?php defined('_JEXEC') or die;

jimport('components.com_lasercity.helpers.ip', JPATH_BASE);

class lasercityViewcabinet_add_affiliate extends JViewLegacy
{
    public $item = null;
    public $countView = 0;

    function display($tpl = null)
    {
        $this->item = $this->get('Item');
        //exit(var_dump($this->item));
        /*$id = $this->item->id;
        lastVisit('cabinet_add_affiliate', $this->item->id);

        $db = JFactory::getDbo();
        $this->countView = $db->setQuery("SELECT COUNT(*) FROM `#__lasercity_last_visit` WHERE `object_type`='affiliate' AND `object_id`={$id} AND DATE(`last_visit`) = CURDATE()")->loadResult();

        $params = OpenGraph::loadParams('cabinet_add_affiliate', $this->item->id);
        OpenGraph::autoSet($params);*/

        
        JFactory::getDocument()->setTitle($this->item->title);
        JFactory::getDocument()->setDescription($this->item->head_description);
        return parent::display($tpl);
    }
    

}
