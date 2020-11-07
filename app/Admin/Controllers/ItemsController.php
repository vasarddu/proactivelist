<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Item;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ItemsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '词句';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Item());

        $grid->column('id', __('Id'));
        $grid->column('category.name', __('类目'));
        $grid->column('name', __('词语'));
        $grid->column('view_count', __('查看数'));
        $grid->column('created_at', __('创建日期'));

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });

        $grid->tools(function ($tools) {
            // 禁用批量删除按钮
            $tools->batch(function ($batch) {
                $batch->disableDelete();
            });
        });

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Item());
        // 添加一个类目字段，与之前类目管理类似，使用 Ajax 的方式来搜索添加
        $form->select('category_id', '类目')->options(function ($id) {
            $category = Category::find($id);
            if ($category) {
                return [$category->id => $category->name];
            }
        })->ajax('/admin/api/categories');
        $form->text('name', '词语')->rules('required');
        $form->textarea('description', '描述');
        $form->number('view_count', __('查看数'))->default(0);
        $form->radio('is_on', '开启')->options(['1' => '是', '0'=> '否'])->default('0');
        return $form;
    }
}
