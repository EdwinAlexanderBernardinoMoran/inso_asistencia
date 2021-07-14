<?php
    class Zonas extends ActiveRecord{
        public function getzonas($page,$ppage=20)
        {
            return $this->paginate("page: $page","per_page: $ppage", 'order: id desc');
        }
    }
?>