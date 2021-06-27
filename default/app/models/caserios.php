<?php 

    class Caserios extends ActiveRecord{
        public function getCaserios($page, $ppage=20)
        {
            return $this->paginate("page: $page", "per_page: $ppage", 'order: id_caserio desc');
        }
    }
?>