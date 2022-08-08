<?php

class Secciones extends ActiveRecord
{
    public function getSecciones($page, $ppage=20){
        return $this->paginate("page: $page","per_page: $ppage","order: id desc");
    }
}