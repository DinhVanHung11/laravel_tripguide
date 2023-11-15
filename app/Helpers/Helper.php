<?php

namespace App\Helpers;

class Helper
{
    public static function showStatus($status = 1)
    {
        return $status == 1
            ? '<span class="btn btn-success">Enabled</span>'
            : '<span class="btn btn-secondary" disabled>Disabled</span>';
    }

    public static function categoriesTableTree($categories, $parent_id = 0, $char = '')
    {
        $html = '';
        foreach ($categories as $key => $category) {
            if($category->parent_id == $parent_id){
                $html .= '
                    <tr>
                        <td>'.$category->id.'</td>
                        <td>'.$char.$category->name.'</td>
                        <td>'.$category->parent_id.'</td>
                        <td>'.$category->image.'</td>
                        <td>'.self::showStatus($category->status).'</td>
                        <td>
                            <a class="btn btn-secondary" href="'.route('admin.category.edit', $category->id).'"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a class="btn btn-danger" href="javascript:void(0)" onclick="deleteRow('. $category->id .', \'/admin/categories/delete\')">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                ';

                unset($categories[$key]);

                $html .= self::categoriesTableTree($categories, $category->id, '|__');
            }
        }

        return $html;
    }

    public static function categoriesSelectTree($categories, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($categories as $key => $category) {
            if($category['parent_id'] == $parent_id) {
                $html .= '
                    <option value="'.$category->id.'">'.$char.$category->name.'</option>
                ';

                unset($categories[$key]);

                $html .= self::categoriesSelectTree($categories, $category->id, '|__');
            }
        }

        return ($html);
    }

    public static function categoriesSelectedTree($categories, $categoryParent, $parent_id = 0, $char = '')
    {
        $html = '';

        foreach ($categories as $key => $category) {
            if($category['parent_id'] == $parent_id) {
                $html .= '
                    <option value="'.$category->id.'"
                ';

                if($category->id == $categoryParent){
                    $html .= 'selected';
                }

                $html .= '>'.$char.$category->name.'</option>';

                unset($categories[$key]);

                $html .= self::categoriesSelectedTree($categories, $categoryParent, $category->id, '|__');
            }
        }

        return ($html);
    }
}
