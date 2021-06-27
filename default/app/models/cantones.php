<?php
    class Canton extends ActiveRecord{
        public function getCantones($page,$ppege=20)
        {
            return $this->paginate("$page: page","per_page: $ppage", 'order: id_canton desc');
        }
    }