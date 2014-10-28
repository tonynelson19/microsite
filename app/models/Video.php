<?php

/**
 * Video model
 *
 * @property int $id
 * @property int $productId
 * @property Product product
 * @property string $caption
 * @property string $videoUrl
 * @property string $status
 * @property int $order
 */
class Video extends Illuminate\Database\Eloquent\Model
{
	protected $table = 'videos';

    public $timestamps = false;

    const STATUS_ACTIVE   = 'Active';
    const STATUS_INACTIVE = 'Inactive';

    /**
     * Statuses
     *
     * @var array
     */
    public static $statuses = array(
        self::STATUS_ACTIVE   => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    );

    /**
     * Get the product associated with the video
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('Product', 'productId');
    }

    /**
     * Only active records
     *
     * @param Illuminate\Database\Query\Builder $query
     * @return Illuminate\Database\Query\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', '=', self::STATUS_ACTIVE);
    }

    /**
     * Order the records
     *
     * @param Illuminate\Database\Query\Builder $query
     * @return Illuminate\Database\Query\Builder
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    /**
     * Get the YouTube URL
     *
     * @param string $url
     * @return null|string
     */
    public static function getYouTubeUrl($url)
    {
        $id = self::getYouTubeId($url);

        if ($id) {
            return 'http://youtu.be/' . $id;
        }

        return null;
    }

    /**
     * Get the YouTube embed URL
     *
     * @param string $url
     * @return null|string
     */
    public static function getYouTubeEmbedUrl($url)
    {
        $id = self::getYouTubeId($url);

        if ($id) {
            return 'http://www.youtube.com/embed/' . $id;
        }

        return null;
    }

    /**
     * Get the YouTube thumbnail URL
     *
     * @param string $url
     * @return null|string
     */
    public static function getYouTubeThumbnailUrl($url)
    {
        $id = self::getYouTubeId($url);

        if ($id) {
            return 'http://img.youtube.com/vi/' . $id . '/default.jpg';
        }

        return null;

    }

    /**
     * Get the YouTube ID
     *
     * @param string $url
     * @return string|null
     */
    public static function getYouTubeId($url)
    {
        if ($url == '') {
            return null;
        }

        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) {
            return $match[1];
        }

        return null;
    }
}