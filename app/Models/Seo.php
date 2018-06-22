<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Seo
 *
 * @property int $id
 * @property string|null $title_ru
 * @property string|null $title_en
 * @property string $document_type
 * @property string|null $priority
 * @property string|null $h1_ru
 * @property string|null $h1_en
 * @property string|null $frequency
 * @property string|null $robots
 * @property string|null $state
 * @property string|null $description_ru
 * @property string|null $description_en
 * @property string|null $keywords
 * @property string|null $seo_title_ru
 * @property string|null $seo_title_en
 * @property string|null $seo_text_ru
 * @property string|null $seo_text_en
 * @property int $document_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereDescriptionEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereDocumentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereDocumentType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereFrequency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereH1En($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereH1Ru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereRobots($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeoTextEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeoTextRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeoTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeoTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereTitleEn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $title
 * @property string|null $h1
 * @property string|null $seo_title
 * @property string|null $description
 * @property string|null $seo_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereH1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeoText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Seo whereTitle($value)
 */
class Seo extends Model
{
    protected $fillable = ['title', 'description', 'document_id', 'document_type', 'created_at', 'updated_at', 'priority', 'h1', 'frequency', 'robots', 'state', 'keywords'];

    const PRIORITY = ['0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9'];
    const FREQUENCY = ['always' => 'always', 'hourly' => 'hourly', 'daily' => 'daily', 'weekly' => 'weekly'];
    const STATE = ['dynamic' => 'dynamic', 'static' => 'static'];
    const ROBOTS = ['index,follow' => 'index,follow','noindex,follow' => 'noindex,follow','index,nofollow' => 'index,nofollow','noindex,nofollow' => 'noindex,nofollow',];
}
