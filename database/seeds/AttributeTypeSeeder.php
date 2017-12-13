<?php

use Illuminate\Database\Seeder;

class AttributeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'name'=>'email','validation_pattern'=>"email",
                'html_attributes'=>[
                    'input-type'=>'email',
                    'element-type'=>'input'
                ]
            ],
            [
                'name'=>'address','validation_pattern'=>"string",
                'html_attributes'=>[
                    'input-type'=>'text',
                    'element-type'=>'textarea'
                ]
            ],
            [
                'name'=>'note','validation_pattern'=>"string",
                'html_attributes'=>[
                    'input-type'=>'text',
                    'element-type'=>'textarea'
                ]
            ],
            [
                'name'=>'reference','validation_pattern'=>"string",
                'html_attributes'=>[
                    'input-type'=>'text',
                    'element-type'=>'input'
                ]
            ],
            [
                'name'=>'position','validation_pattern'=>"string",
                'html_attributes'=>[
                    'input-type'=>'text',
                    'element-type'=>'input'
                ]
            ],
            [
                'name'=>'company','validation_pattern'=>"string",
                'html_attributes'=>[
                    'input-type'=>'text',
                    'element-type'=>'input'
                ]
            ],
            [
                'name'=>'age','validation_pattern'=>"integer",
                'html_attributes'=>[
                    'input-type'=>'number',
                    'element-type'=>'input',
                    'step'=>1
                ]
            ],
            [
                'name'=>'score','validation_pattern'=>"numeric",
                'html_attributes'=>[
                    'input-type'=>'number',
                    'element-type'=>'input',
                    'step'=>0.1
                ]
            ],
            [
                'name'=>'group','validation_pattern'=>"string",
                'html_attributes'=>[
                    'input-type'=>'text',
                    'element-type'=>'input'
                ]
            ],
            [
                'name'=>'team','validation_pattern'=>"string",
                'html_attributes'=>[
                    'input-type'=>'text',
                    'element-type'=>'input'
                ]
            ],
            [
                'name'=>'birthday','validation_pattern'=>"date",
                'html_attributes'=>[
                    'input-type'=>'date',
                    'element-type'=>'input'
                ]
            ],
        ];

        $items = array_map(function($item){
            $item['html_attributes'] = json_encode($item['html_attributes']);
            return $item;
        }, $items);

        return collect($items)->map(function($item){
            \App\AttributeType::create($item);
        });

    }
}
