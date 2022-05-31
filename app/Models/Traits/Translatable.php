<?php


namespace App\Models\Traits;


use Illuminate\Support\Facades\App;

trait Translatable
{
    protected $defaultLocale = 'ru';

    public function __($originFieldName)
    {
        $locale = App::getLocale() ?? $this->defaultLocale;
        if ($locale === 'en')
        {
            $fieldName = $originFieldName.'_en';
        }else{
            $fieldName = $originFieldName;
        }

        // eyer o gelen attrebut bazadaki tablede yoxdusa xeta versin
        $attributes = array_keys($this->attributes);
        if (!in_array($fieldName,$attributes)){
            throw new \LogicException('bu stun yoxdu'.get_class($this));
        }

        // eyer en dilde her hansi bir key bowdusa hemin keysin   russ dilindeki text yazilsin
        if ($locale === 'en' && (is_null($this->$fieldName)) || empty($this->$fieldName)){
            return $this->$originFieldName;
        }
        return $this->$fieldName;
    }
}
