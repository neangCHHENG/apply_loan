<?php

namespace App\Helper;

use \Exception;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/**
 * For menu crud operation , we use left & right tree based structure
 * For detail please check this :
 * 1. https://sararavi14.medium.com/nested-datasets-hierarchy-pattern-in-mysql-fbae95505709
 * 2. https://www.waitingforcode.com/mysql/managing-hierarchical-data-in-mysql-nested-set/read
 *
 */

class MenuHelper
{
    /**
     * Generate menu object by pre-filled some properties
     */
    public static function get_instance($menu_en, $menu_kh, $parent_id, $slug, $created_by = 'test_user',  $menu_type = 'test', $type = 'test', $link = '', $position = '', $reference_id = 0, $param1 = '', $param2 = '')
    {
        $menu = new \stdClass();
        $menu->menu_en = $menu_en;
        $menu->menu_kh = $menu_kh;
        $menu->parent_id = $parent_id;
        $menu->slug = $slug;
        $menu->menu_type = $menu_type;
        $menu->type = $type;
        $menu->link = $link;
        $menu->position = $position;
        $menu->reference_id = $reference_id;
        $menu->param1 = $param1;
        $menu->param2 = $param2;
        $menu->left = 0;
        $menu->right = 0;
        $menu->level = 0;
        $menu->state = 1;
        $menu->created_by = $created_by;
        return $menu;
    }
    /**
     *  get ( insert if not exist ) the root menu of specific menu type
     *
     */
    public static function root($type)
    {
        $sql = " SELECT * FROM menus WHERE is_root =1 AND type = '$type' ";
        $items =  DB::select($sql);
        if (count($items) > 0) {
            return $items[0];
        }
        $slug = rand(2, 50);
        $sql = " INSERT INTO menus(menu_kh, menu_en, parent_id, slug, `type`, `left`, `right`, `state`, `is_root` )
                 VALUES( 'ROOT', 'ROOT', 0, 'root-$slug', '$type' , 0, 1 , 1, 1) ";
        DB::update($sql);
        $sql = " SELECT * FROM menus WHERE is_root =1 AND `type` = '$type' ";
        $items =  DB::select($sql);
        if (count($items) > 0) {
            return $items[0];
        }
        return null;
    }

    /**
     * Helper function for query
     */

    private static function list_query($type, $limit, $offset, $search = '')
    {
        $sql = " SELECT * FROM menus WHERE is_root <> 1 AND type = '$type' ";
        if ($search == '') {
            $sql = $sql . "  AND ( menu_en LIKE  '%$search%' OR menu_kh LIKE '%$search%' ) ";
        }
        $sql = $sql . " ORDER BY `left` ASC ";
        return $sql;
    }
    /**
     * List of menu by type with limit & offset
     */
    public static function list($type, $limit = 10, $offset = 0, $search = '')
    {
        $sql = self::list_query($type, $limit, $offset, $search);
        $sql = $sql . " LIMIT $limit OFFSET $offset ";
        $items  = DB::select($sql);
        return $items;
    }

    /**
     * count all menu by type
     */
    public static function count($type, $limit, $offset, $search = '')
    {
        $sql = self::list_query($type, $limit, $offset, $search);
        $sql = " SELECT COUNT(*) total FROM ( $sql) ";
        $items = DB::select($sql);
        if (count($items) > 0) {
            return $items[0]->total;
        }
        return 0;
    }
    /**
     * get menu by id
     */

    public static function get_by_id($id)
    {
        $sql = " SELECT * FROM menus WHERE id = $id ";
        $menus = DB::select($sql);
        if (count($menus) > 0) {
            return $menus[0];
        }
        return null;
    }

