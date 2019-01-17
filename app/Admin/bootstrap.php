<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for admin.
 *
 * Here you can remove builtin form field:
 * Encore\admin\form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\admin\form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * admin::css('/packages/prettydocs/css/styles.css');
 * admin::js('/packages/prettydocs/js/main.js');
 *
 */
use App\Admin\Extensions\Form\uEditor;
use Encore\Admin\Form;

Encore\Admin\Form::forget(['map', 'editor']);
//富文本编辑器
Form::extend('ueditor', uEditor::class);
