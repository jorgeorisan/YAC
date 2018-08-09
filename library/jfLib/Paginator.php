<?php
    class jfLib_Paginator extends Doctrine_Pager_Layout
{
    public function display($options = array(), $return = false)
    {
        $pager = $this->getPager();
        $str = '';

        // First page
        $this->addMaskReplacement('page', 'Inicio', true);
        $options['page_number'] = $pager->getFirstPage();
        $this->setSelectedTemplate('<span class="disabled_tnt_pagination">{%page}</span>');
        $str .= $this->processPage($options);

        // Previous page
        $this->addMaskReplacement('page', 'Anterior', true);
        $options['page_number'] = $pager->getPreviousPage();
        $this->setSelectedTemplate('<span class="disabled_tnt_pagination">{%page}</span>');
        $str .= $this->processPage($options);

        // Pages listing
        $this->removeMaskReplacement('page');
        $this->setSelectedTemplate('<span class="active_tnt_link">{%page}</span>');
        $str .= parent::display($options, true);

        // Next page
        $this->addMaskReplacement('page', 'Siguiente', true);
        $options['page_number'] = $pager->getNextPage();
        $this->setSelectedTemplate('<span class="disabled_tnt_pagination">{%page}</span>');
        $str .= $this->processPage($options);

        // Last page
        $this->addMaskReplacement('page', 'Fin', true);
        $options['page_number'] = $pager->getLastPage();
        $this->setSelectedTemplate('<span class="disabled_tnt_pagination">{%page}</span>');
        $str .= $this->processPage($options);

        // Possible wish to return value instead of print it on screen
        if ($return) {
            return $str;
        }

        echo $str;
    }
}
