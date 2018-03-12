<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Game;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class GameController extends Controller
{
    use ModelForm;


    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('游戏');
            $content->description('游戏后台管理');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('游戏');
            $content->description('修改游戏');

//            dd($this->form()->edit($id));
            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('游戏');
            $content->description('添加游戏');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Game::class, function (Grid $grid) {
            $grid->id('ID')->sortable();

            $grid->column('name','游戏名');
            $grid->column('path','路径');
            $grid->category()->name('分类');
            $grid->column('price','原价')->sortable();
            $grid->column('discount_price', '折扣价')->sortable();
            $grid->column('issue_date', '上架日期')->sortable();
//            $grid->created_at('创建时间');
            $grid->updated_at('更新时间');

            $grid->filter(function($filter){
                // 去掉默认的id过滤器
                $filter->disableIdFilter();
                // 在这里添加字段过滤器
                $filter->like('name', '游戏名称');
                $filter->equal('category_id','游戏分类')->select(Category::all()->pluck('name','id'));
                $filter->between('price', '原价');
                $filter->between('discount_price', '折扣价');
                $filter->between('issue_date', '上架时间')->datetime();
            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Game::class, function (Form $form) {
            $form->text('name','游戏名')
                ->rules('required|min:1|max:20',[
                    'required'=>'游戏名不能为空',
                    'min'=> '游戏名最少应有1个字符',
                    'max' => '游戏名最多只能有20个字符'
                ]);

            //修复没有默认值问题
            $form->select('category_id','分类')
                ->options(Category::all()->pluck('name','id'))
                ->rules('required',['required'=>'游戏分类不能为空！']);

            $form->currency('price','价格')->symbol('￥')->default(0)->rules('required',['required'=>'价格不能为空！']);
            $form->currency('discount_price','折扣价')->symbol('￥')->default(0)->rules(['required'=> '价格不能为空！']);
            $form->datetime('issue_date','发售日期')->default(now());
            $form->textarea('description','游戏描述')->rows(8);


            $form->image('background_image','游戏背景图片')->removable();
            $form->image('image','游戏图标')->removable();
            $form->multipleImage('images','游戏截图')->removable();

            $form->file('path','上传游戏文件')->removable();
        });
    }
}
