<?php
    class Cantones extends ActiveRecord{
        public function getCantones($page,$ppage=20)
        {
<<<<<<< HEAD
            return $this->paginate("page:$page","per_page: $ppage", 'order: id desc');
=======
            return $this->paginate("page: $page","per_page: $ppage", 'order: id desc');
>>>>>>> 221036cc81c45d608ebea8598290748db18e1223
        }
    }
?>