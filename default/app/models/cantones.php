<?php
    class Cantones extends ActiveRecord{
<<<<<<< HEAD
        public function getCantones($page,$ppage=20)
        {
=======
        public function getCantones($page, $ppage=20){
>>>>>>> 636acfee468c71bc50e9b594fd6d10bdb4b2455d
            return $this->paginate("page: $page","per_page: $ppage", 'order: id desc');
        }
    }
?>