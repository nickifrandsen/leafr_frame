<?php

namespace Leafr\Core;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = ['value'];

    public $primaryKey = 'key';

    public $incrementing = false;

    public $timestamps = false;

    public static function get_option($key)
    {
        $setting = self::where('key',$key)->first();

        if(empty($setting)) {
            return;
        }

        return $setting->value;
    }

    public static function getOptionsByGroup($group)
    {
        $settings = self::select('key', 'value')->where('group',$group)->get();

        if(empty($settings)) {
            return;
        }

        foreach($settings as $setting) {
            $output[$setting->key] = $setting->value;
        }

        return $output;
    }

    public static function getPublicOptions()
    {
        return self::where('group','brand')
            ->orWhere('group','store')
            ->orWhere('group','general')
            ->orWhere('group','google')
            ->orWhere('group','social')
            ->pluck('value', 'key')
            ->all();
    }

    public static function generateFormField($setting)
    {

        $output = '';

        if($setting->type === 'string' OR $setting->type === 'integer') {
            $output =   '<div class="form-group">' .
                            '<input type="text" name="'.$setting->key .'" value="'.$setting->value.'" class="'.$setting->type.'">' .
                            '<label for="'.$setting->key.'">' . $setting->description . '</label>'.
                        '</div>';
        } elseif($setting->type === 'text') {
            $output =   '<div class="form-group">' .
                            '<textarea name="'.$setting->key .'" class="'.$setting->type.'">' .
                                $setting->value .
                            '</textarea>'.
                            '<label for="'.$setting->key.'">' . $setting->description . '</label>'.
                        '</div>';
        } elseif($setting->type === 'boolean') {

            $isChecked = '';

            if($setting->value == 'true') {
                $isChecked = 'checked';
            }

            $output =   '<div class="form-group-checkbox">' .
                            '<input type="hidden" name="'.$setting->key .'" value="false" class="'.$setting->type.'">' .
                            '<input type="checkbox" name="'.$setting->key .'" value="true" id="'.$setting->key.'"'.$isChecked.'>' .
                            '<label for="'.$setting->key.'">' . $setting->description . '</label>'.
                        '</div>';
        }

        return $output;
    }
}
