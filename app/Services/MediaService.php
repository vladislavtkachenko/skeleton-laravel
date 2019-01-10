<?php

namespace App\Services;


use Illuminate\Database\Eloquent\Model;

class MediaService
{

    /**
     * Добавляет медиа до создания модели
     * @param Model $model
     * @param string $attribute
     * @param string $collection
     * @param bool $responsive_images
     * @return null
     */
    public static function beforeCreateModel(Model $model, string $attribute = null, string $collection, bool $responsive_images = true)
    {
        if ($attribute) {
            $file_adder = null;
            if (filter_var($attribute, FILTER_VALIDATE_URL)) $file_adder = $model->addMediaFromUrl($attribute);
            else $file_adder = $model->addMedia(public_path($attribute));
            if ($responsive_images) $file_adder = $file_adder->withResponsiveImages();
            $file_adder->toMediaCollection($collection)->fill([
                'model_type' => get_class($model),
                'model_id' => get_class($model)::count() + 1
            ])->save();
            return $model->getMedia($collection)->first()->getUrl();
        }

        return null;
    }

    /**
     * Добавляет медиа до обновления модели
     * @param Model $model
     * @param string $attribute
     * @param string $collection
     * @param bool $responsive_images
     * @return null
     */
    public static function beforeUpdateModel(Model $model, string $attribute, string $collection, bool $responsive_images = true)
    {
        $old_model = get_class($model)::find($model->id);
        if ($model->$attribute != $old_model->$attribute) {
            $model->clearMediaCollection($collection);
            if ($model->$attribute) {
                $file_adder = $model->addMedia(public_path($model->$attribute));
                if ($responsive_images) $file_adder = $file_adder->withResponsiveImages();
                $media = $file_adder->toMediaCollection($collection);
                return $media->getUrl();
            }
        }

        return null;
    }

}
