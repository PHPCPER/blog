<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use App\Models\CommentsModel;

class CommentController extends Controller
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
            ->header('评论')
            ->description('评论列表')
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
            ->header('评论展示')
            ->description('评论详情')
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
            ->header('评论修改')
            ->description('评论修改')
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
            ->header('增加评论')
            ->description('增加评论')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CommentsModel());

        $grid->id('ID')->sortable();
        $grid->user_name('评论人昵称');
        $grid->comment_content('评论内容');
        $grid->comment_love_count('点赞数量');
        $grid->status('是否禁用')->display(function ($isOfficial) {
            return $isOfficial == 'T' ? "<i class='fa fa-check' style='color:green'></i>" : "<i class='fa fa-close' style='color:red'></i>";
        });
        $grid->created_at('Created at');
        $grid->updated_at('Updated at');

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
        $show = new Show(CommentsModel::findOrFail($id));

        $show->id('ID')->sortable();
        $show->user_name('评论人昵称');
        $show->comment_content('评论内容');
        $show->comment_love_count('点赞数量');
        $show->status('是否禁用')->using(['0' => '禁用', '1' => '启用']);
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
        $form = new Form(new CommentsModel());
        $form->display('id', 'ID');
        $form->text('comment_content','评论内容');
        $form->number('comment_love_count','喜爱数量');
        $form->number('parent_comment_id','评论父级');
        $form->text('user_id','用户id');
        $form->text('user_name','用户昵称');
        $form->text('article_id','文章id');
        $form->switch('status', '发布？');
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');

        return $form;
    }
}
