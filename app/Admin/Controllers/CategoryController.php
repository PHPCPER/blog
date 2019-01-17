<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CategoryListModel;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Tree;

class CategoryController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {
            $content->header('All categories');

            $content->body($this->tree());
        });
    }

    /**
     * Show interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Detail')
            ->description('description')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed   $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Edit')
            ->description('description')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a tree builder.
     *
     * @return tree
     */
    protected function tree()
    {
        $tree = new Tree(new CategoryListModel());
        $tree->branch(function ($branch) {

            return "{$branch['id']} - {$branch['category_name']}";

        });

        return $tree;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CategoryListModel);

        $form->display('id', 'ID');
        $form->select('parent_id')->options(CategoryListModel::selectOptions());

        $form->text('category_name')->rules('required');
        $form->text('category_alias')->rules('required');
        $form->textarea('description')->rules('required');
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        $form->tools(function ($tools) {
            // 去掉`删除`按钮
            $tools->disableDelete();

            // 去掉`查看`按钮
            $tools->disableView();
        });
        $form->footer(function ($footer) {
            
            // 去掉`查看`checkbox
            $footer->disableViewCheck();

            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();

        });
        return $form;
    }
}
