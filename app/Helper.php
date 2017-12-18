<?php


    function submenu($menu) {
        $res_content = '';
        //$q_item = Content::where('content_id', $content_id)->orderBy('order', 'asc')->get();
        if ($menu->submenus) {
            $res_content .= '<ul class="nav flex-column mx-3 rounded">';
            foreach ($menu->submenus()->orderBy('order', 'asc')->get() as $r_item) {
                $res_content .= '<li class="nav-item"><a class="nav-link" href="' . route('content', [$r_item->id]) . '">' . $r_item->name . '</a>';
                $res_content .= submenu($r_item);
                $res_content .= '</li>';
            }
            $res_content .= '</ul>';
        }

        return $res_content;
    };

    function breadcrumb($menu)
    {
        $res_content = '';

        if ($menu && $menu->parent) {
            $res_content .= breadcrumb($menu->parent);
            $res_content .= '<li class="breadcrumb-item">' . $menu->parent->name . '</li>';
        }

        return $res_content;
    }

