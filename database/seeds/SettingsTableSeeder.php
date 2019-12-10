<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('Settings')->insert([
            [
                'key' => 'default_language',
                'value' => 'ar',
                'LinkedID' => '',
                'LinkedDes' => '',
            ], [
                'key' => 'status',
                'value' => 'open',
                'LinkedID' => '',
                'LinkedDes' => '',
            ], [
                'key' => 'status_msg',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'title',
                'value' => 'أتومبيل',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'description',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'keywords',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'email',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'phone',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'mobile',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'fax',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'hotLine',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'supportLine',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'facebook',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'twitter',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'whatsApp',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'skype',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'google',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'instagram',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'youtube',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'linkedin',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'pinterest',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'behance',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'rss',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'map',
                'value' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3418.8465675641983!2d31.37655671451768!3d31.030524178271637!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14f79d75290d319b%3A0x1fa0c5c9fc92cad0!2sTechno+Egypt+Software+Company+Web+Design!5e0!3m2!1sen!2seg!4v1530084630223"
                        frameborder="0" allowfullscreen></iframe>',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'address',
                'value' => 'المنصورة - ش. السلكاوى عمارة ثروت خلف سنترال غرب المنصورة مباشرة ,المنصورة -الدقهلية',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'lat',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'lng',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'logo',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'web',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'header',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'fav',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'socialPhoto',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'home_slider',
                'value' => '1',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'home_slider_category',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'footer_image',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'logo_text',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'powered_text',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'partner_1',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'partner_1_link',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'partner_2',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'partner_2_link',
                'value' => '',
                'LinkedID' => '',
                'LinkedDes' => '',
            ], [
                'key' => 'copyrights',
                'value' => 'جميع الحقوق محفوظه تكنو مصر للبرمجيات © 2018',
                'LinkedID' => '',
                'LinkedDes' => '',
            ], [
                'key' => 'contactAlert',
                'value' => 'تم إرسال رسالتك بنجاح سيتم التواصل معك قريباً',
                'LinkedID' => '',
                'LinkedDes' => '',
            ],
            [
                'key' => 'about_footer',
                'value' => 'هناك حقيقة مثبتة منذ زمن طويل وهي أن المحتوى المقروء لصفحة ما سيلهي القارئ عن التركيز على الشكل الخارجي للنص أو شكل توضع الفقرات في الصفحة التي يقرأها. ولذلك يتم استخدام طريقة لوريم إيبسوم لأنها تعطي توزيعاَ طبيعياَ -إلى حد ما- للأحرف عوضاً عن استخدام "هنا يوجد محتوى نصي، هنا يوجد محتوى نصي" فتجعلها تبدو (أي الأحرف) وكأنها نص مقروء. العديد من برامح النشر المكتبي وبرامح تحرير صفحات الويب تستخدم لوريم إيبسوم بشكل إفتراضي كنموذج عن النص، وإذا قمت بإدخال "lorem ipsum" في أي محرك بحث ستظهر العديد من المواقع الحديثة العهد في نتائج البحث. على مدى السنين ظهرت نسخ جديدة ومختلفة من نص لوريم إيبسوم، أحياناً عن طريق الصدفة، وأحياناً عن عمد كإدخال بعض العبارات الفكاهية إليها.',
                'LinkedID'=>'',
                'LinkedDes' => '',
            ],
            [
                'key' => 'notification_email',
                'value' => 'info@specialNeedsAcademy.com',
                'LinkedID'=>'',
                'LinkedDes' => '',
            ],
            [
                'key' => 'notification_status',
                'value' => 'both',
                'LinkedID'=>'',
                'LinkedDes' => '',
            ],
            [
                'key' => 'messages_email',
                'value' => 'support@academy.com',
                'LinkedID'=>'',
                'LinkedDes' => '',
            ],
        ]);
    }
}
