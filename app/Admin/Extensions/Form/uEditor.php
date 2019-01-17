<?php
/**
 * Created by PhpStorm.
 * User: zhumingzhen
 * Email: z@it1.me
 * Date: 2018/5/10
 * Time: 22:44
 */
namespace App\Admin\Extensions\Form;
use Encore\Admin\Form\Field;

/**
 * 百度编辑器
 * Class uEditor
 * @package App\admin\Extensions\form
 */
class uEditor extends Field
{
    // 定义视图
    protected $view = 'admin.uEditor';

    // css资源
    protected static $css = [];

    // js资源
    protected static $js = [
        'laravel-u-editor/ueditor.config.js',
        'laravel-u-editor/ueditor.all.min.js',
        'laravel-u-editor/lang/zh-cn/zh-cn.js'
    ];

    public function render()
    {
        $this->script = <<<EOT
        //解决第二次进入加载不出来的问题
        UE.delEditor("ueditor");
        // 默认id是ueditor
        var ue = UE.getEditor('ueditor', {
            // 自定义工具栏
            toolbars: [
                ['fullscreen', 'source', '|', 'undo', 'redo', '|',
            'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'superscript', 'subscript', 'removeformat', 'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|', 'forecolor', 'backcolor', 'insertorderedlist', 'insertunorderedlist', 'selectall', 'cleardoc', '|',
            'rowspacingtop', 'rowspacingbottom', 'lineheight', '|',
            'customstyle', 'paragraph', 'fontfamily', 'fontsize', '|',
            'directionalityltr', 'directionalityrtl', 'indent', '|',
            'justifyleft', 'justifycenter', 'justifyright', 'justifyjustify', '|', 'touppercase', 'tolowercase', '|',
            'link', 'unlink', 'anchor', '|', 'imagenone', 'imageleft', 'imageright', 'imagecenter', '|',
            'simpleupload', 'insertimage', 'emotion', 'scrawl', 'insertvideo', 'music', 'attachment', 'map', 'gmap', 'insertframe', 'insertcode', 'webapp', 'pagebreak', 'template', 'background', '|',
            'horizontal', 'date', 'time', 'spechars', 'snapscreen', 'wordimage', '|',
            'inserttable', 'deletetable', 'insertparagraphbeforetable', 'insertrow', 'deleterow', 'insertcol', 'deletecol', 'mergecells', 'mergeright', 'mergedown', 'splittocells', 'splittorows', 'splittocols', 'charts', '|',
            'print', 'preview', 'searchreplace', 'drafts', 'help']
            ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode: true,
            wordCount: false,
            imagePopup: false,
            autotypeset: {indent: true, imageBlockLine: 'center'}
        }); 
        ue.ready(function () {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
        });

EOT;
        return parent::render();
    }
}
