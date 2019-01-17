<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\LabelsModel;

class LabelsController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Index')
            ->description('标签列表')
            ->body($this->grid());
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
            ->description('标签详情')
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
            ->description('标签修改')
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
            ->description('增加标签')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new LabelsModel());

        $grid->id('ID')->sortable();
        $grid->category_name('标签名称');
        $grid->category_alias('标签别名');
        $grid->description('便签描述');
        $grid->created_at('Created at');
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(LabelsModel::findOrFail($id));

        $show->id('ID');
        $show->category_name('标签名称');
        $show->category_alias('标签别名');
        $show->description('便签描述');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new LabelsModel());

        $form->display('id', 'ID');
        $form->text('category_name','标签名称');
        $form->text('category_alias','标签别称');
        $form->text('description','标签描述');
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

        return $form;
    }

    /**
     * 软删除
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $moduleMod = LabelsModel::findOrFail($id);
        $moduleMod->delete();
        if($moduleMod->trashed()){
            return response()->json([
                'status'  => true,
                'message' => '删除成功 !',
            ]);
        }else{
            return response()->json([
                'status'  => false,
                'message' => '删除失败 !',
            ]);
        }
    }
}
