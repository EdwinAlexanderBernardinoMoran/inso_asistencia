<?php
    class Zonas extends ActiveRecord{
        public function getZonas($page,$ppege=20)
        {
            return $this->paginate("$page:page","per_pege:$ppage", 'order: id desc');
        }
    }