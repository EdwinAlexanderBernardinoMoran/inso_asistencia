<?php
    class Cantones extends ActiveRecord{
        public function getcantones($page, $ppage=20){
            return $this->paginate("page: $page","per_page: $ppage", 'order: id desc');
        }
    }
?>