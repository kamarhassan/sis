<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Intervention\Image\Facades\Image;

class ImageSizeRule implements Rule
{
    private $minWidth;
    private $maxWidth;
    private $minHeight;
    private $maxHeight;

    public function __construct($minWidth, $maxWidth, $minHeight, $maxHeight)
    {
        $this->minWidth = $minWidth;
        $this->maxWidth = $maxWidth;
        $this->minHeight = $minHeight;
        $this->maxHeight = $maxHeight;
    }

    public function passes($attribute, $value)
    {
        $image = Image::make($value);

        $width = $image->width();
        $height = $image->height();

        return $width >= $this->minWidth && $width <= $this->maxWidth &&
               $height >= $this->minHeight && $height <= $this->maxHeight;
    }

    public function message()
    {
        return 'The :attribute dimensions must be between ' . $this->minWidth . 'x' . $this->minHeight . ' and ' . $this->maxWidth . 'x' . $this->maxHeight . '.';
    }
}
