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
            $form->file('path','上传文件')->removable();

        });
    }
}