    /**
     * insert menu by object of stdClass
     */
    public static function insert($menu)
    {
        $parent_id = $menu->parent_id;
        $parent = self::get_by_id($parent_id);
        if ($parent == null) {
            throw new Exception('Could not find parent for id ' . $parent_id);
        }
        $menu->left = $parent->right;
        $menu->right = $parent->right + 1;
        $menu->level = $parent->level + 1;
        $sql_update_right = " UPDATE menus SET `right` = `right` + 2 WHERE `right` >= $parent->right  AND `type` = '$menu->type' ";
        DB::update($sql_update_right);
        $sql_update_left = " UPDATE menus SET `left` = `left` + 2 WHERE `left` > $parent->right  AND `type` = '$menu->type' ";
        DB::update($sql_update_left);
        $sql = " INSERT INTO menus(parent_id , menu_kh, menu_en, slug, menu_type, position, link, `state`, `left`, `right`, `is_root`,
                    `created_at` ,`created_by` , `level`, `reference_id`, `param1`, `param2` ,`type` )
                     VALUES( ?, ?, ? , ? , ? , ? , ?, ? , ? , ? , ? , NOW() , ? , ?, ? , ? , ?  , ?  ) ";
        $p = [
            $menu->parent_id, $menu->menu_kh, $menu->menu_en, $menu->slug, $menu->menu_type, $menu->position, $menu->link,
            $menu->state, $menu->left, $menu->right, 0, $menu->created_by, $menu->level, $menu->reference_id,
            $menu->param1, $menu->param2, $menu->type
        ];
        DB::insert($sql, $p);
    }

    /**
     * delete menu and its children
     */
    public static function delete($id)
    {
        $menu = self::get_by_id($id);
        if (is_null($menu)) return;

        $sql = "UPDATE menus SET state = 0 WHERE id=$id";
        DB::update($sql);
    }
    // public static function delete($id)
    // {
    //     $menu =  self::get_by_id($id);
    //     if (is_null($menu)) return;
    //     if ($menu->is_root == 1) {
    //         throw new Exception("Deleting root menu is not allowed !");
    //     }
    //     $sql = " DELETE FROM menus WHERE `left` >= $menu->left AND `right` <= $menu->right ";
    //     DB::delete($sql);
    //     $diff =  $menu->right - $menu->left;
    //     $diff++;
    //     $sql = " UPDATE menus SET `right` = `right` - $diff WHERE `right` >= $menu->right ";
    //     DB::update($sql);
    // }
    /**
     * Update menu and check if its parent change , update and cascade all levels under it.
     */

    public static function update($menu)
    {
        $existing  = self::get_by_id($menu->id);
        if ($existing == null) {
            throw new Exception('Could not find menu for id ' . $menu->id);
        }
        $parent = self::get_by_id($menu->parent_id);
        if ($parent == null) {
            throw new Exception('Could not find parent for id ' . $menu->parent_id);
        }

        if ($existing->parent_id != $menu->parent_id) {
            //change parent id
            $tree_size = $existing->right - $existing->left;
            $tree_size++;
            $current_level = $existing->level;
            $current_level--;
            //  var_dump($current_level);
            //  var_dump($tree_size);
            //  var_dump($existing);
            //  var_dump($parent);
            // exit;
            $sql = " UPDATE menus SET `state` = -1 ,`level` = `level` - $current_level ,
                `left` = `left` - $existing->left , `right` = `right`- $existing->left
                  WHERE `left` >= $existing->left AND `right` <= $existing->right AND `type` = '$menu->type' ";
            //var_dump($sql);
            DB::update($sql);
            $sql = " UPDATE menus SET `left` = `left` - $tree_size  , `right` = `right` - $tree_size  WHERE `left` > $existing->right  AND `type` = '$menu->type' ";
            //var_dump( $sql );
            DB::update($sql);
            $sql = " UPDATE menus SET `right`= `right` - $tree_size WHERE `right` > $existing->right AND `left` < $existing->left  AND `type` = '$menu->type' ";
            //var_dump( $sql);
            DB::update($sql);
            $parent = self::get_by_id($menu->parent_id);
            //add back
            $sql = " UPDATE menus SET `left` = `left` + $tree_size , `right` = `right` + $tree_size  WHERE `left` > $parent->right AND `type` = '$menu->type' ";
            //var_dump($sql);
            DB::update($sql);
            $sql = " UPDATE menus SET `right`= `right` + $tree_size WHERE `right` >= $parent->right  and `left` < $parent->right  AND `type` = '$menu->type' ";
            //var_dump($sql);
            DB::update($sql);
            $new_left = $parent->right;
            $parent_level = $parent->level;
            $sql = " UPDATE menus SET `state`= 1 , `left`= `left` + $new_left ,
                `right` = `right` + $new_left,
                `level` = `level` + $parent_level
                 WHERE `state` = -1 ";
            DB::update($sql);
            //var_dump($sql);
            // //echo "tree size :$tree_size <br/>";

            // //update new parent size for inserting it
            // $sql = " UPDATE menus SET `right` = `right` +  $tree_size  WHERE  `right` >= $parent->right AND `type` = '$menu->type' ";
            // // echo $sql." <br/>";
            // DB::update($sql);
            // $sql = " UPDATE menus SET `left` = `left` + $tree_size WHERE `left` > $parent->right  AND `type` = '$menu->type' ";
            // //   echo $sql."<br/>";
            // DB::update($sql);
            // $existing = self::get_by_id($menu->id); //get it again as its left & right are updated
            // $left_diff = $parent->right - $existing->left;
            // $level_diff = $parent->level - $existing->level;
            // $sql = " UPDATE menus SET `left` = `left` + $left_diff , `right` = `right` + $left_diff,
            //         `level` = `level` + $level_diff
            //          WHERE `left` >= $existing->left AND `right` <= $existing->right AND `type` = '$menu->type' ";
            // DB::update($sql);
            // $old_parent = self::get_by_id($existing->parent_id);
            // $sql = " UPDATE menus SET `left` = `left` - $tree_size WHERE `left` > $old_parent->right  AND `type` = '$menu->type' ";
            // DB::update($sql);
            // $sql = " UPDATE menus SET `right` = `right` - $tree_size WHERE `right` >= $old_parent->right AND `type` = '$menu->type' ";
            // DB::update($sql);
        }

        $parent = self::get_by_id($menu->parent_id);
        $sql = " UPDATE menus SET parent_id = ? , `level`= ? , menu_en = ? , slug = ? , menu_kh = ? , updated_by =? , updated_at = NOW() ,
             type = ? , menu_type = ? , link =? ,  position = ? , reference_id = ? , param1=? , param2= ? WHERE id = ? ";
        $p = [
            $menu->parent_id, $parent->level + 1,  $menu->menu_en, $menu->slug, $menu->menu_kh, $menu->updated_by, $menu->type, $menu->menu_type,
            $menu->link, $menu->position, $menu->reference_id, $menu->param1, $menu->param2, $menu->id
        ];
        DB::update($sql, $p);
        //  var_dump( $sql);
        // exit;
    }

    /**
     * List all menus by menu type
     *
     */

    public static function all_menu_by_type($type)
    {
        $sql = " SELECT  * FROM menus WHERE `type` = '$type' AND is_root <> 1 AND state =1 ORDER BY `left` ";
        $items = DB::select($sql);
        if (count($items) == 0) {
            return $items;
        }
        for ($i = 0; $i < count($items) - 1; $i++) {
            $item = $items[$i];
            //$item->level_diff = $item->level;
            $next_item = $items[$i + 1];
            $item->deeper = $next_item->level > $item->level;
            $item->shallower = $next_item->level < $item->level;
            $item->level_diff = abs($next_item->level - $item->level);
        }
        $last = $items[count($items) - 1];
        $last->shallower = $last->level > 1;
        $last->deeper = false;
        $last->level_diff = abs($last->level - 1);
        return $items;
    }

    /**

     * Render menus
     */
    public static function render($menus)
    {
        $str = "<ul>";
        foreach ($menus as $i => $item) {
            $str = $str . "<li> <a href='#'> " . $item->menu_en . "</a>";
            if ($item->deeper) {
                $str = $str . "<ul class='deeper'>";
            } elseif ($item->shallower) {
                $str = $str . "</li>";
                $str = $str . str_repeat("</ul></li>", $item->level_diff);
            } else {
                $str = $str . "</li>";
            }
        }
        $str = $str . "</ul>";
        return $str;
    }

    /**

     * Get elegible parents for the menus
     */

    public static function eligbile_parents($type, $menu_id = 0)
    {
        $root = self::root($type); //generate root for the menu if not exist
        $sql = " SELECT * FROM menus WHERE `type` = '$type' ";
        if ($menu_id != 0) {
            $menu = self::get_by_id($menu_id);
            if ($menu != null) {
                $sql = $sql . " AND (  `left` < $menu->left  OR `left` > $menu->right  ) ";
                //to prevent himself to his own parent plus his children
            }
        }
        return DB::select($sql);
    }

    /**
     * List all info by info key
     *
     */

    public static function all_info_by_key($key)
    {
        $sql = " SELECT  * FROM infos WHERE `key` = '$key' AND state =1 ORDER BY `left` ";
        $items = DB::select($sql);
        // for ($i = 0; $i < count($items) - 1; $i++) {
        //     $item = $items[$i];
        //     //$item->level_diff = $item->level;
        //     $next_item = $items[$i + 1];

        // }
        // $last = $items[count($items) - 1];
        return $items;
    }

    public static function renderInfos($key)
    {
        $str = "";
        foreach ($key as $item) {
            $str = $str . " <h4>$item->key</h4><ul> <li><i class='fa-solid fa-phone'></i>  $item->value </li>";
        }
        $str = $str . "</ul>";
        return $str;
    }
}
