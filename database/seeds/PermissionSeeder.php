<?php

use App\permission;
use App\role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manage_user = role::create(['name' => 'manage_user', 'label' => 'مدیریت کاربران']);
        $manage_permission = role::create(['name' => 'manage_permission', 'label' => 'مدیریت دسترسی ها']);
        $manage_roles = role::create(['name' => 'manage_roles', 'label' => 'مدیریت مقام ها']);
        $manage_category = role::create(['name' => 'manage_category', 'label' => 'مدیریت دسته بندی ها  ']);
        $manage_product = role::create(['name' => 'manage_product', 'label' => 'مدیریت محصولات']);
        $manage_gallery = role::create(['name' => 'manage_gallery', 'label' => 'مدیریت گالری']);
        $manage_comment = role::create(['name' => 'manage_comment', 'label' => 'مدیریت نظرات']);
        $manage_article = role::create(['name' => 'manage_article', 'label' => 'مدیریت مقالات']);
        $manage_slider = role::create(['name' => 'manage_slider', 'label' => 'مدیریت اسلایدر']);
        $manage_contact = role::create(['name' => 'manage_contact', 'label' => 'مدیریت تماس با ما']);
        $manage_discount = role::create(['name' => 'manage_discount', 'label' => 'مدیریت تخفیفات']);
        $manage_order = role::create(['name' => 'manage_order', 'label' => 'مدیریت سفارشات']);
        $option = role::create(['name' => 'option', 'label' => 'تنظیمات ']);
        $manage_company = role::create(['name' => 'manage_company', 'label' => 'مدیریت شرکت ها']);
        $manage_partner = role::create(['name' => 'manage_partner', 'label' => 'مدیریت همکاران']);

        ////////////////////////////////////////////////////////////////////////////////////////

        $show_user = permission::create(['name' => 'show_user', 'label' => 'مشاهده کاربران']);
        $show_admin = permission::create(['name' => 'show_admin', 'label' => 'مشاهده مدیران']);
        $create_user = permission::create(['name' => 'create_user', 'label' => 'ایجاد کاربر']);
        $update_user = permission::create(['name' => 'update_user', 'label' => 'ویرایش کاربر']);
        $delete_user = permission::create(['name' => 'delete_user', 'label' => 'حذف کاربر']);
        $permission_user = permission::create(['name' => 'permission_user', 'label' => 'اعمال دسترسی کاربران']);

        $manage_user->permissions()->sync([$show_admin->id, $create_user->id, $update_user->id, $delete_user->id, $permission_user->id, $show_user->id]);

        $show_permission = permission::create(['name' => 'show_permission', 'label' => 'مشاهده دسترسی']);
        $create_permission = permission::create(['name' => 'create_permission', 'label' => 'ایجاد دسترسی']);
        $update_permission = permission::create(['name' => 'update_permission', 'label' => 'ویرایش دسترسی']);
        $delete_permission = permission::create(['name' => 'delete_permission', 'label' => 'حذف دسترسی']);

        $manage_permission->permissions()->sync([$create_permission->id, $update_permission->id, $delete_permission->id, $show_permission->id]);

        $show_role = permission::create(['name' => 'show_role', 'label' => 'مشاهده مقام']);
        $create_role = permission::create(['name' => 'create_role', 'label' => 'ایجاد مقام']);
        $update_role = permission::create(['name' => 'update_role', 'label' => 'ویرایش مقام']);
        $delete_role = permission::create(['name' => 'delete_role', 'label' => 'حذف مقام']);

        $manage_roles->permissions()->sync([$show_role->id, $create_role->id, $update_role->id, $delete_role->id]);

        $show_category = permission::create(['name' => 'show_category', 'label' => 'مشاهده دسته بندی']);
        $create_category = permission::create(['name' => 'create_category', 'label' => 'ایجاد دسته بندی']);
        $update_category = permission::create(['name' => 'update_category', 'label' => 'ویرایش دسته بندی']);
        $delete_category = permission::create(['name' => 'delete_category', 'label' => 'حذف دسته بندی']);

        $manage_category->permissions()->sync([$show_category->id, $create_category->id, $update_category->id, $delete_category->id]);

        $show_product = permission::create(['name' => 'show_product', 'label' => 'مشاهده محصولات']);
        $create_product = permission::create(['name' => 'create_product', 'label' => 'ایجاد محصولات']);
        $update_product = permission::create(['name' => 'update_product', 'label' => 'ویرایش محصولات']);
        $delete_product = permission::create(['name' => 'delete_product', 'label' => 'حذف محصولات']);

        $manage_product->permissions()->sync([$show_product->id, $create_product->id, $update_product->id, $delete_product->id]);

        $show_gallery = permission::create(['name' => 'show_gallery', 'label' => 'مشاهده گالری']);
        $create_gallery = permission::create(['name' => 'create_gallery', 'label' => 'ایجاد گالری']);
        $update_gallery = permission::create(['name' => 'update_gallery', 'label' => 'ویرایش گالری']);
        $delete_gallery = permission::create(['name' => 'delete_gallery', 'label' => 'حذف گالری']);

        $manage_gallery->permissions()->sync([$show_gallery->id, $create_gallery->id, $update_gallery->id, $delete_gallery->id]);

        $show_comment = permission::create(['name' => 'show_comment', 'label' => 'مشاهده نظرات']);
        $update_comment = permission::create(['name' => 'update_comment', 'label' => 'پاسخگویی به نظرات ']);
        $delete_comment = permission::create(['name' => 'delete_comment', 'label' => 'حذف نظرات ']);

        $manage_comment->permissions()->sync([$show_comment->id, $update_comment->id, $delete_comment->id]);

        $show_article = permission::create(['name' => 'show_article', 'label' => 'مشاهده مقاله']);
        $create_article = permission::create(['name' => 'create_article', 'label' => 'ایجاد مقاله']);
        $update_article = permission::create(['name' => 'update_article', 'label' => 'ویرایش مقاله']);
        $delete_article = permission::create(['name' => 'delete_article', 'label' => 'حذف مقاله']);
        $show_categroy_article = permission::create(['name' => 'show_categroy_article', 'label' => 'مشاهده دسته بندی مقاله']);
        $create_categroy_article = permission::create(['name' => 'create_categroy_article', 'label' => 'ایجاد دسته بندی مقاله']);
        $update_categroy_article = permission::create(['name' => 'update_categroy_article', 'label' => 'ویرایش دسته بندی مقاله']);
        $delete_categroy_article = permission::create(['name' => 'delete_categroy_article', 'label' => 'حذف دسته بندی مقاله']);

        $manage_article->permissions()->sync([$show_article->id, $create_article->id, $update_article->id, $delete_article->id,
            $show_categroy_article->id, $create_categroy_article->id, $update_categroy_article->id, $delete_categroy_article->id]);


        $show_slider = permission::create(['name' => 'show_slider', 'label' => 'مشاهده اسلایدر']);
        $create_slider = permission::create(['name' => 'create_slider', 'label' => 'ایجاد اسلایدر']);
        $update_slider = permission::create(['name' => 'update_slider', 'label' => 'ویرایش اسلایدر']);
        $delete_slider = permission::create(['name' => 'delete_slider', 'label' => 'حذف اسلایدر']);

        $manage_slider->permissions()->sync([$show_slider->id, $create_slider->id, $update_slider->id, $delete_slider->id]);


        $show_contact = permission::create(['name' => 'show_slider', 'label' => 'مشاهده تماس با ما']);
        $seen_contact = permission::create(['name' => 'update_contact', 'label' => 'تایید دیده خوانده شده تماس با ما ']);
        $delete_contact = permission::create(['name' => 'delete_contact', 'label' => 'حذف تماس با ما ']);
        $send_email = permission::create(['name' => 'send_email', 'label' => ' ارسال ایمیل']);

        $manage_contact->permissions()->sync([$show_contact->id, $seen_contact->id, $delete_contact->id, $send_email->id]);

        $show_discount = permission::create(['name' => 'show_discount', 'label' => 'مشاهده تخفیف']);
        $create_discount = permission::create(['name' => 'create_discount', 'label' => 'ایجاد تخفیف']);
        $update_discount = permission::create(['name' => 'update_discount', 'label' => 'ویرایش تخفیف']);
        $delete_discount = permission::create(['name' => 'delete_discount', 'label' => 'حذف تخفیف']);

        $manage_discount->permissions()->sync([$show_discount->id, $create_discount->id, $update_discount->id, $delete_discount->id]);

        $show_order = permission::create(['name' => 'show_order', 'label' => 'مشاهده سفارشات']);
        $unpaid = permission::create(['name' => 'unpaid', 'label' => 'مشاهده سفارشات پرداخت نشده']);
        $paid = permission::create(['name' => 'paid', 'label' => 'مشاهده سفارشات پرداخت شده']);
        $prepartion = permission::create(['name' => 'prepartion', 'label' => 'مشاهده سفارشات در حال پردازش ']);
        $posted = permission::create(['name' => 'posted', 'label' => 'مشاهده سفارشات پست شده ']);
        $recived = permission::create(['name' => 'recived', 'label' => 'مشاهده سفارشات  دریافت شده ']);
        $cancel = permission::create(['name' => 'cancel', 'label' => 'مشاهده سفارشات   کنسلی ']);
        $product_order = permission::create(['name' => 'product_order', 'label' => 'مشاهده کالا های سفارش ']);
        $delete_order = permission::create(['name' => 'delete_order', 'label' => 'حذف سفارش ']);
        $cancel_order = permission::create(['name' => 'cancel_order', 'label' => 'توانایی کنسل کردن سفارش ']);

        $manage_order->permissions()->sync([$show_order->id, $unpaid->id, $paid->id, $prepartion->id, $posted->id, $recived->id, $cancel->id, $product_order->id, $delete_order->id, $cancel_order->id]);


        $show_option = permission::create(['name' => 'show_option', 'label' => ' مشاهده تنظیمات']);

        $option->permissions()->sync([$show_option->id]);

        $show_company = permission::create(['name' => 'show_company', 'label' => 'مشاهده شرکت']);
        $create_company = permission::create(['name' => 'create_company', 'label' => 'ایجاد شرکت']);
        $update_company = permission::create(['name' => 'update_company', 'label' => 'ویرایش شرکت']);
        $delete_company = permission::create(['name' => 'delete_company', 'label' => 'حذف شرکت']);

        $manage_company->permissions()->sync([$show_company->id, $create_company->id, $update_company->id, $delete_company->id]);

        $show_partner = permission::create(['name' => 'show_partner', 'label' => 'مشاهده همکاران']);
        $create_partner = permission::create(['name' => 'create_partner', 'label' => 'ایجاد همکاران']);
        $update_partner = permission::create(['name' => 'update_partner', 'label' => 'ویرایش همکاران']);
        $delete_partner = permission::create(['name' => 'delete_partner', 'label' => 'حذف همکاران']);

        $manage_partner->permissions()->sync([$show_partner->id, $create_partner->id, $update_partner->id, $delete_partner->id]);
    }
}
