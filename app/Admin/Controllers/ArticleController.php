<?php
/**
 * Created by PhpStorm.
 * User: wang
 * Date: 2019/01/15
 * Time: 17:23
 */

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use App\Models\ArticleModel;
use App\Models\CategoryListModel;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use App\Models\LabelsModel;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ArticleController extends Controller
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
            ->description('文章列表')
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
            ->description('文章展示')
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
            ->description('修改文章')
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
            ->description('添加文章')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ArticleModel());

        $grid->id('ID')->sortable();
        $grid->article_title('文章标题');
        $grid->article_description('文章描述');
        $grid->labels('标签')->display(function ($labels) {
            $labels = array_map(function ($label) {
                return "<span class='label label-success'>{$label['category_name']}</span>";
            }, $labels);
            return join('&nbsp;', $labels);
        },'labels');
        $grid->article_view('文章浏览量')->display(function ($count) {
            return "<span class='label label-success'>{$count}</span>";
        });
        $grid->article_comment_count('文章评论数量')->display(function ($count) {
            return "<span class='label label-success'>{$count}</span>";
        });;
        $grid->status()->display(function($value){
            $arr = ['0' => '禁用', '1' => '启用'];
            return $arr[$value];
        });
        $grid->created_at('Created at');
        $grid->filter(function($filter){

            $filter->like('article_title', '文章标题');
            $filter->like('labels.category_name','标签');

        });
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
        $show = new Show(ArticleModel::findOrFail($id));

        $show->id('ID');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(){

        $form = new Form(new ArticleModel());

        $form->display('id', 'ID');
        $categoryListMod = new CategoryListModel();
        $info = $categoryListMod->getCategoryInfo();
        $form->select('category.category','文章分类')->options($info);
        $form->text('article_title','文章标题');
        $LabelsMod = new LabelsModel();
        $res = $LabelsMod->getLabelInfo();
        $form->multipleSelect('labels.label','标签')->options($res);
        $form->text('article_description','文章描述');
        $form->ueditor('article_content','文章内容');
        $form->text('user_id','用户名')->default(1);
        $form->display('created_at', 'Created At');
        $form->display('updated_at', 'Updated At');
        return $form;
    }
}
